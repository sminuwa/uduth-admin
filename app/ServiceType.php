<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    //
    protected $fillable = [
        'name','amount', 'service_id', 'user_id'
    ];
}
