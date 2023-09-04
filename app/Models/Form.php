<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'visibility',
        'status'
    ];

    public function formFields()
    {
        return $this->hasMany(FormField::class);
    }

    public function userFormdata()
    {
        return $this->hasMany(UserFormData::class);
    }
}
