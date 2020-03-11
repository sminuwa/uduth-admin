<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
        "uid","name", "age", "gender", "address", "phone", "email","companion","hospital_referral_name", "referral_letter","patient_type","file_no","user_id"
    ];

    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
