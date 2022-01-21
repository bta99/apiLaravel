<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color_prods extends Model
{
    use HasFactory;


    protected $table = 'color_prods';
    protected $fillable = [
        'id', 'color', 'price', 'sales_price', 'stock', 'image', 'product_id'
    ];
}
