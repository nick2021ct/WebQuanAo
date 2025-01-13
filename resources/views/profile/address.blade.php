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
                            <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>Danh Sách Địa Chỉ</h5>
                        </div>
                        <div class="col text-end">
                            <!-- Nút mở modal thêm địa chỉ -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                <i class="bi bi-plus-circle me-2"></i>Thêm Địa Chỉ
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($addresses as $address)
                        <li class="list-group-item d-flex justify-content-between align-items-center text-start">
                            <div>
                                <h6 class="mb-1"><strong>Loại địa chỉ: {{ $address->address_type }}</strong> </h6>
                                <p class="mb-1">Tên người nhận: {{ $address->fullname }}</p>
                                <p class="mb-1">Địa chỉ: {{ $address->address }}</p>
                                <p class="mb-1">Mã bưu điện: {{ $address->zip_code }}</p>
                                <small>Phone: {{ $address->phone }}</small>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $address->id }}">
                                    Sửa
                                </button>
                                <form action="{{ route('deleteAddress', $address->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </div>
                        </li>

                        <!-- Modal sửa địa chỉ -->
                        <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1" aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title" id="editAddressModalLabel{{ $address->id }}">
                                            <i class="bi bi-pencil-fill me-2"></i>Sửa Địa Chỉ
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('editAddress', $address->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="fullName{{ $address->id }}" class="form-label">Họ và Tên</label>
                                                <input name="fullname" type="text" class="form-control" id="fullName{{ $address->id }}" value="{{ $address->fullname }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="phoneNumber{{ $address->id }}" class="form-label">Số Điện Thoại</label>
                                                <input name="phone" type="text" class="form-control" id="phoneNumber{{ $address->id }}" value="{{ $address->phone }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="address{{ $address->id }}" class="form-label">Địa chỉ</label>
                                                <input name="address" type="text" class="form-control" id="address{{ $address->id }}" value="{{ $address->address }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="addressType{{ $address->id }}" class="form-label">Loại Địa chỉ</label>
                                                <input name="address_type" type="text" class="form-control" id="addressType{{ $address->id }}" value="{{ $address->address_type }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="zipCode{{ $address->id }}" class="form-label">Mã Bưu Điện</label>
                                                <input name="zip_code" type="text" class="form-control" id="zipCode{{ $address->id }}" value="{{ $address->zip_code }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Cập Nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal thêm địa chỉ -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="addAddressModalLabel"><i class="bi bi-plus-circle me-2"></i>Thêm Địa Chỉ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('addAddress') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addFullName" class="form-label">Họ và Tên</label>
                        <input name="fullname" type="text" class="form-control" id="addFullName" placeholder="Nhập họ và tên">
                    </div>
                    <div class="mb-3">
                        <label for="addPhoneNumber" class="form-label">Số Điện Thoại</label>
                        <input name="phone" type="text" class="form-control" id="addPhoneNumber" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="mb-3">
                        <label for="addAddress" class="form-label">Địa chỉ</label>
                        <input name="address" type="text" class="form-control" id="addAddress" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="mb-3">
                        <label for="addAddressType" class="form-label">Loại Địa chỉ</label>
                        <input name="address_type" type="text" class="form-control" id="addAddressType" placeholder="Nhập loại địa chỉ">
                    </div>
                    <div class="mb-3">
                        <label for="addZipCode" class="form-label">Mã Bưu Điện</label>
                        <input name="zip_code" type="text" class="form-control" id="addZipCode" placeholder="Nhập mã bưu điện">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
