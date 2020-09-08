<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accdetail extends Model
{
    public $timestamps = false;
    
    protected $fillable=[
        'id','operate','amount'
    ];
}
