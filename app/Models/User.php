<?php

namespace App\Models;

use App\Models\statususer;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


     public function statususer()
     {
        return $this->hasOne(statususer::class,'id','status_id');
     }

    protected $fillable = [
        'username',
        'slug',
        'password',
        'email',
        'email_verified_at', // kapan verification
        'verification_token', // token untuk verification
        'phonenumber',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $attributes =[
        'role_id' => 2 //membuat dimana yang bisa mendaftar hanya client
    ];
    public function Sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }
    
}
