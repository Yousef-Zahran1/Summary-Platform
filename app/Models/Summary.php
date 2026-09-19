<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function savers() {
        return $this->belongsToMany(User::class , 'saved' , 'summary_id' , 'user_id');
    }
    public function likers() {
        return $this->belongsToMany(User::class , 'likes' , 'summary_id' , 'user_id');
    }
    public function downloads()
    {
        return $this->belongsToMany(User::class , 'downloads' , 'summary_id', 'user_id')->withTimestamps();;
    }
    protected $fillable = [
        'title',
        'file_path',
        'user_id',
        'subject_id',
        'description'
    ];
}
