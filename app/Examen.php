<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    public $timestamps = false;

    public function category() {
        return $this->belongsTo('App\ExamenCat', 'cat_id')->first();
    }

    /**
     * Check exam available for registartion
     *
     * @return boolean
     */
    public function getAvailableAttribute() {
        $count = ExamenContainer::where('exam_id', $this->id)->count();

        $max_count = $this->max_count;

        if($count < $max_count) {
            return true;
        } else {
            return false;
        }
    }

}
