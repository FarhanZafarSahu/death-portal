<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'profile_id'
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


    /*one user has many profiles*/
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function primaryprofile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    public function userFormdata()
    {
        return $this->hasMany(UserFormData::class);
    }

    public function register($credentioal)
    {
        if (preg_match("/^(.+)@/", $credentioal['email'], $matches)) {
            $name = $matches[1];
        }
        $user = User::create([
            'first_name' => $name,
            'email'      => $credentioal['email'],
            'password'   => Hash::make($credentioal['password'])
        ]);
    }
}
