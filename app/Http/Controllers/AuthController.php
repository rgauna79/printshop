<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login_admin()
    {
        if (!empty(Auth::check()) && Auth::user()->is_admin == 1) {
            return redirect('admin/dashboard');
        } else {
            # code...
        }
        
        return view('admin.auth.login');
    }

    public function login_user(Request $request)
    {
        $remember = !empty($request->is_remember) ? true : false;

        if(Auth::attempt(['email' => $request->singin_email, 'password' => $request->singin_password, 'is_admin' => 0, 'status' => 0, 'is_deleted' => 0], $remember))
        {
            if(!empty(Auth::user()->email_verified_at))
            {
                return redirect()->back()->with('success_signin', "Login successfully");
            }
            else
            {
                $save = User::getSingle(Auth::user()->id);
                Mail::to($save->email)->send(new RegisterMail($save));
                Auth::logout();

                return redirect()->back()->with('error_signin', "Your account is not verified. Please verify your email");
            }
        }
        else
        {
            return redirect()->back()->with('error_signin', "Incorrect email or password ");
        }
    }

    public function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1,
         'status' => 0, 'is_deleted' => 0], 
        $remember))
        {
            return redirect('admin/dashboard');
        }
        else
        {
            return redirect()->back()->with('error', "Incorrect email or password ");
        }
    }

    public function logout_admin()
    {
        Auth::logout();
        return redirect('admin');
    }

    public function logout_user()
    {
        Auth::logout();
        return redirect('/');
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
    
            Mail::to($user->email)->send(new RegisterMail($user));

            return redirect('/')->with('success_register', "User successfully created, Please verify your email address");
    
        } catch (\Exception $th) {
            return redirect('/')->with('error_register', $th->getMessage())->withInput();
        }
        
    }
    public function activate_email($id)
    {
        $id = base64_decode($id);

        $user = User::getSingle($id);

        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect(url('/'))->with('success_email', "Email successfully verified, please login");

    }

    public function forgot_password(Request $request)
    {
        $data['meta_title'] = "Forgot Password";
        return view('auth.forgot_password', $data);
    }

    public function user_forgot_password(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();

        if(!empty($user))
        {
            $user->remember_token = Str::random(30);
            // dd($user);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', "Email successfully sent, please check your email");
        }
        else
        {
            return redirect()->back()->with('error', "Email not found");
        }
    }

    public function reset_password($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        // dd($user);
        if(!empty($user))
        {
            $data['user'] = $user;
            $data['meta_title'] = "Reset Password";
            return view('auth.reset', $data);
        }
        else
        {
            abort (404);
        }
    }
    
    public function user_reset($token, Request $request)
    {
        
        if($request->password == $request->confirm_password)
        {
            $user = User::where('remember_token', '=', $token)->first();
            // dd($user);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            return redirect(url('/'))->with('success_reset', "Password successfully changed, please login");
        }
        else
        {
            return redirect()->back()->with('error', "Password not matched");
        }
    }
}
