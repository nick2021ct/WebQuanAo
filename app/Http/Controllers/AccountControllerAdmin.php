<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifiEmail;
use App\Models\Order;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AccountControllerAdmin extends Controller
{
    public function getFormLogin()
    {
        return view('admin.auth.login');
    }
   
    public function submitFormLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username', $request->username)->where('active', 1)->first();
        if (is_null($user)) {
            toastr()->error('Login failed', 'Error');
            return redirect()->route('adminLogin');
        } else {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('admin.dashboard');
            } else {
                toastr()->error('Login failed', 'Error');
                return redirect()->route('adminLogin');
            }
        }
    }
    public function submitFormLogout(Request $request)
    {
        Auth::logout();
        return redirect()->route('adminLogin');
    }

    //Management
    public function index()
    {
        $accounts = User::withTrashed()->orderByDesc('created_at')->get();
        return view('admin.account.index', compact('accounts'));
    }
    public function create()
    {
        return view('admin.account.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'repeat_password' => 'required|same:password',
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users|max:10|min:10',
            'address' => 'required',
        ]);
        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
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
        toastr()->success('Successfully', 'Created account');
        return redirect()->route('account.index');
    }

}