<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable=['account_id','date','amount','accountto_id'];

    public function Account(){
    	return $this->belongsTo('App\Account');
    }
}
