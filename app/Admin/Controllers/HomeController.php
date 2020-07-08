<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Form;
use App\Models\PdfLineLog;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use PDF;
use App\Support\CsvParser;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->row('<h1>Hello admin</h1>');
    }

    public function generateOfficial() {
    	return view('admin.generateOfficial');
    }

    public function generate(Request $request) {

        $file_path = $request->file('document')->getPathName();

        $records = CsvParser::parseRecords($file_path);

        $i = file_get_contents('counter.txt');

        foreach($records as $record) {

            $data['first_name'] = $record['name_last'];
            $data['document_index'] = sprintf('%03s', $i).'2018';
            $data['contract_date'] = $record['date'];
            $data['amount'] = $record['amount'];

            $newfilepath = storage_path().'/app/generated/'.$data['document_index'].'.pdf';

            PDF::loadView('admin.officialGen', $data)
                ->save($newfilepath);

            $i ++;

        }

        file_put_contents('counter.txt', $i);

    	

        return 'Успешно';
    }
}
