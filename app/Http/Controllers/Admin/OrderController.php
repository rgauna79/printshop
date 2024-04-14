<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusMail;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function order_status(Request $request)
    {
        $getOrder = OrderModel::getSingle($request->order_id);
        $getOrder->status = $request->status;
        $getOrder->save();

        Mail::to($getOrder->email)->send(new OrderStatusMail($getOrder));

        $json['status'] = true;
        $json['message'] = "Order status successfully updated";

        echo json_encode($json);
    }
}
