<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function summaries(){
        return $this->hasMany(Summary::class);
    }
    protected $fillable = [
        'name',
        'code',
        'department_id'
    ];
}
