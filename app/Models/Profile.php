<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'primary',
        'secondary'
    ];

    /*one profile belongs to one user*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function primaryuser()
    {
        return $this->hasMany(User::class);
    }

    public function profile($credentioal)
    {
        $emailParts = explode('@', $credentioal['email']);
        $name = $emailParts[0];
        $profile = Profile::create([
            'user_id' => auth()->user()->id,
            'name'    => $name,
            'email'   => $credentioal['email']
        ]);
    }
}
