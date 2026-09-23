<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'bio',
        'basic_department_id',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function basic_department(){
        return $this->BelongsTo(BasicDepartment::class);
    }
    public function summaries(){
        return $this->hasMany(Summary::class);
    }
    public function savedSummaries(){
        return $this->belongsToMany(Summary::class , 'saved' , 'user_id' , 'summary_id');
    }
    public function likedSummaries(){
        return $this->belongsToMany(Summary::class , 'likes' , 'user_id' , 'summary_id');
    }
    public function downloads()
    {
        return $this->belongsToMany(Summary::class , 'downloads' , 'user_id' , 'summary_id')->withTimestamps();;
    }
}
