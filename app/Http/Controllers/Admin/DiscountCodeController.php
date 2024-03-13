<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCodeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountCodeController extends Controller
{
    public function list()
    {
        $data['getRecord'] = DiscountCodeModel::getRecord();
        $data['header_title'] = "Discount Code List";
        return view('admin.discountcode.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Discount Code";
        return view('admin.discountcode.add', $data);
    }

    public function insert(Request $request)
    {

        $color = new DiscountCodeModel;
        $color->name = trim($request->name);
        $color->type = trim($request->type);
        $color->percent_amount = trim($request->percent_amount);
        $color->expire_date = trim($request->expire_date);
        $color->status = trim($request->status);
        $color->save();

        return redirect('admin/discountcode/list')->with('success', "Discount Code successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = DiscountCodeModel::getSingle($id);
        $data['header_title'] = "Edit Discount Code";
        return view('admin.discountcode.edit', $data);
    }

    public function update($id, Request $request)
    {
        // dd($request->all());

        $color = DiscountCodeModel::getSingle($id);
        $color->name = trim($request->name);
        $color->type = trim($request->type);
        $color->percent_amount = trim($request->percent_amount);
        $color->expire_date = trim($request->expire_date);
        $color->status = trim($request->status);
        $color->save();

        return redirect('admin/discountcode/list')->with('success', "Discount Code successfully updated");

    }

    public function delete($id)
    {
        $color = DiscountCodeModel::getSingle($id);
        $color->is_deleted = 1;
        $color->save();

        return redirect()->back()->with('success', "Discount Code successfully deleted");

    }
}
