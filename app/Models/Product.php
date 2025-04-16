<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'id',
        'type',
        'name',
        'price',
        'volume',
        'description',
        'ingredients',
        'image1',
        'image2',
        'scent'
    ];
}