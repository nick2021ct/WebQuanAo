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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.account.edit', compact('user'));
    }
    //update account
    public function update($id, Request $request)
    {
        $request->validate([
            'username' => 'required',
            // 'password' => 'required',
            // 'repeat_password' => 'required|same:password',
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:10|min:10',
            'address' => 'required',
        ]);
        $data = [
            'username' => $request->username,
            // 'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            // 'role' => $request->role,
        ];
        User::where('id', $id)->update($data);
        $user = User::findOrFail($id);
        //set lại quyền cho tk nhân viên
        $roles = ['Account', 'Category', 'Brand', 'Product', 'Banner', 'Voucher', 'Blog'];
        $actions = ['show', 'add', 'update', 'delete'];
        $permission = [];
        $revokePermission = [];
        foreach ($roles as $role) {
            foreach ($actions as $action) {
                array_push($revokePermission, $action . $role);
                if ($request->input($action . $role) == 'on') {
                    array_push($permission, $action . $role);
                }
            }
        }
        $user->revokePermissionTo($revokePermission);
        $user->givePermissionTo($permission);
        toastr()->success('Successfully', 'Updated account');
        return redirect()->route('account.index');
    }
    public function destroy($id)
    {
        //Không thể tự block chính mình
        if (Auth::user()->id == $id) {
            toastr()->error('Unachievable', "You can't block yourself");
            return redirect()->route('account.index');
        }
        User::where('id', $id)->delete();
        toastr()->success('Successfully', 'Blocked account');
        return redirect()->route('account.index');
    }

    public function updadtee($id)
    {
        //Không thể tự block chính mình
        if (Auth::user()->id == $id) {
            toastr()->error('Unachievable', "You can't block yourself");
            return redirect()->route('account.index');
        }
        User::where('id', $id)->delete();
        toastr()->success('Successfully', 'Blocked account');
        return redirect()->route('account.index');
    }
    public function unblock($id)
    {
        User::where('id', $id)->restore();
        toastr()->success('Successfully', 'Unblocked account');
        return redirect()->route('account.index');
    }
    public function getFormCreateStaff()
    {
        return view('admin.account.createStaff');
    }
    
    
    
    public function submitFormCreateStaff(Request $request)
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
            'role' => 2,
        ];
        $user = User::create($data);
        // dd($user);
        $token = Str::random(32);
        User::where('email', $request->email)->update(['token' => $token]);
        $information = [
            'name' => $request->fullname,
            'email' => $request->email,
            'token' => $token
        ];
        Mail::to($request->email)->send(new VerifiEmail($information));
        //set quyền cho tk nhân viên
        $roles = ['Account', 'Category', 'Brand', 'Product', 'Banner', 'Voucher'];
        $actions = ['show', 'add', 'update', 'delete'];
        $permission = [];
        foreach ($roles as $role) {
            foreach ($actions as $action) {
                if ($request->input($action . $role) == 'on') {
                    array_push($permission, $action . $role);
                }
            }
        }
        $user->givePermissionTo($permission);
        toastr()->success('Successfully', 'Created account');
        return redirect()->route('admin.account.createStaff');
    }
}