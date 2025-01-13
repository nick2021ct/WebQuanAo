@extends('layouts.appAdmin')
@section('title')
    Chỉnh sửa tài khoản({{ $user->username }})
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Chỉnh sửa tài khoản</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('account.update', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $user->username }}">
                                    @error('username')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                      
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên đầy đủ</label>
                                    <input type="text" name="fullname" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $user->fullname }}">
                                    @error('fullname')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ $user->email }}">
                                        @error('email')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ $user->phone }}">
                                        @error('phone')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                                    <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $user->address }}">
                                    @error('address')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if ($user->role != 0)
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Chức năng sử dụng</label>
                                        <div class="row">
                                            <div class="col-2">
                                                Account <br>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="showAccount"
                                                        @if ($user->hasPermissionTo('showAccount')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Show</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="addAccount"
                                                        @if ($user->hasPermissionTo('addAccount')) checked @endif>
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Add</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="updateAccount"
                                                        @if ($user->hasPermissionTo('updateAccount')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Update</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="deleteAccount"
                                                        @if ($user->hasPermissionTo('deleteAccount')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Delete</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                Category <br>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="showCategory"
                                                        @if ($user->hasPermissionTo('showCategory')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Show</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="addCategory"
                                                        @if ($user->hasPermissionTo('addCategory')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Add</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="updateCategory"
                                                        @if ($user->hasPermissionTo('updateCategory')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Update</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="deleteCategory"
                                                        @if ($user->hasPermissionTo('deleteCategory')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Delete</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                Brand <br>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="showBrand"
                                                        @if ($user->hasPermissionTo('showBrand')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Show</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="addBrand"
                                                        @if ($user->hasPermissionTo('addBrand')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Add</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="updateBrand"
                                                        @if ($user->hasPermissionTo('updateBrand')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Update</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="deleteBrand"
                                                        @if ($user->hasPermissionTo('deleteBrand')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Delete</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                Product <br>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="showProduct"
                                                        @if ($user->hasPermissionTo('showProduct')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Show</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="addProduct"
                                                        @if ($user->hasPermissionTo('addProduct')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Add</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="updateProduct"
                                                        @if ($user->hasPermissionTo('updateProduct')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Update</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="deleteProduct"
                                                        @if ($user->hasPermissionTo('deleteProduct')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Delete</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                Banner <br>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="showBanner"
                                                        @if ($user->hasPermissionTo('showBanner')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Show</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="addBanner"
                                                        @if ($user->hasPermissionTo('addBanner')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Add</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="updateBanner"
                                                        @if ($user->hasPermissionTo('updateBanner')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Update</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="deleteBanner"
                                                        @if ($user->hasPermissionTo('deleteBanner')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Delete</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                Voucher <br>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="showVoucher"
                                                        @if ($user->hasPermissionTo('showVoucher')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Show</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="addVoucher"
                                                        @if ($user->hasPermissionTo('addVoucher')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Add</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="updateVoucher"
                                                        @if ($user->hasPermissionTo('updateVoucher')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Update</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="deleteVoucher"
                                                        @if ($user->hasPermissionTo('deleteVoucher')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Delete</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                Blog <br>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="showBlog"
                                                        @if ($user->hasPermissionTo('showBlog')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Show</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="addBlog"
                                                        @if ($user->hasPermissionTo('addBlog')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Add</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="updateBlog"
                                                        @if ($user->hasPermissionTo('updateBlog')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Update</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault" name="deleteBlog"
                                                        @if ($user->hasPermissionTo('deleteBlog')) checked @endif>
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">Delete</label>
                                                </div>
                                            </div>
                                        </div>
                                        @error('role')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
