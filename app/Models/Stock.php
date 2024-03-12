<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Stock extends Model
{
    protected $table = 'stock';
    protected $fillable = [
        'product_id',
        'product_stock',
    ]; // Assuming the table name is stock_info

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
}
}