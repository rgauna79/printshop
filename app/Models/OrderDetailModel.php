<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
    use HasFactory;

    protected $table = 'orders_detail';

    public function getProduct()
    {
        return $this->belongsTo(ProductModel::class,  'product_id');
    }

    public function getColor()
    {
        return $this->belongsTo(ColorModel::class, 'product_color_id');
    }

    public function getSize()
    {
        return $this->belongsTo(ProductSizeModel::class, 'product_size_id');
    }
}
