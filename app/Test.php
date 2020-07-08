<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public $timestamps = false;

    protected $casts = [
        'value' => 'json'
    ];
}
