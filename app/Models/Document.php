<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['name', 'file_path',  'file_path_front',  'front', 'contract_id', 'exam_id'];
}
