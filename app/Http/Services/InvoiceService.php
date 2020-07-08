<?php
/**
 * Created by PhpStorm.
 * User: imac
 * Date: 03.11.2018
 * Time: 14:25
 */

namespace App\Http\Services;

use App\User;
use PDF;
use App\Models\Course;
use App\Models\Invoice;

class InvoiceService extends BaseService {

    public function __construct(Invoice $invoice) {

        $this->model = $invoice;

    }

    /**
     * Create pdf invoice
     *
     * @return void
     */
    public function createPdfInvoice($contract) {


        $courses = array();
        $name = '';
        $period = '';
        $fullprice = 0;

        $user = User::find($contract->user_id);

        foreach ($contract->items() as $item) {

            array_push($courses, $item->course());
            $fullprice = $fullprice + $item->price;

        }

        $fullprice_course = $fullprice;


        for ($i = 0; $i < count($courses); $i++) {

            if($i > 0) {
                $name.= ' + '.$courses[$i]->name;
                $period.= ', '.\Carbon\Carbon::parse($courses[$i]->start_date)->format('d.m.Y').' - '.\Carbon\Carbon::parse($courses[$i]->end_date)->format('d.m.Y');

            } else {
                $name.= $courses[$i]->name;
                $period.= \Carbon\Carbon::parse($courses[$i]->start_date)->format('d.m.Y').' - '.\Carbon\Carbon::parse($courses[$i]->end_date)->format('d.m.Y');

            }

        }

        if($contract->status == 'prepaid') {
            $fullprice = $contract->payed;
        }

        if($contract->status == 'cash_pre_paid') {
            $fullprice = $contract->payed;
        }



        $data['first_name'] = $user->name;
        $data['last_name'] = $user->last_name;

        //adress
        $adr = explode(',', $user->adress);

        if(isset($adr[1])) {
            $data['street'] = $adr[1];
        } else {
            $data['street'] = '';
        }

        if(isset($adr[2])) {
            $data['city'] = $adr[2];
        } else {
            $data['city'] = '';
        }

        if(isset($adr[3])) {
            $data['zipcode'] = $adr[3];
        } else {
            $data['zipcode'] = '';
        }


        $data['contract_number'] = $contract->number;
        $data['document_index'] = $contract->index;
        $data['course'] = $name;
        $data['period'] = $period;
        $data['amount'] = $fullprice;
        $data['amount_course'] = $fullprice_course;

        $filepath = storage_path().'/app/invoices/'.$data['contract_number'].'.pdf';

        PDF::loadView('admin.invoice', $data)
            ->save($filepath);

        ContractService::createContractDocument('Invoice#'.$contract->number,$contract, $filepath);

        return $filepath;


    }

        /**
     * Create pdf invoice
     *
     * @return void
     */
    public function createPdfOfficial($contract, $save_doc = true) {


        $courses = array();
        $name = '';
        $period = '';
        $fullprice = 0;

        $user = User::find($contract->user_id);

        foreach ($contract->items() as $item) {

            array_push($courses, $item->course());
            $fullprice = $fullprice + $item->price;

        }



        for ($i = 0; $i < count($courses); $i++) {

            if($i > 0) {
                $name.= ' + '.$courses[$i]->name;
                $period.= ', '.\Carbon\Carbon::parse($courses[$i]->start_date)->format('d.m.Y').' - '.\Carbon\Carbon::parse($courses[$i]->end_date)->format('d.m.Y');

            } else {
                $name.= $courses[$i]->name;
                $period.= \Carbon\Carbon::parse($courses[$i]->start_date)->format('d.m.Y').' - '.\Carbon\Carbon::parse($courses[$i]->end_date)->format('d.m.Y');

            }

        }

        if($contract->status == 'prepaid') {
            $fullprice = $contract->payed;
        }

        if($contract->status == 'cash_pre_paid') {
            $fullprice = $contract->payed;
        }



        $data['first_name'] = $user->name;
        $data['last_name'] = $user->last_name;

        //adress
        $adr = explode(',', $user->adress);

        if(isset($adr[1])) {
            $data['street'] = $adr[1];
        } else {
            $data['street'] = '';
        }

        if(isset($adr[2])) {
            $data['city'] = $adr[2];
        } else {
            $data['city'] = '';
        }

        if(isset($adr[3])) {
            $data['zipcode'] = $adr[3];
        } else {
            $data['zipcode'] = '';
        }


        $data['contract_number'] = $contract->number;
        $data['contart_date'] = $contract->created_at;
        $data['document_index'] = $contract->index;
        $data['year'] = date("Y");
        $data['course'] = $name;
        $data['period'] = $period;
        $data['amount'] = $fullprice;

        $filepath = storage_path().'/app/official/'.$data['contract_number'].'.pdf';

        PDF::loadView('admin.official', $data)
            ->save($filepath);

        if($save_doc) {
            ContractService::createContractDocument('Official#'.$contract->number,$contract, $filepath);
        }    
        

        return $filepath;


    }


    /**
     * Create pdf official paid
     *
     * @return void
     */
    public function createPdfOfficialPaid($contract, $save_doc = true) {


        $courses = array();
        $name = '';
        $period = '';
        $fullprice = 0;

        $user = User::find($contract->user_id);

        foreach ($contract->items() as $item) {

            array_push($courses, $item->course());
            $fullprice = $fullprice + $item->price;

        }



        for ($i = 0; $i < count($courses); $i++) {

            if($i > 0) {
                $name.= ' + '.$courses[$i]->name;
                $period.= ', '.\Carbon\Carbon::parse($courses[$i]->start_date)->format('d.m.Y').' - '.\Carbon\Carbon::parse($courses[$i]->end_date)->format('d.m.Y');

            } else {
                $name.= $courses[$i]->name;
                $period.= \Carbon\Carbon::parse($courses[$i]->start_date)->format('d.m.Y').' - '.\Carbon\Carbon::parse($courses[$i]->end_date)->format('d.m.Y');

            }

        }



        $data['first_name'] = $user->name;
        $data['last_name'] = $user->last_name;

        //adress
        $adr = explode(',', $user->adress);

        if(isset($adr[1])) {
            $data['street'] = $adr[1];
        } else {
            $data['street'] = '';
        }

        if(isset($adr[2])) {
            $data['city'] = $adr[2];
        } else {
            $data['city'] = '';
        }

        if(isset($adr[3])) {
            $data['zipcode'] = $adr[3];
        } else {
            $data['zipcode'] = '';
        }


        $data['contract_number'] = $contract->number;
        if($contract->payed == null) {
            $data['paid_amount'] = $fullprice;
        } else {
            $data['paid_amount'] = $contract->payed;
        }
        
        $data['paid_date'] = $contract->paid_at;
        $data['document_index'] = $contract->index;
        $data['year'] = date("Y");
        $data['course'] = $name;
        $data['period'] = $period;
        $data['amount'] = $fullprice;

        $filepath = storage_path().'/app/official_paid/'.$data['contract_number'].'.pdf';

        PDF::loadView('admin.official_paid', $data)
            ->save($filepath);
        PDF::loadView('admin.official_paid_front', $data)
            ->save($filepath);

        if($save_doc) {
            ContractService::createContractDocument('OfficialPaid#'.$contract->number,$contract, $filepath);
        }    
        

        return $filepath;


    }


    /**
     * Create pdf break document
     *
     * @return file_path
     */
    public function createPdfBreak($contract, $arr) {


        $user = User::find($contract->user_id);



        $data['coursesnames'] = CourseService::generateCoursesNames($contract->items());
        $data['price'] = $arr['price'];
        $data['contart_date'] = $contract->created_at;
        $data['year'] = date('Y');
        $data['numbered'] = $contract->numbered;
        $data['adress'] = $user->adress;
        $data['name'] = $user->name;
        $data['document_index'] = $contract->index;
        $data['lastname'] = $user->last_name;
        $data['reason'] = $arr['reason'] ?? '';
        $data['bank_reqs'] = $arr['bank_reqs'] ?? '';
        if($contract->status != 'cash_paid') {
            $data['number'] = 'Nr. '.$contract->number;
        } else {
            $data['number'] = '';
        }

        $filepath = storage_path().'/app/breaks/'.$contract->number.'.pdf';

        PDF::loadView('admin.break', $data)
            ->save($filepath);

        ContractService::createContractDocument('Break#'.$contract->number,$contract, $filepath);

        return $filepath;

    }

    /**
     * Create pdf break document
     *
     * @return file_path
     */
    public function createPdfBreakOnly($contract, $arr) {


        $user = User::find($contract->user_id);



        $data['coursesnames'] = CourseService::generateCoursesNames($contract->items());
        $data['price'] = $arr['price'];
        $data['contart_date'] = $contract->created_at;
        $data['year'] = date('Y');
        $data['numbered'] = $contract->numbered;
        $data['adress'] = $user->adress;
        $data['name'] = $user->name;
        $data['document_index'] = $contract->index;
        $data['lastname'] = $user->last_name;
        $data['reason'] = $arr['reason'] ?? '';
        $data['bank_reqs'] = $arr['bank_reqs'] ?? '';
        if($contract->status != 'cash_paid') {
            $data['number'] = 'Nr. '.$contract->number;
        } else {
            $data['number'] = '';
        }

        $filepath = storage_path().'/app/breaks/'.$contract->number.'.pdf';

        PDF::loadView('admin.break', $data)
            ->save($filepath);

        return $filepath;

    }

    /**
     * Download invoice
     *
     * @return download
     */
    public function download($path) {

        $file = $path;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, 'document.pdf', $headers);

    }

    /**
     * Generate confirmed for print
     *
     * @return view
     */
    public static function generateConfirmed($contract, $client, $admin = false, $manual = false)
    {

        $adress = ClientService::parseClientAdress($client->id);

        $contract_items = $contract->items();
        if($contract->status == 'prepaid') {
            $prepaid = true;
        } else {
            $prepaid = false;
        }

        if($contract->status == 'cash_pre_paid' || $contract->status == 'cash_paid') {
            $cash = true;
        } else {
            $cash = false;
        }

        if($contract->payed !== NULL) {
            $payed = $contract->payed;
        } else {
            $payed = $contract->price;
        }
        

        $data = [
            'contractnumber'=> $contract->number,
            'name'=>$client->name,
            'prepaid' => $prepaid,
            'lastname'=>$client->last_name,
            'birthday'=>$client->birthday,
            'payed'=>$payed,
            'street'=>$adress['street'],
            'city'=>$adress['city'],
            'zipcode'=>$adress['zipcode'],
            'coursesnames'=>CourseService::generateCoursesNames($contract_items),
            'date_range'=>CourseService::generateCoursesDates($contract_items,$client->needconfirmed),
            'how_often'=>CourseService::generateCoursesOften($contract_items,$client->needconfirmed),
            'lessons_count'=>CourseService::getLessonCount($contract_items),
            'books'=>CourseService::generateBooks($contract_items),
            'price' => ContractService::getContractPrice($contract),
            'manual' => $manual,
            'cash' => $cash
        ];


        //Сохраняем документ как прикрепленный к счету
        if($admin) {
            $filepath = storage_path().'/app/confirmations/'.$contract->number.'_admin.pdf';
        } else {
            $filepath = storage_path().'/app/confirmations/'.$contract->number.'.pdf';
        }
        
        $data['file_path'] = $filepath;

        if($admin) {
             PDF::loadView('admin.confirmation_pdf_admin', $data)
            ->save($filepath);
        } else {
            PDF::loadView('admin.confirmation_pdf', $data)
            ->save($filepath);
        }
       
        if($admin) {
            ContractService::createContractDocument('Confirmation#'.$contract->number,$contract, $filepath);
        }

        return $data;
    }

    /**
     * Generate confirmed for print
     *
     * @return view
     */
    public static function generateConfirmedCash($contract, $client, $prepaid)
    {

        $adress = ClientService::parseClientAdress($client->id);

        if($contract->status == 'cash_pre_paid' || $contract->status == 'cash_paid') {
            $cash = true;
        } else {
            $cash = false;
        }

        $contract_items = $contract->items();
        if($contract->payed !== null) {
            $payed = $contract->payed;
        } else {
            $payed = $contract->price;
        }

        $data = [
            'contractnumber'=> $contract->number,
            'name'=>$client->name,
            'lastname'=>$client->last_name,
            'birthday'=>$client->birthday,
            'street'=>$adress['street'],
            'city'=>$adress['city'],
            'zipcode'=>$adress['zipcode'],
            'prepaid' => $prepaid,
            'manual' => false,
            'payed'=> $payed,
            'coursesnames'=>CourseService::generateCoursesNames($contract_items),
            'date_range'=>CourseService::generateCoursesDates($contract_items,$client->needconfirmed),
            'how_often'=>CourseService::generateCoursesOften($contract_items,$client->needconfirmed),
            'lessons_count'=>CourseService::getLessonCount($contract_items),
            'books'=>CourseService::generateBooks($contract_items),
            'price' => ContractService::getContractPrice($contract),
            'cash' => $cash
        ];


        //Сохраняем документ как прикрепленный к счету
        $filepath = storage_path().'/app/confirmations/'.$contract->number.'.pdf';
        $filepath2 = storage_path().'/app/confirmations/'.$contract->number.'_front.pdf';

        PDF::loadView('admin.confirmation_pdf_print', $data)
            ->save($filepath);
        PDF::loadView('admin.confirmation_pdf_print_front', $data)
            ->save($filepath2);

        ContractService::createContractDocument('Confirmation#'.$contract->number,$contract, $filepath, $filepath2);

        return $data;
    }

}