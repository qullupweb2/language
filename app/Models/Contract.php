<?php

namespace App\Models;

use App\Http\Services\ContractService;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Contract extends Model
{
    protected $fillable = ['number', 'user_id', 'status', 'send_sms'];

    public static function boot() {

        parent::boot();

        self::created(function($model) {
           $user = User::find($model->user_id);
           $user->contract_number .= str_replace('-', '', $model->number).',';
           $user->save();
        });
    }

    public function items()
    {
        return $this->hasMany('App\Models\ContractItem')->get();
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document')->get();
    }

    public function getNumberAttribute($attr) {
        return str_replace('-', '', $attr);
    }

    public function getPriceAttribute() {
        $items = $this->items();

        $price = 0;

        foreach($this->items() as $item) {
            if($item !== null) {
                $price = $price + $item->price;
            }
        }
        
        return $price;

    }

    public function getIndexAttribute() {

        $contractService = new ContractService($this);

        if($this->document_index === null) {

            $index = $contractService->setDocumentIndex();
            $this->document_index = $index;
            $this->save();
            return $index;


        } else {

            return $this->document_index;

        }


    }

    
}
