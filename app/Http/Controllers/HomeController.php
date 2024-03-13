<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        
       

        $data['meta_title'] =  '';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
       
        
        return view('home', $data);
    }
}
