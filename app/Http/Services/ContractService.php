<?php
/**
 * Created by PhpStorm.
 * User: imac
 * Date: 03.11.2018
 * Time: 14:25
 */

namespace App\Http\Services;

use App;
use App\Models\Contract;
use App\User;
use App\Models\AdminNotify;
use App\Notifications\InvoicePaid;
use Carbon\Carbon;
use App\Support\Dates;
use App\Mail\RegisterConfirmation;
use App\Mail\RemoveContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class ContractService extends BaseService {

    public function __construct(Contract $contract) {

        $this->model = $contract;

    }

    /**
     * Get contracts by user
     * @argument user_id
     * @return array Contract
     */
    public function getContractsByUser($id) {

        return Contract::where('user_id', $id)->get();

    }

    /**
     * Get contracts by number
     * @argument number
     * @return Contract
     */
    public function getContractsByNumber($number) {
        $user_id = substr($number, 10);

        $time = substr($number,0,10);

        return Contract::where('number', $time.'-'.$user_id)->first();

    }

    /**
     * Compare prices contract and parse array result
     *
     * @return array
     */
    public function comparePrices($parseArray) {

        $result = [];

        $invoiceService = App::make('App\Http\Services\InvoiceService');

        foreach ($parseArray as $contract_number => $amount) {

            $amount = str_replace('.','',$amount);
            $amount = (int)strtok($amount, ',');

            $contract = $this->getContractsByNumber($contract_number);



            //Пропускаем оплаченные
            if($contract === null) continue;
            if($contract->status == 'paid') {
                $adminNotify = new AdminNotify;
                $adminNotify->status = 'danger';
                $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> payed('.$amount.' EURO) but contract('.$contract->number.') already paid';
                $adminNotify->save();

                $result[$contract->id] = array(
                    'link_user' => "/admin/users/".$contract->user_id,
                    'status' => 'payed_again',
                    'amount' => $amount
                );

                continue;
            } 
            if($contract->status == 'break') {
                $adminNotify = new AdminNotify;
                $adminNotify->status = 'danger';
                $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> payed('.$amount.' EURO) but contract break';
                $adminNotify->save();
                continue;
            } 

            $user = User::find($contract->user_id);

            if(!$this->checkPlaces($contract->id)) {

                $status = 'noPlaces';
                $adminNotify = new AdminNotify;
                $adminNotify->status = 'danger';
                $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> payed('.$amount.' EURO) but course haven\'t places for him';
                $adminNotify->save();

            }


            if ($contract->status == 'prepaid') {

                //Начисляем предоплаченный
                if($this->paidPrepaid($contract->id, $amount)) {

                    //$contract->status = 'paid';
                    //$invoiceService->createPdfInvoice($contract);
                    //$user->status = 'Confirmed';
                    $contract->payed = $contract->payed+$amount;
                    $contract->paid_at = Carbon::now();
                    $user->balance = $user->balance+($contract->payed-$contract->price);

                    //$user->notify(new InvoicePaid($contract));
                    //Mail::to($user->email)->send(new RegisterConfirmation($contract,$user));

                    $status = 'paid';

                    $adminNotify = new AdminNotify;
                    $adminNotify->status = 'success';
                    $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> overpaid('.$amount.' EURO)';
                    $adminNotify->save();
                    
                } else {
                    $contract->payed = $contract->payed+$amount;
                    $contract->paid_at = Carbon::now();
                    $status = 'prepaid';
                }


            } else {


                    $acceptStatus = $this->AcceptPayment($contract->id, $amount);


      


                    if($acceptStatus == 'full') {
                        $status = 'payed';

                        $adminNotify = new AdminNotify;
                        $adminNotify->status = 'success';
                        $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> full payed('.$amount.' EURO)';
                        $adminNotify->save();

                        //Меняем статус пользователей
                        $user->status = 'Confirmed';
                        $contract->status = 'paid';
                        $contract->payed = $contract->price;
                        $contract->paid_at = Carbon::now();
                        $this->sendOfficialPaid($contract);

                        foreach ($contract->items() as $item) {

                            if(Dates::getDiffirenceDays(Carbon::now(), $item->created_at) > 10) {
                                $status = 'payed_late';
                                $adminNotify = new AdminNotify;
                                $adminNotify->status = 'danger';
                                $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> paid late, reservation expired';
                                $adminNotify->save();
                            }

                            $item->expired_at = '2028-01-01 00:00:00';
                        }


                        //$invoiceService->createPdfInvoice($contract);
                        $user->notify(new InvoicePaid($contract));
                        $this->sendOfficial($contract);
                        Mail::to($user->email)->send(new RegisterConfirmation($contract,$user));


                    } elseif ($acceptStatus == 'prepaid') {

                        $status = 'prepayed';
                        $user->status = 'Prepaid';
                        $contract->status = 'prepaid';
                        $contract->payed = $amount;
                        $contract->paid_at = Carbon::now();
                        $this->sendOfficialPaid($contract);

                        $adminNotify = new AdminNotify;
                        $adminNotify->status = 'warning';
                        $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> prepayed('.$amount.' EURO)';
                        $adminNotify->save();

                        foreach ($contract->items() as $item) {

                            if(Dates::getDiffirenceDays(Carbon::now(), $item->created_at) > 10) {
                                $adminNotify = new AdminNotify;
                                $adminNotify->status = 'danger';
                                $adminNotify->description = '<a target="_blank" href="/admin/users/'.$contract->user_id.'">User</a> paid late, reservation expired';
                                $adminNotify->save();
                            }

                            $item->expired_at = '2028-01-01 00:00:00';
                        }

                        $invoiceService->createPdfInvoice($contract);
                        if($amount > 160) {
                            $user->notify(new InvoicePaid($contract));
                        }
                        
                        Mail::to($user->email)->send(new RegisterConfirmation($contract,$user));


                    } else {
                        $status = 'wrongsumm';
                        $adminNotify = new AdminNotify;
                        $adminNotify->status = 'danger';
                        $adminNotify->description = 'Wrond summ('.$amount.' EURO) paid by <a target="_blank" href="/admin/users/'.$contract->user_id.'">user</a>';
                        $adminNotify->save();
                    }



            }

            //Сохраняем статус юзера и контракта
            $user->save();
            $contract->save();


            $result[$contract->id] = array(
                'link_user' => "/admin/users/".$contract->user_id,
                'status' => $status,
                'amount' => $amount
            );


        }

        return $result;

    }

    /**
     * Add contract item to Contract cat
     *
     * @return App\Models\ContractItem
     */
    public function addItemToContract($data) {

        return App\Models\ContractItem::create($data);

    }

    /**
     * Paid prepaid contract
     *
     * @return boolean
     */
    private function paidPrepaid($id, $amount) {

        $contract = $this->find($id);

        $price = 0;

        foreach ($contract->items() as $item) {

            $price = $price + $item->price;

        }

        if($price <= $amount+$contract->payed) {

            return true;

        } else {

            return false;

        }


    }

    /**
     * Check places available on course
     *
     * @return boolean
     */
    public function checkPlaces($id) {

        $available = true;

        $contract = $this->find($id);

        foreach ($contract->items() as $item) {

            if(!$item->course()->available && Carbon::parse($item->expired_at) > Carbon::now()) {

                $available = false;

            }

        }

        return $available;


    }

    /**
     * Accept payments
     *
     * @return string
     */
    public function AcceptPayment($id, $amount) {

        $contract = $this->find($id);
        $fullprice = 0;

        if(count($contract->items()) === 1 && $amount < $contract->items()[0]->price) {

            return 'prepaid';

        }

        foreach ($contract->items() as $item) {

            $fullprice = $fullprice+$item->price;

        }

        if($fullprice == $amount) {

            return 'full';

        }

        if($fullprice < $amount) {

            $student = User::find($contract->user_id);
            $student->balance = $student->balance+$amount-$fullprice;
            $student->save();

            $adminNotify = new AdminNotify;
            $adminNotify->status = 'danger';
            $adminNotify->description = '<a href="/admin/users/'.$contract->user_id.'">Student</a> pay('.$amount.' EURO) but contract price ('.$fullprice.' EURO)';
            $adminNotify->save();


            return 'full';

        }

        return 'wrongsumm';

    }

    /**
     * Get prices contracti items by Contract id
     *
     * @return integer
     */
    public static function getContractPrice($contract)
    {
        return $contract->items()->sum('price');

    }

    /**
     * Create contract document
     *
     * @return void
     */
    public static function createContractDocument($name, $contract, $filepath, $filepath2 = null)
    {
        if($filepath2 === null) { $filepath2 = $filepath; }
        $document = new \App\Models\Document(['name'=>$name, 'contract_id'=>$contract->id, 'file_path'=>$filepath, 'file_path_front'=>$filepath2, 'front' => 1]);
        $user = User::find($contract->user_id);

        if($user->document_index == null) {
            $user->document_index = $contract->index.',';
        } else {
            if (strripos($user->document_index, $contract->index) === false) {
                $user->document_index = $user->document_index.$contract->index.',';
            } 
        }

        $user->save();

        $document->save();
    }


    /**
     * break Contract
     *
     * @return void
     */
    public function breakContract($contract, $data)
    {

        //if($contract->status != 'break') {

            $invoiceService = App::make('App\Http\Services\InvoiceService');
            $invoiceService->createPdfBreak($contract, $data);

            $contract->returns = $data['price'];
            $contract->breaked = 1;
            $contract->status = 'break';
            $contract->save();

        //}

    }
    /**
     * break Contract
     *
     * @return void
     */
    public function breakContractHide($contract, $data)
    {

        if($contract->status != 'break') {

            $invoiceService = App::make('App\Http\Services\InvoiceService');
            $invoiceService->createPdfBreakOnly($contract, $data);

            $contract->breaked = 1;
            $contract->save();

        }

    }


    /**
     * break Contract
     *
     * @return void
     */
    public function breakContractPre($contract, $data)
    {


            $invoiceService = App::make('App\Http\Services\InvoiceService');
            $invoiceService->createPdfBreak($contract, $data);

            $contract->breaked = 1;
            $contract->status = 'break';
            $contract->save();


    }

    /**
     * delete Contract
     *
     * @return void
     */
    public function deleteContract($contract)
    {
        $user = User::findOrFail($contract->user_id);
        Mail::to($user->email)->send(new RemoveContract($contract));

        foreach($contract->items() as $item) {
            $item->delete();
        }

        $contract->delete();

    }

    /**
     * confirm Contract
     *
     * @return void
     */
    public function confirmContract($contract)
    {

        if($contract->status == 'cash_paid' || $contract->status == 'cash_pre_paid') {

            $invoiceService = App::make('App\Http\Services\InvoiceService');
            $filepath = $invoiceService->createPdfInvoice($contract);

            $user = User::find($contract->user_id);

            $user->notify(new App\Notifications\ConfirmContract($contract, $filepath));

        }

    }


    /**
     * confirm Contract
     *
     * @return void
     */
    public function sendOfficial($contract)
    {

            $contract->numbered = 1;
            $contract->save();

            $invoiceService = App::make('App\Http\Services\InvoiceService');
            $filepath = $invoiceService->createPdfOfficial($contract);

            $user = User::find($contract->user_id);

            $user->notify(new App\Notifications\ConfirmContract($contract, $filepath));
    }

    /**
     * confirm Contract
     *
     * @return void
     */
    public function sendOfficialPaid($contract)
    {
            $invoiceService = App::make('App\Http\Services\InvoiceService');
            $filepath = $invoiceService->createPdfOfficialPaid($contract);
            $contract->generated = 1;
            $contract->save();

            $user = User::find($contract->user_id);

            $user->notify(new App\Notifications\ConfirmContract($contract, $filepath));
    }

    /**
     * confirm Contract
     *
     * @return void
     */
    public function sendOfficialHidden($contract)
    {
            $invoiceService = App::make('App\Http\Services\InvoiceService');
            $filepath = $invoiceService->createPdfOfficial($contract, false);

            $user = User::find($contract->user_id);

            //$user->notify(new App\Notifications\ConfirmContract($contract, $filepath));
    }

    /**
     * confirm of visa
     *
     * @return void
     */
    public function sendConfirmVisa($contract, $data)
    {


            $filepath = storage_path().'/app/visa/'.$contract->number.'.pdf';
            $user = User::find($contract->user_id);

            $course = $contract->items()[0]->course();

            $data['first_name'] = $user->name;
            $data['last_name'] = $user->last_name;
            $data['date_birth'] = $user->birthday;
            $data['adress'] = $user->adress;
            $data['passport_number'] = $user->passport_data;
            $data['how_often'] = $course->how_often2."<br><u>".$course->lessons_count.' Unterrichtsstunden pro Woche</u>';

            PDF::loadView('admin.visa_pdf', $data)
            ->save($filepath);

            $user->notify(new App\Notifications\ConfirmVisa($contract, $filepath));

            PDF::loadView('admin.visa_pdf_admin', $data)
            ->save($filepath);

            $this->createContractDocument('Visa#'.$contract->number,$contract, $filepath);

       
    }

    /**
     * confirm of participation
     *
     * @return void
     */
    public function sendConfirmParticipation($contract, $data)
    {


            $filepath = storage_path().'/app/participations/'.$contract->number.'.pdf';
            $user = User::find($contract->user_id);

            $data['first_name'] = $user->name;
            $data['last_name'] = $user->last_name;
            $data['number'] = $contract->number;

            PDF::loadView('admin.comecourse_pdf', $data)
            ->save($filepath);

            $user->notify(new App\Notifications\ConfirmParticipation($contract, $filepath));

            PDF::loadView('admin.comecourse_pdf_admin', $data)
            ->save($filepath);

            $this->createContractDocument('Participation#'.$contract->number,$contract, $filepath);

       
    }



    /**
     * confirm of participation
     *
     * @return void
     */
    public function sendConfirmParticipationFuture($contract, $data)
    {


            $filepath = storage_path().'/app/future_participations/'.$contract->number.'.pdf';
            $user = User::find($contract->user_id);

            $data['first_name'] = $user->name;
            $data['last_name'] = $user->last_name;
            $data['number'] = $contract->number;

            PDF::loadView('admin.fcomecourse_pdf', $data)
            ->save($filepath);

            $user->notify(new App\Notifications\ConfirmParticipation($contract, $filepath));

            PDF::loadView('admin.fcomecourse_pdf_admin', $data)
            ->save($filepath);

            $this->createContractDocument('FutureParticipation#'.$contract->number,$contract, $filepath);

       
    }


    public function setDocumentIndex()
    {
        $current_number = config('document_index');

        DB::table('admin_config')
            ->where('name', 'document_index')
            ->update(['value' => $current_number+1]);

        return $current_number;
    }

}