<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    public function role($role_id){
        return Role::where('role_id', $role_id)->join('');
    }
}
