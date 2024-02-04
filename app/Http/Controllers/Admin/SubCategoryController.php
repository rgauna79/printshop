<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    
    public function list()
    {
        $data['getRecord'] = SubCategoryModel::getRecord();
        $data['header_title'] = "Sub Category";
        return view('admin.subcategory.list', $data);
    }

    public function add()
    {
        $data['getCategory'] = CategoryModel::getRecord();
        $data['header_title'] = "Add New Sub Category";
        return view('admin.subcategory.add', $data);
    }

    public function insert(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'slug' => 'required|unique:sub_category,slug,',
            'category_id' => 'required'
        ]);

        $subcategory = new SubCategoryModel;
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

        return redirect('admin/subcategory/list')->with('success', "Sub Category successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = SubCategoryModel::getSingle($id);
        $data['getCategory'] = CategoryModel::getRecord();
        $data['header_title'] = "Edit Sub Category";
        return view('admin.subcategory.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:sub_category,slug,'.$id,
            'category_id' => 'required'
        ]);

        $subcategory = SubCategoryModel::getSingle($id);
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->save();

        return redirect('admin/subcategory/list')->with('success', "Sub Category successfully updated");

    }

    public function delete($id)
    {
        $subcategory = SubCategoryModel::getSingle($id);
        $subcategory->is_deleted = 1;
        $subcategory->save();

        return redirect()->back()->with('success', "Sub Category successfully deleted");

    }

    public function get_sub_category(Request $request)
    {
        $category_id = $request->id;
        $get_sub_category = SubCategoryModel::getRecordSubCategory($category_id);
        $html = '';
        $html .= '<option value="">Select</option>';
        foreach ($get_sub_category as $value) {
            $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        $json['html'] = $html;
        echo json_encode($json);
    }
}
