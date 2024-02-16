<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

                    if(!empty(request()->get('sub_category_id')))
                    {
                        $sub_category_id = rtrim(request()->get('sub_category_id'), ',');
                        $sub_category_id_array = explode(",", $sub_category_id);
                        $return = $return->whereIn('product.sub_category_id', $sub_category_id_array);
                    }
                    else
                    {
                        if (!empty(request()->get('old_category_id')))
                        {
                             $return = $return->where('product.category_id', '=', request()->get('old_category_id'));
                            
                        }
                        if (!empty(request()->get('old_sub_category_id')))
                        {
                            $return = $return->where('product.sub_category_id', '=', request()->get('old_sub_category_id'));
                            
                        }
                    }

                    if(!empty(request()->get('color_id')))
                    {
                        $color_id = rtrim(request()->get('color_id'), ',');

                        $color_id_array = explode(",", $color_id);
                        $return = $return->join('product_color', 'product_color.product_id', '=', 'product.id');
                        $return = $return->whereIn('product_color.color_id', $color_id_array);
                    }

                    if(!empty(request()->get('brand_id')))
                    {
                        $brand_id = rtrim(request()->get('brand_id'), ',');
                        $brand_id_array = explode(",", $brand_id);
                        $return = $return->whereIn('product.brand_id', $brand_id_array);
                    }

                    if(!empty(request()->get('start_price')) && !empty(request()->get('end_price')))
                    {
                        $start_price = str_replace('$', '', request()->get('start_price') );
                        $end_price = str_replace('$', '', request()->get('end_price') );

                        $return = $return->where('product.price', '>=', $start_price);
                        $return = $return->where('product.price', '<=', $end_price);
                    
                    }

                    $return = $return->where('product.is_deleted', '=', 0)
                    ->where('product.status', '=', 0)
                    ->groupBy('product.id')
                    ->orderBy('product.id','desc')
                    ->paginate(3);

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
