<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function my_account()
    {
        return view('user.my_account');
    }
}
