<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicDepartment extends Model
{
    public function users(){
        return $this->hasMany(User::class);
    }
}
