<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\SubCategoryModel;
use App\Models\ColorModel;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function getCategory($slug, $subSlug = '')
    {
        $getCategory = CategoryModel::getSingleSlug($slug);
        $getSubCategory = SubCategoryModel::getSingleSlug($subSlug);

        $data['getColor'] = ColorModel::getRecordActive();
        $data['getBrand'] = BrandModel::getRecordActive();
        
        if (!empty($getCategory) && !empty($getSubCategory))
        {
            $data['getSubCategoryFilter'] = SubCategoryModel::getRecordSubCategory($getCategory->id);

            $data['meta_title'] =  $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;
            
            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;

            $data['getProduct'] = ProductModel::getProduct($getCategory->id, $getSubCategory->id);
            
            return view('product.list', $data);
        }            
        else if (!empty($getCategory))
        {

            $data['getSubCategoryFilter'] = SubCategoryModel::getRecordSubCategory($getCategory->id);

            // dd( $data['getSubCategoryFilter']);
            $data['meta_title'] =  $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;
            
            $data['getCategory'] = $getCategory;

            $data['getProduct'] = ProductModel::getProduct($getCategory->id);
            
            return view('product.list', $data);
        }
        else
        {
            abort(404);
        };
    }

    public function getFilterProductAjax(Request $request)
    {
        $getProduct = ProductModel::getProduct();
        // dd($getProduct);
        return response()->json([
            "status" => true,
            "success" => view("product._list", [
                "getProduct" => $getProduct,
        ])->render(),

        ], 200);

    }
}
