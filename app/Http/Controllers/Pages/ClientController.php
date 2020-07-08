<?php
/**
 * Created by PhpStorm.
 * User: imac
 * Date: 03.11.2018
 * Time: 14:23
 */

namespace App\Http\Controllers\Pages;


use App\Http\Controllers\Controller;
use App\Http\Services\ClientService;
use App\Http\Services\ContractService;
use App\Http\Services\CourseService;
use App\Http\Services\InvoiceService;
use App\Models\Document;
use Auth;
use Illuminate\Http\Request;

class ClientController extends Controller {

    /**
     * Return contract of courses by user
     * @argument user_id
     * @return view
     */
    public function courses(ContractService $contractService, CourseService $courseSerivce) {

        $contracts = $contractService->getContractsByUser(Auth::id());

        if(count($contracts) > 0) {
            $coursePrev = $courseSerivce->find($contracts[0]->items()[0]->course_id);
            $courseNext = $courseSerivce->getNextLevel($coursePrev->name);
        } else {
            $courseNext = false;
        }




        return view('pages.mycourses', [
            'contracts' => $contracts,
            'next_course' => $courseNext
        ]);

    }

    /**
     * Download invoice
     *
     * @return view
     */
    public function download(Request $request, ContractService $contractService, InvoiceService $invoiceService) {



        if(isset($request->name)) {


            $document = Document::where('name', $request->name)->first();

            if($document === null) {
                abort(404);
            }
            try {
                if ($document->front) return $invoiceService->download($document->file_path_front);
                else  return $invoiceService->download($document->file_path);
            } catch (\Exception $error) {
                abort(404);
            }


        } else {

            abort(404);

        }

    }



}