@extends('layouts.appAdmin')
@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Add voucher</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('voucher.create') }}" method="GET" class="mb-4">
                                @csrf
                                @method('PUT')
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
                            <form action="{{ route('voucher.store') }}" method="post">
                                @csrf
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
                                                <input type="checkbox" name="idUser[]" value="{{ $user->id }}">
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
                        <br>
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('name') }}">
                                    @error('name')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Code</label>
                                    <input type="text" name="code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('code') }}">
                                    @error('code')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Date start</label>
                                    <input type="date" name="dateStart" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('dateStart') }}">
                                    @error('dateStart')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Date end</label>
                                    <input type="date" name="dateEnd" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('dateEnd') }}">
                                    @error('dateEnd')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Number</label>
                                    <input type="number" name="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('number') }}">
                                    @error('number')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputEmail1" class="form-label">Value</label>
                                    <input type="text" name="value" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('value') }}">
                                    @error('value')
                                    <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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