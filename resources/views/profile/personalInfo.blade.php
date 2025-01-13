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
                            <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>Thông tin cá nhân</h5>
                        </div>
                        <div class="col text-end">
                            <!-- Nút mở modal thêm địa chỉ -->
                           
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <h5><strong>Đơn hàng hiện tại</strong></h5>
                        <div class="card text-center col">
                            <div class="card-body">
                                <h6 class="card-title">Chờ xác nhận</h6>
                                <p class="card-text">{{ $pending }}</p>
                            </div>
                        </div>
                        <div class="card text-center col">
                            <div class="card-body">
                                <h6 class="card-title">Chờ lấy hàng</h6>
                                <p class="card-text">{{ $professing }}</p>
                            </div>
                        </div>
                        <div class="card text-center col">
                            <div class="card-body">
                                <h6 class="card-title">Chờ giao hàng</h6>
                                <p class="card-text">{{ $shipped }}</p>
                            </div>
                        </div>
                        <div class="card text-center col">
                            <div class="card-body">
                                <h6 class="card-title">Đánh giá</h6>
                                <p class="card-text">{{ $ratedCount }}</p>
                            </div>
                        </div>
                    </div>
                      <hr>
                    <div class="form-group">
                        <h5><strong>Thông tin người dùng</strong></h5>
                        <form action="{{ route('changeInfo') }}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label for="">Họ tên</label>
                                <input type="text"
                                  class="form-control" name="fullname" value="{{ $user->fullname }}" id="" aria-describedby="helpId" placeholder="">
                                  @error('fullname')
                                  <small id="helpId" class="form-text text-danger">{{ $message }}</small>                                      
                                  @enderror
                            </div>
                            <div class="col">
                                <label for="">Email</label>
                                <input type="text"
                                  class="form-control" name="email" value="{{ $user->email }}" id="" aria-describedby="helpId" placeholder="">
                                  @error('email')
                                  <small id="helpId" class="form-text text-danger">{{ $message }}</small>                                      
                                  @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Số điện thoại</label>
                                <input type="text"
                                  class="form-control" name="phone" value="{{ $user->phone }}" id="" aria-describedby="helpId" placeholder="">
                                  @error('phone')
                                  <small id="helpId" class="form-text text-danger">{{ $message }}</small>                                      
                                  @enderror
                            </div>
                            <div class="col">
                                <label for="">Địa chỉ</label>
                                <input type="text"
                                  class="form-control" name="address" value="{{ $user->address }}" id="" aria-describedby="helpId" placeholder="">
                                  @error('address')
                                  <small id="helpId" class="form-text text-danger">{{ $message }}</small>                                      
                                  @enderror
                            </div>
                        </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary ">Cập nhật</button>
                    </div>
                    </div>
                </form>

                  
                </div>
            </div>
        </div>
        
    </div>
</div>


@endsection
