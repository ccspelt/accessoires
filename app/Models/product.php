<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'model',
        'stock',
        'product_type',
        'brand',
        
    ];
    protected $table = 'externalproducts';
    use HasFactory;
}
