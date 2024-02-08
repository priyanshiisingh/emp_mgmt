<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'name',
        'status',
    ];
}
