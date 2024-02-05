<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'product';


    static public function getRecord()
    {
        return self::select('product.*', 'users.name as created_by_name')
                    ->join('users', 'users.id', '=', 'product.created_by')
                    ->where('product.is_deleted', '=', 0)
                    ->orderBy('product.id','desc')
                    ->paginate(50);
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getProduct($category_id = '', $sub_category_id = '')
    {
        $return = ProductModel::select('product.*', 
                    'users.name as created_by_name', 
                    'category.name as category_name', 
                    'category.slug as category_slug', 
                    'sub_category.name as sub_category_name', 
                    'sub_category.slug as sub_category_slug')
                    ->join('users', 'users.id', '=', 'product.created_by')
                    ->join('category', 'category.id', '=', 'product.category_id')
                    ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id');
                   
                    if (!empty($category_id))
                    {
                         $return = $return->where('product.category_id', '=', $category_id);
                        
                    }
                    if (!empty($sub_category_id))
                    {
                        $return = $return->where('product.sub_category_id', '=', $sub_category_id);

                    }
                    $return = $return->where('product.is_deleted', '=', 0)
                    ->where('product.status', '=', 0)
                    ->orderBy('product.id','desc')
                    ->paginate(2);

        return $return;
    }
    
    static public function getImageSingle($product_id)
    {
        return ProductImage::where('product_id','=', $product_id)->orderBy('order_by', 'asc')->first(); 
    }

    static public function checkSlug($slug)
    {
        return self::where('slug', '=', $slug)->count();
    }

    public function getColor()
    {
        return $this->hasMany(ProductColorModel::class, "product_id");
    }

    public function getSize()
    {
        return $this->hasMany(ProductSizeModel::class, "product_id");
    }

    public function getImage()
    {
        return $this->hasMany(ProductImage::class, "product_id")->orderBy('order_by', 'asc');
    }
}
