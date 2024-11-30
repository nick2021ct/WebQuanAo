@extends('layouts.appAdmin')
@section('title')
    Thêm nhân viên
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Thêm nhân viên</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.account.createStaff') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ old('username') }}">
                                    @error('username')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Mật khẩu</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        @error('password')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Xác nhận mật khẩu</label>
                                        <input type="password" name="repeat_password" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp">
                                        @error('repeat_password')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên đầy đủ</label>
                                    <input type="text" name="fullname" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ old('fullname') }}">
                                    @error('fullname')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ old('email') }}">
                                        @error('email')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ old('phone') }}">
                                        @error('phone')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
                                    <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ old('address') }}">
                                    @error('address')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Chức năng sử dụng</label>
                                    <div class="row">
                                        <div class="col-2">
                                            Tài khoản <br>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                                    name="showAccount">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="addAccount">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Thêm</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="updateAccount">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Cập
                                                    nhật</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="deleteAccount">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Xóa</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            Phân loại <br>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="showCategory">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="addCategory">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Thêm</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="updateCategory">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Cập
                                                    nhật</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="deleteCategory">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Xóa</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            Thương hiệu <br>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="showBrand">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="addBrand">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Thêm</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="updateBrand">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Cập
                                                    nhật</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="deleteBrand">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Xóa</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            Sản phẩm <br>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="showProduct">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="addProduct">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Thêm</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="updateProduct">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Cập
                                                    nhật</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="deleteProduct">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Xóa</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            Banner <br>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="showBanner">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="addBanner">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Thêm</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="updateBanner">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Cập
                                                    nhật</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="deleteBanner">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Xóa</label>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            Voucher <br>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="showVoucher">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="addVoucher">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Thêm </label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="updateVoucher">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Cập
                                                    nhật</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="deleteVoucher">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Xóa</label>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-4">
                                            Blog <br>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="showBlog">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="addBlog">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Thêm</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="updateBlog">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Cập
                                                    nhật</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="deleteBlog">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Xóa</label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('role')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
