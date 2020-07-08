<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class ExamenContainer extends Model
{
	protected $fillable = [
		'oral1', 'hv_data', 'lv_data', 'sa_data'
	];

	public function exam() {
        return $this->belongsTo(Examen::class)->first();
    }

    public function documents()
    {
        return Document::where('exam_id', $this->id)->get();
    }
}
