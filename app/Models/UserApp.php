<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserApp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users_apps';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_active',
    ];
}
