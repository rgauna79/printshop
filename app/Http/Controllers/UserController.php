<?php

namespace App\Http\Controllers;

use App\Models\UserInfoModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function my_account()
    {
        $user = UserInfoModel::getUserInfo(auth()->user()->id);


        $data['getUserInfo'] = $user;
        

        return view('user.my_account', $data);
    }

   

}
