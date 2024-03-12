<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Stock;

class Products extends Model

{
    protected $table = 'product';
    protected $fillable = [
        'product_name',
        'description',
        'supplier_price',
        'seller_retail_price',
        'stock',
        'category',
        'cover',
    ];

    public function images(){
        return $this->hasMany(Image::class, 'product_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }
}

