<?php

namespace App\Http\Controllers;

use App\Models\UserInfoModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function my_account()
    {
        $user = auth()->user();
        $user_info = UserInfoModel::getUserInfo(auth()->user()->id);
        
        $data['getUser'] = $user;
        $data['getUserInfo'] = $user_info;
        

        return view('user.my_account', $data);
    }

   

}
