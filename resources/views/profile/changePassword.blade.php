@extends('layouts.app')
@section('title')
Thông Tin Địa Chỉ
@endsection
@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
       @include('layouts.profileSideBar')

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>Đổi mật khẩu</h5>
                        </div>
                        <div class="col text-end">
                            <!-- Nút mở modal thêm địa chỉ -->
                           
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="old_password" name="current_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-dark">Cập nhật mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection
