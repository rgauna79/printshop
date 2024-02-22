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
    public function getProductSearch(Request $request)
    {
        // dd( $data['getSubCategoryFilter']);
        $data['meta_title'] =  'Search';
        $data['meta_description'] = "";
        $data['meta_keywords'] = "";

        $getProduct = ProductModel::getProduct();
        // dd($getProduct->nextPageUrl());
        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct->nextPageUrl());
            
            if (!empty($parse_url['query']))
            {
                
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }
        $data['getColor'] = ColorModel::getRecordActive();
        $data['getBrand'] = BrandModel::getRecordActive();
        
        $data['page'] = $page;
        $data['getProduct'] = $getProduct;

        return view('product.list', $data);
    }
    
    public function getCategory($slug, $subSlug = '')
    {
        $getProductSingle = ProductModel::getSingleSlug($slug);


        $getCategory = CategoryModel::getSingleSlug($slug);
        $getSubCategory = SubCategoryModel::getSingleSlug($subSlug);

        $data['getColor'] = ColorModel::getRecordActive();
        $data['getBrand'] = BrandModel::getRecordActive();
        
        if (!empty($getProductSingle))
        {
            $data['meta_title'] =  $getProductSingle->title;
            $data['meta_description'] = $getProductSingle->short_description;
            $data['getProduct'] = $getProductSingle;
            $data['getRelatedProduct'] = ProductModel::getRelatedProduct($getProductSingle->id, $getProductSingle->sub_category_id);

            return view('product.detail', $data);
        }
        else if (!empty($getCategory) && !empty($getSubCategory))
        {
            $data['getSubCategoryFilter'] = SubCategoryModel::getRecordSubCategory($getCategory->id);

            $data['meta_title'] =  $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;
            
            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;

            $getProduct = ProductModel::getProduct($getCategory->id, $getSubCategory->id);
            
            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl());
                
                if (!empty($parse_url['query']))
                {
                    
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }

            $data['page'] = $page;

            $data['getProduct'] = $getProduct;

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

            $getProduct = ProductModel::getProduct($getCategory->id);
            // dd($getProduct->nextPageUrl());
            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {
                $parse_url = parse_url($getProduct->nextPageUrl());
                
                if (!empty($parse_url['query']))
                {
                    
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }

            $data['page'] = $page;
            $data['getProduct'] = $getProduct;

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
        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {
            $parse_url = parse_url($getProduct->nextPageUrl());
            
            if (!empty($parse_url['query']))
            {
                
                parse_str($parse_url['query'], $get_array);
                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }


        return response()->json([
            "status" => true,
            "page" => $page,
            "success" => view("product._list", [
                "getProduct" => $getProduct,
        ])->render(),

        ], 200);

    }
}
