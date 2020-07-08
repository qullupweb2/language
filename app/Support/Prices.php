<?php
/**
 * Created by PhpStorm.
 * User: imac
 * Date: 02.11.2018
 * Time: 22:25
 */

namespace App\Support;
use Carbon\Carbon;

class Prices {

    /**
     * Return price by $difference
     *
     * @return string
     */
    public static function getPrice($difference) {

        $price = null;

        if($difference >= 28) {
            $price = 'price_1';
        } elseif($difference >= 14 && $difference < 28) {
            $price = 'price_2';
        } elseif($difference < 14) {
            $price = 'price_3';
        }

        return $price;


    }

    /**
     * Return price by $difference with auth and comfirmed
     *
     * @return string
     */
    public static function getPriceWithAuth($difference) {

        $price = null;

        if($difference >= 28) {
            $price = 'price_1';
        } elseif($difference >= 14 && $difference < 28) {
            $price = 'price_1';
        } elseif($difference < 14) {
            $price = 'price_2';
        } elseif($difference < 7) {
            $price = 'price_3';
        }

        return $price;

    }

}