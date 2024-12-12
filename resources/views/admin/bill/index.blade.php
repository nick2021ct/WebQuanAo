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
                        <div class="">
                            <table class="table text-nowrap mb-0 align-middle" id="example">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">STT</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Người đặt hàng</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Địa chỉ</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Số điện thoại</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tổng tiền</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Pay</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Hoạt động</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $index => $bill)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ $index + 1}}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $bill->user->fullname }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $bill->user->address }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $bill->user->phone }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ number_format( $bill->total, 0, ',', '.') }} ₫</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    @if ($bill->pay == 1)
                                                        Paid
                                                    @else
                                                        Unpaid
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    @if ($bill->status == 1)
                                                        Đơn hàng mới
                                                    @elseif($bill->status == 2)
                                                        Đơn hàng đang được đóng gói
                                                    @elseif($bill->status == 3)
                                                        Đơn hàng đang được vận chuyển
                                                    @elseif($bill->status == 4)
                                                        Đơn hàng đã được giao
                                                    @elseif($bill->status == 5)
                                                        Giao hàng thất bại
                                                    @elseif($bill->status == 6)
                                                        Đơn hàng đã bị hủy
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="border-bottom-0" style="display: flex;">
                                                <a href="{{ route('bill.detail', $bill->id) }}"><button type="submit"
                                                        class="btn btn-info m-1">Chi tiết</button></a>
                                                <a href=""><button type="submit"
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
    </div>
@endsection
