<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'patient_id', 'service_id', 'service_type', 'service_amount','payment_type',  'payment_status', 'user_id', 'receipt_no', 'sync_status'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
