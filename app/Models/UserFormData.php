<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFormData extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'form_id',
        'user_id',
        'data'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
