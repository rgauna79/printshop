<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = "Admin";
        return view('admin.admin.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Admin";
        return view('admin.admin.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfully created");
    }

    public function insert_user(Request $request)
    {
        try {
            request()->validate([
                'email' => 'required|email|unique:users'
            ]);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            // $user->status = $request->status;
            $user->is_admin = 0;
            $user->save();
    
            return redirect('/')->with('success', "User successfully created, Please login with your credentials");
    
        } catch (\Exception $th) {
            return redirect('/')->with('error_register', $th->getMessage())->withInput();
        }
        
      

    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['header_title'] = "Edit Admin";
        return view('admin.admin.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfully updated");
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_deleted = 1;
        $user->save();

        return redirect()->back()->with('success', "Admin successfully deleted");

    }
}
