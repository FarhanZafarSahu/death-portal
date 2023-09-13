<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    use HasFactory;
    protected $table = 'profile_user';
    protected $fillable = [
        'user_id ',
        'profile_id ',
        'primary',
        'secondary'
    ];
}
