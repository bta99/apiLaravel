<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image_prods extends Model
{
    use HasFactory;


    protected $table = 'image_prods';
    protected $fillable = [
        'id', 'image', 'product_id'
    ];
}
