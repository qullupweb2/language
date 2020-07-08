<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractItem extends Model
{
    protected $fillable = ['contract_id', 'course_id', 'price', 'expired_at'];

    /**
     * Returns course of contract
     *
     * @return Course::class
     */
    public function course() {
        return $this->belongsTo('App\Models\Course', 'course_id')->first();
    }

    public function contract() {
        return $this->belongsTo('App\Models\Contract', 'contract_id')->first();
    }


}
