@extends('layouts.appAdmin')
@section('title')
    Danh sách đơn hàng
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4 mt-5">Đơn hàng</h5>

                        {{-- Form lọc nâng cao --}}
                        <form action="{{ route('bill.index') }}" method="GET" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="">Tất cả</option>
                                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Đơn hàng mới</option>
                                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Đang đóng gói</option>
                                        <option value="3" {{ request('status') == 3 ? 'selected' : '' }}>Đang vận chuyển</option>
                                        <option value="4" {{ request('status') == 4 ? 'selected' : '' }}>Đã giao</option>
                                        <option value="5" {{ request('status') == 5 ? 'selected' : '' }}>Giao thất bại</option>
                                        <option value="6" {{ request('status') == 6 ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="pay" class="form-label">Thanh toán</label>
                                    <select class="form-select" name="pay" id="pay">
                                        <option value="">Tất cả</option>
                                        <option value="1" {{ request('pay') == 1 ? 'selected' : '' }}>Paid</option>
                                        <option value="0" {{ request('pay') === '0' ? 'selected' : '' }}>Unpaid</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="start_date" class="form-label">Từ ngày</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                        value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="end_date" class="form-label">Đến ngày</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date"
                                        value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="total_min" class="form-label">Tổng tiền từ</label>
                                    <input type="number" class="form-control" name="total_min" id="total_min"
                                        value="{{ request('total_min') }}" placeholder="VNĐ">
                                </div>
                                <div class="col-md-3">
                                    <label for="total_max" class="form-label">Đến</label>
                                    <input type="number" class="form-control" name="total_max" id="total_max"
                                        value="{{ request('total_max') }}" placeholder="VNĐ">
                                </div>
                                <div class="col-md-3">
                                    <label for="user_name" class="form-label">Người đặt hàng</label>
                                    <input type="text" class="form-control" name="user_name" id="user_name"
                                        value="{{ request('user_name') }}" placeholder="Nhập tên người đặt hàng">
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-50 me-2">Lọc</button>
                                    <a href="{{ route('bill.index') }}" class="btn btn-warning w-50">Xoá lọc</a>
                                </div>
                            </div>
                        </form>

                        {{-- Bảng danh sách đơn hàng --}}
                        <table class="table text-nowrap mb-0 align-middle" id="example">
                            <thead class="text-dark fs-4 ">
                                <tr>
                                    <th class="border-bottom-0">STT</th>
                                    <th class="border-bottom-0">Người đặt hàng</th>
                                    <th class="border-bottom-0">Địa chỉ</th>
                                    <th class="border-bottom-0">Tổng tiền</th>
                                    <th class="border-bottom-0">Pay</th>
                                    <th class="border-bottom-0">Trạng thái</th>
                                    <th class="border-bottom-0">Ngày đặt hàng</th>
                                    <th class="border-bottom-0">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $index => $bill)
                                    <tr>
                                        <td class="border-bottom-0">{{ $index + 1 }}</td>
                                        <td class="border-bottom-0">{{ $bill->orderAddress?->fullname ?? 'N/A' }}</td>
                                        <td class="border-bottom-0">{{ $bill->orderAddress?->address ?? 'N/A' }}</td>
                                        <td class="border-bottom-0">{{ number_format($bill->total, 0, ',', '.') }} ₫</td>
                                        <td class="border-bottom-0">{{ $bill->pay ? 'Paid' : 'Unpaid' }}</td>
                                        <td class="border-bottom-0">
                                            @if ($bill->status == 1)
                                                Đơn hàng mới
                                            @elseif($bill->status == 2)
                                                Đang đóng gói
                                            @elseif($bill->status == 3)
                                                Đang vận chuyển
                                            @elseif($bill->status == 4)
                                                Đã giao
                                            @elseif($bill->status == 5)
                                                Giao thất bại
                                            @elseif($bill->status == 6)
                                                Đã hủy
                                            @endif
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($bill->created_at)) }}
                                        </td>
                                        <td class="border-bottom-0" style="display: flex;">
                                            <a href="{{ route('bill.detail', $bill->id) }}"><button type="submit"
                                                    class="btn btn-info m-1">Chi tiết</button></a>
                                            <a href="{{ route('invoice', $bill->id) }}"><button type="submit"
                                                    class="btn btn-success m-1">In hóa đơn</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
