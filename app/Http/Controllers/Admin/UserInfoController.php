<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserInfoController extends Controller
{

    public function get_user_address(Request $request)
    {
        $userId = auth()->user()->id;

        $user = UserInfoModel::getUserInfo($userId);

        return response()->json($user);
        
    }

    public function update_user_address(Request $request)
    {
        $userId = auth()->user()->id;
        // check if the user already has an address
        if(!empty(UserInfoModel::getUserInfo($userId))) {
            // dd('User already has an address');
            $user = UserInfoModel::getUserInfo($userId);
            $user->phone = $request->phone;
            if(!empty($request->company_name))
            {
                $user->company_name = $request->company_name;
            }
            $user->address_1 = $request->address_1;
            if(!empty($request->address_2))
            {
                $user->address_2 = $request->address_2;
            }
            $user->country = $request->country;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->zip_code = $request->zip_code;
            $user->note = $request->note;
            $user->save();

            return redirect()->back()->with('success', 'User address successfully updated');
        }
        else
        {
            $user = new UserInfoModel();
            $user->user_id = $userId;
            if(!empty($request->company_name))
            {
                $user->company_name = $request->company_name;
            }
            $user->phone = $request->phone;
            $user->address_1 = $request->address_1;
            if(!empty($request->address_2))
            {
                $user->address_2 = $request->address_2;
            }
            $user->country = $request->country;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->zip_code = $request->zip_code;
            $user->note = $request->note;
            // Get user email
            $user->email = auth()->user()->email;
            $user->save();

            // return response with success message
            return redirect()->back()->with('success', 'User address successfully updated');
        }

    }

    function update_user_profile(Request $request)
    {
        $userId = auth()->user()->id;

        $user = User::getSingle($userId);

        if(!empty($user))
        {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            if($request->email != $user->email)
            {
                request()->validate(['email' => 'required|unique:users,email'.$user->id]);
                $user->email = $request->email;
            }
            if(!empty($request->current_password))
            {
                if($request->new_password != $request->confirm_password)
                {
                    return redirect()->back()->with('error_password', 'New password and confirm password does not match');
                }
                if(!Hash::check($request->current_password, $user->password))
                {
                    return redirect()->back()->with('error_password', 'Current password is incorrect');
                }
                $user->password = Hash::make($request->new_password);
            }
            // dd($user);
            $user->save();
        }

        return redirect()->back()->with('success_update_profile', 'User profile successfully updated');


    }

    
}
