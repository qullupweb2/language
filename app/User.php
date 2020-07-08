<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','adress','passport_number','status', 'balance','birthday', 'last_name', 'adress','phone', 'passport_data', 'notice', 'needconfirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function getBirthdayAttribute($value)
    {
        if (strpos($value, '-') !== false) {
            return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
        } else {
            return $value;
        }
    }

    public function contracts()
    {
        return $this->hasMany('App\Models\Contract', 'user_id', 'id');
    }
}
