<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'profile_image',
        'status',
        'department'
    ];
}
