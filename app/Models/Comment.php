<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $table = 'comments';
    protected $fillable = [
        'id', 'content', 'rating', 'account_id', 'product_id'
    ];
}
