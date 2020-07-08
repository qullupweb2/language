<?php

if (! function_exists('trim_locale')) {

    function trim_locale($locale) {
        if($locale == 'de') {
            return str_replace('de', '', $locale);
        } else {
            return $locale;
        }

    }

}

if (! function_exists('trim_lang')) {

    function trim_lang($lang) {

        $islang = explode('/', $lang)[1];
        if(strlen($islang) == 2) {
            return substr($lang, 3);
        } else {
            return $lang;
        }

    }

}
