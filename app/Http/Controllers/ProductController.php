<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\SubCategoryModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getCategory($slug, $subSlug = '')
    {
        $getCategory = CategoryModel::getSingleSlug($slug);
        $getSubCategory = SubCategoryModel::getSingleSlug($subSlug);

        if (!empty($getCategory) && !empty($getSubCategory))
        {
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
}
