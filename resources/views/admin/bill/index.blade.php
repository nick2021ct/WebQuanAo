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
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                   
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                   
                                                </p>
                                            </td>
                                            <td class="border-bottom-0" style="display: flex;">
                                                <a href=""><button type="submit"
                                                        class="btn btn-info m-1">Chi tiết</button></a>
                                                <a href=""><button type="submit"
                                                        class="btn btn-success m-1">In hóa đơn</button></a>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
