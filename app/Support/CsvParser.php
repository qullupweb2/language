<?php
/**
 * Created by PhpStorm.
 * User: imac
 * Date: 09.11.2018
 * Time: 11:50
 */

namespace App\Support;

use League\Csv\Reader;
use Carbon\Carbon;

class CsvParser {

    private $parseArray;

    /**
     * Parse bank invoices
     *
     * @return array of contract/summ
     */
    public static function parseInvoices($file_path) {

        $file = Reader::createFromPath($file_path, 'r');
        $file->setDelimiter(';');

        $records = $file->getRecords();

        foreach ($records as $offset => $record) {

            //Получаем только ключевые объекты
            if(count($record) == 13 && $record[0] !== 'Buchungstag' && $record[1] !== '') {


                if(preg_match("/(15)[0-9]{12}/", $record[8], $matches)) {
                    
                    $contract_number = $matches[0];
                    
                    $amount = $record[11];


                    $parseArray[$contract_number] = $amount;



                } elseif(preg_match("/(15)[0-9]{11}/", $record[8], $matches)) {
                    
                    $contract_number = $matches[0];

                    
                    
                    $amount = $record[11];


                    $parseArray[$contract_number] = $amount;



                }

            }

        }

        return $parseArray;

    }

    public static function parseRecords($file_path) {

        $file = Reader::createFromPath($file_path, 'r');
        $file->setDelimiter(';');

        $records = $file->getRecords();

        foreach ($records as $offset => $record) {

            if($record[4] == 'H') {
                $parseArray[$offset]['name_last'] = $record[1];

                $date = Carbon::createFromFormat('d.m.Y', $record[0])->subDays(3)->format('d.m.Y');

                $parseArray[$offset]['date'] = $date;
                $parseArray[$offset]['amount'] = $record[3];
            }

        }

        return $parseArray;

    }

}