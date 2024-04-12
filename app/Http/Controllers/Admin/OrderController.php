<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Order List";
        $data['getRecord'] = OrderModel::getRecord();

        return view('admin.orders.list', $data);
    }

    public function detail($id)
    {
        $data['header_title'] = "Order Detail";
        $data['getRecord'] = OrderModel::getSingle($id);

        return view('admin.orders.detail', $data);
    }
}
