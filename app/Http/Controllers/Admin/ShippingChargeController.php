<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingChargeModel;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    
    public function list()
    {
        $data['getRecord'] = ShippingChargeModel::getRecord();
        $data['header_title'] = "Shipping Charge List";
        return view('admin.shippingcharge.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Shipping Charge";
        return view('admin.shippingcharge.add', $data);
    }

    public function insert(Request $request)
    {

        $color = new ShippingChargeModel;
        $color->name = trim($request->name);
        $color->price = trim($request->price);
        $color->status = trim($request->status);
        $color->save();

        return redirect('admin/shipping_charge/list')->with('success', "Shipping Charge successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = ShippingChargeModel::getSingle($id);
        $data['header_title'] = "Edit Shipping Charge";
        return view('admin.shippingcharge.edit', $data);
    }

    public function update($id, Request $request)
    {
        // dd($request->all());

        $color = ShippingChargeModel::getSingle($id);
        $color->name = trim($request->name);
        $color->price = trim($request->price);
        $color->status = trim($request->status);
        $color->save();

        return redirect('admin/shipping_charge/list')->with('success', "Shipping Charge successfully updated");

    }

    public function delete($id)
    {
        $color = ShippingChargeModel::getSingle($id);
        $color->is_deleted = 1;
        $color->save();

        return redirect()->back()->with('success', "Shipping Charge successfully deleted");

    }
}
