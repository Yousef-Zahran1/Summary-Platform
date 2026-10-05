<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function subjects(){
        return $this->hasMany(Subject::class);
    }
    public function summaries(){
        return $this->hasManyThrough(Summary::class , Subject::class);
    }
    protected $fillable=[
        'name'
    ];
}
