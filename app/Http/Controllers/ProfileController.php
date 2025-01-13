<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Comment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function information()
    {
        $user = User::find(Auth::id());
        $orders = Order::where('idUser',Auth::id());
        $pending = $orders->where('status', 1)->count();
        $professing = $orders->where('status', 2)->count();
        $shipped = $orders->where('status', 3)->count();
        $rated = Comment::where('idUser',Auth::id());
        $ratedCount = $rated->count();
        return view('profile.personalInfo',compact('user','pending','professing','shipped','ratedCount'));
    }

    public function changeInfo(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'required|digits_between:10,15',
            'address' => 'nullable|string|max:500',
        ]);

        $info = User::find(Auth::id());
        $info->fullname = $request->fullname;
        $info->email = $request->email;
        $info->phone = $request->phone;
        $info->address = $request->address;
        $info->save();
        toastr()->success('Đổi thông tin người dùng thành công','Success');
        return redirect()->back();
    }

    public function address()
    {
        $addresses = Address::where('idUser',Auth::id())->get();
        return view('profile.address', compact('addresses'));
    }

    public function addAddress(Request $request)
    {
        $addressCount = Address::where('idUser',Auth::id())->count();
        if($addressCount  >= 5){
            toastr()->error('Bạn chỉ được lưu tối đa 5 địa chỉ','Error');
            return redirect()->back();
        }else{
            $address = new Address;
            $address->idUser = Auth::id();
            $address->fullname = $request->fullname;
            $address->phone = $request->phone;
            $address->address = $request->address;
            $address->address_type = $request->address_type;
            $address->zip_code = $request->zip_code;
            $address->save();
            toastr()->success('Thêm địa chỉ thành công','Success');
            return redirect()->back();
        }
    }

    public function editAddress(Request $request,$id)
    {
        $address = Address::find($id);
        $address->idUser = Auth::id();
        $address->fullname = $request->fullname;
        $address->phone = $request->phone;
        $address->address = $request->address;
        $address->address_type = $request->address_type;
        $address->zip_code = $request->zip_code;
        $address->save();
        toastr()->success('Sửa địa chỉ thành công','Success');
        return redirect()->back();
    }

    public function deleteAddress($id)
    {
        $address = Address::find($id);
        $address->delete();
        toastr()->success('Xóa địa chỉ thành công','Success');
        return redirect()->back();
    }

    public function password()
    {
        return view('profile.changePassword');
        
    }
    public function changePassword(Request $request)
    {
        $user = User::find(Auth::id());
        if(Hash::check($request->old_password, $user->password)){
            $user->password = bcrypt($request->new_password);
            $user->save();
            toastr()->success('Đổi mật khẩu thành công','Success');
            return redirect()->back();
        }else{
            toastr()->error('Mật khẩu cũ không đúng','Error');
            return redirect()->back();
            }
        
    }
}
