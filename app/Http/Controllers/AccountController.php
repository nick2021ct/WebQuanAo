<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use App\Mail\VerifiEmail;

class AccountController extends Controller
{
    public function getFormRegister(){
        return view('auth.register');
    }
    public function submitFormRegister(Request $request){
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'repeat_password' => 'required|same:password',
            'email' => 'required|unique:users|email',
            'fullname' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:users|min:10|max:10',
        ]);
        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'fullname' => $request->fullname,
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 0,
            'active' => 0
        ];
        User::create($data);
        $token = Str::random(32);
        User::where('email', $request->email)->update(['token' => $token]);
        $information = [
            'name' => $request->fullname,
            'email' => $request->email,
            'token' => $token
        ];
        Mail::to($request->email)->send(new VerifiEmail($information));
        return redirect()->route('login')->with('success', 'Successful registration, please verify your email');
    }
    public function getFormLogin(){
        return view('auth.login');
    }
    public function submitFormLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username', $request->username)->where('active', 1)->first();
        if(is_null($user)){
            return redirect()->back()->with('error', 'The account does not exist yet');
        }else{
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
                return redirect('/');
            }else{
                return redirect()->back()->with('error', 'Wrong password');
            }
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function getFormForgotPassword(){
        return view('auth.forgotPassword');
    }
    public function submitFormForgotPassword(Request $request){
        $request->validate([
            'email' => 'required|exists:users'
        ]);
        $account = User::where('email', $request->email)->where('active', 1)->first();
        if($account){
            //tạo token
            $token = Str::random(32);
            //cập nhật vào bản ghi
            User::where('email', $request->email)->update([
                'token' => $token,
            ]);
            $data = [
                'name' => $account->fullname,
                'id' => $account->id,
                'token' => $token
            ];
            //gửi mail
            Mail::to($account->email)->send(new ForgotPassword($data));
            return redirect()->back()->with('success', 'Email sent successfully');
        }else{
            return redirect()->back()->with('error', 'Account has been locked');
        }
    }
    public function getFormNewPassword(Request $request){
        $token = User::where('id', $request->id)->first()->token;
        if($token == $request->token){
            return view('auth.newPassword')->with('id', $request->id);
        }else{
            return redirect()->route('forgotPassword')->with('error', 'The link has expired');
        }
    }
    public function submitFormNewPassword(Request $request, $id){
        $request->validate([
            'password' =>' required',
            'repeat_password' => 'required|same:password'
        ]);
        User::where('id', $id)->update(['password' => Hash::make($request->password)]);
        return redirect()->route('login')->with('success', 'Change password successfully');
    }
    public function verifiEmail(Request $request){
        $token = User::where('email', $request->email)->first()->token;
        if($token == $request->token){
            User::where('email', $request->email)->update(['active' => 1]);
            return redirect()->route('login')->with('success', 'Authentication successful, please login');
        }else{
            return redirect()->route('login')->with('error', 'The link has expired');
        }
    }
}