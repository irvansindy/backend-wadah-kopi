<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'description',
        'image',
        // 'stock',
        // 'discount',
        // 'brand_id',
        // 'slug',
    ];

    protected $hidden = [];
}