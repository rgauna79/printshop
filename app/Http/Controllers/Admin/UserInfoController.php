<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReviewModel;
use App\Models\ProductWhishlistModel;
use App\Models\User;
use App\Models\UserInfoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserInfoController extends Controller
{

    public function profile()
    {
        $userId = auth()->user()->id;

        $data['getUserInfo'] = UserInfoModel::getUserInfo($userId);
        $data['getUser'] = auth()->user();

        $data['header_title'] = "Profile";

        return view('user.detail', $data);
    }

    public function address()
    {
        $userId = auth()->user()->id;

        $data['getUserInfo'] = UserInfoModel::getUserInfo($userId);

        $data['header_title'] = "Address";

        return view('user.address', $data);
    }

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
        if (!empty(UserInfoModel::getUserInfo($userId))) {
            // dd('User already has an address');
            $user = UserInfoModel::getUserInfo($userId);
            $user->phone = $request->phone;
            if (!empty($request->company_name)) {
                $user->company_name = $request->company_name;
            }
            $user->address_1 = $request->address_1;
            if (!empty($request->address_2)) {
                $user->address_2 = $request->address_2;
            }
            $user->country = $request->country;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->zip_code = $request->zip_code;
            $user->note = $request->note;
            $user->save();

            return redirect()->back()->with('success', 'User address successfully updated');
        } else {
            $user = new UserInfoModel();
            $user->user_id = $userId;
            if (!empty($request->company_name)) {
                $user->company_name = $request->company_name;
            }
            $user->phone = $request->phone;
            $user->address_1 = $request->address_1;
            if (!empty($request->address_2)) {
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

        $validate = 0;
        $userId = auth()->user()->id;

        $user = User::getSingle($userId);

        if (!empty($user)) {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            if ($request->email != $user->email) {
                request()->validate(['email' => 'required|unique:users,email' . $user->id]);
                $user->email = $request->email;
            }
            if (!empty($request->current_password)) {
                if ($request->new_password != $request->confirm_password) {
                    $json['success'] = false;
                    $json['message'] = 'New password and confirm password does not match';
                    $validate = 1;
                    echo json_encode($json);
                    die;
                    // return redirect()->back()->with('error_password', 'New password and confirm password does not match');
                }
                if (!Hash::check($request->current_password, $user->password)) {
                    $json['success'] = false;
                    $json['message'] = 'Current password is incorrect';
                    $validate = 1;
                    echo json_encode($json);
                    die;
                    // return redirect()->back()->with('error_password', 'Current password is incorrect');
                }
                $user->password = Hash::make($request->new_password);
            }
            // dd($user);
            if ($validate == 0) {
                $user->name = $request->name;
                $user->save();
                $json['success'] = true;
                $json['message'] = 'User profile successfully updated';
            }
            // 
        }


        echo json_encode($json);

        // return redirect()->back()->with('success_update_profile', 'User profile successfully updated');


    }

    public function add_to_wishlist(Request $request)
    {
        $check = ProductWhishlistModel::checkProduct($request->product_id, auth()->user()->id);

        if (!empty($check)) {
            ProductWhishlistModel::deleteRecord($request->product_id, auth()->user()->id);
            $json['is_wishlisted'] = 0;
        } else {
            $save = new ProductWhishlistModel();
            $save->user_id = auth()->user()->id;
            $save->product_id = $request->product_id;
            $save->save();

            $json['is_wishlisted'] = 1;
        }
        $json['status'] = true;

        echo json_encode($json);
    }

    public function make_review(Request $request)
    {
        $save = new ProductReviewModel(); 
        $save->user_id = auth()->user()->id;
        $save->order_id = trim($request->order_id);
        $save->product_id = trim($request->product_id);
        $save->review = trim($request->review);
        $save->rating = trim($request->rating);
        $save->save();

        return redirect()->back()->with('success', 'Thank you for your review');

    }

}
