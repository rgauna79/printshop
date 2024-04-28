<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\User;
use App\Models\UserInfoModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function my_account()
    {
        $user = auth()->user();
        $user_info = UserInfoModel::getUserInfo(auth()->user()->id);
        
        $data['meta_title'] =  'My Account';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getUser'] = $user;
        $data['getUserInfo'] = $user_info;
        $data['getTotalOrders'] = OrderModel::getTotalUserOrder(auth()->user()->id);
        $data['getTodayOrders'] = OrderModel::getTodayUserOrder(auth()->user()->id);
        $data['getInProgressOrders'] = OrderModel::getInProgressUserOrder(auth()->user()->id);
        $data['getPendingOrders'] = OrderModel::getPendingUserOrder(auth()->user()->id);

        return view('user.my_account', $data);
    }

    public function orders()
    {
        $user = auth()->user();
        $user_info = UserInfoModel::getUserInfo(auth()->user()->id);
        
        $data['meta_title'] =  'Orders';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $data['getUser'] = $user;
        $data['getUserInfo'] = $user_info;
        $data['getRecord'] = OrderModel::getRecordUser(auth()->user()->id);

        return view('user.orders', $data);
    }

    public function order_detail($id)
    {
        $data['getRecord'] = OrderModel::getSingleUser(auth()->user()->id,$id);
        if (empty($data['getRecord'])) {
            abort(404);
        }
        else
        {
        $data['meta_title'] =  'Order Detail';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('user.order_detail', $data);

        }
    }


}
