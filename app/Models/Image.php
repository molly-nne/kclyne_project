<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'product_id',
    ];

    
    public function product() // Change method name from posts() to product()
    {
        return $this->hasMany(Products::class); // Specify the foreign key 'product_id'
    }
}
