<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Summary extends Model
{
    use SoftDeletes;
    protected static function booted()
    {
        static::deleting(function ($summary) {
            if (!$summary->isForceDeleting()) {
                $summary->deleted_by = auth()->id();
                $summary->saveQuietly(); 
            }
        });
    }
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
        'file_size', 
        'file_path',
        'user_id',
        'status',
        'subject_id',
        'description',
        'submission_token',
    ];
}
