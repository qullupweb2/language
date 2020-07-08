<?php
/**
 * Created by PhpStorm.
 * User: imac
 * Date: 02.11.2018
 * Time: 22:25
 */

namespace App\Support;
use Carbon\Carbon;

class Dates {

    /**
     * Returns difference beetween two dates
     *
     * @return int
     */
    public static function getDiffirenceDays($first,$second) {

        $difference = $first->diffInDays($second);

        //Проверяем чтобы курс был позднее текущего времени
        if($second < $first) {

            return $difference;


        } else {

            return false;

        }

    }

    /**
     * Mutate date for m.d.y format
     *
     * @return string
     */
    public static function dateFormat($date)
    {
        return Carbon::parse($date)->format('d.m.y');
    }

}