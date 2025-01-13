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
use Laravel\Socialite\Facades\Socialite;

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
            'username' => strtolower($request->username),
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
        toastr()->success('Success', 'Đăng ký thành công, vui lòng xác minh email của bạn');

        return redirect()->route('login');
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
            toastr()->error('error', 'Tài khoản chưa tồn tại');

            return redirect()->back();
        }else{
            if(Hash::check($request->password, $user->password)){
                Auth::login($user);
                return redirect('/');
            }else{
                toastr()->error('error', 'Sai password');
                return redirect()->back();
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

            $token = Str::random(32);

            User::where('email', $request->email)->update([
                'token' => $token,
            ]);
            $data = [
                'name' => $account->fullname,
                'id' => $account->id,
                'token' => $token
            ];
            
            Mail::to($account->email)->send(new ForgotPassword($data));
            toastr()->success('success', 'Email đã được gửi thành công');
            return redirect()->back();
        }else{
            toastr()->error('error', 'Tài khoản đã bị khóa');
            return redirect()->back();
        }
    }
    public function getFormNewPassword(Request $request){
        $token = User::where('id', $request->id)->first()->token;
        if($token == $request->token){
            return view('auth.newPassword')->with('id', $request->id);
        }else{
            toastr()->error('error', 'Liên kết đã hết hạn');
            return redirect()->route('forgotPassword');
        }
    }
    public function submitFormNewPassword(Request $request, $id){
        $request->validate([
            'password' =>' required',
            'repeat_password' => 'required|same:password'
        ]);
        User::where('id', $id)->update(['password' => Hash::make($request->password)]);
        toastr()->success('success', 'Thay đổi mật khẩu thành công');
        return redirect()->route('login');
    }
    public function verifiEmail(Request $request){
        $token = User::where('email', $request->email)->first()->token;
        if($token == $request->token){
            User::where('email', $request->email)->update(['active' => 1]);
            toastr()->success('success', 'Xác thực thành công, vui lòng đăng nhập');
            return redirect()->route('login');
        }else{
            toastr()->error('error', 'Liên kết đã hết hạn');
            return redirect()->route('login');
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver(driver: 'google')->redirect();
    }

    public function callbackGoogle()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            Auth::login($existingUser);
            return redirect()->route('home');
            } else {
                // dd($user);
                $newUser = User::create([
                    'username'=>Str::random(10),
                    'password' => bcrypt('12345678'),
                    'fullname' => $user->name,
                    'email' => $user->email,
                    'role'=>0,
                    'token' => Str::random(60),
                    'active' => 1,
                    ]);
                    Auth::login($newUser);
                    return redirect()->route('home');
                    }
    }
}