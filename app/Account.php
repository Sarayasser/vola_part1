<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable=['user_id','bank_id','balance','currency','type_of_account','status'];

    public function bank(){
    	return $this->belongsTo('App\Bank');
    }
}
