@extends('layouts.appAdmin')
@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Chỉnh sửa mã giảm giá</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('voucher.create') }}" method="GET" class="mb-4">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="username" class="form-label">Tên Đầy đủ</label>
                                        <input type="text" name="fullname" id="fullname" class="form-control" value="{{ request('fullname') }}" placeholder="Nhập tên tài khoản">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="username" class="form-label">Số điện thoại</label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{ request('phone') }}" placeholder="Nhập tên tài khoản">
                                    </div>
                                  
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ request('email') }}" placeholder="Nhập email">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Địa chỉ</label>
                                        <input type="email" name="address" id="address" class="form-control" value="{{ request('address') }}" placeholder="Nhập địa chỉ">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="">-- Tất cả --</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                                            <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>Đã bị block</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary me-2 w-50">Lọc</button>
                                        <a href="{{ route('voucher.create') }}" class="btn btn-warning w-50">Xoá lọc</a>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex mb-3">
                                <button type="button" class="btn btn-primary me-2" id="selectAllBtn">Chọn tất cả</button>
                                <button type="button" class="btn btn-secondary" id="deselectAllBtn">Bỏ chọn tất cả</button>
                            </div>
                            <form action="{{ route('voucher.update', $voucher->id) }}" method="post">
                                @csrf
                                @method('PUT')
                            <table class="table text-nowrap mb-0 align-middle" id="example">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Chọn</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tên khách hàng</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Email</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Số điện thoại</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Địa chỉ</h6>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                  
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <input type="checkbox" name="idUser[]" value="{{ $user->id }}" {{ isset($userVoucherDetails[$user->id]) ? 'checked' : '' }}>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $user->fullname }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $user->email }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $user->phone }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $user->address }}</p>
                                            </td>
                                           
                                        </tr>
                                      
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Tên mã giảm giá</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $voucher->name }}">
                                    @error('name')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Code</label>
                                    <input type="text" name="code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $voucher->code }}">
                                    @error('code')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Bắt đầu</label>
                                    <input type="date" name="dateStart" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $voucher->dateStart }}" >
                                    @error('dateStart')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Kết thúc</label>
                                    <input type="date" name="dateEnd" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $voucher->dateEnd }}" >
                                    @error('dateEnd')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Số lượng</label>
                                    <input type="number" name="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $voucher->number }}" >
                                    @error('number')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Giá trị</label>
                                    <input type="text" name="value" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $voucher->value }}">
                                    @error('value')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
@section('js')
<script>
    document.getElementById('selectAllBtn').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('input[name="idUser[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = true;
        }
    });

    document.getElementById('deselectAllBtn').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('input[name="idUser[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = false;
        }
    });
</script>
@endsection