@extends('layouts.app')
@section('title')
Thông Tin Đơn hàng
@endsection
@section('content')
    <!-- Breadcrumb Section Begin -->
    {{-- <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Đơn hàng của bạn</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang chủ</a>
                            <span>Đơn hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Breadcrumb Section End -->
    <div class="container my-5">
        <div class="row">
    @include('layouts.profileSideBar')

    <!-- List Order Section Begin -->
    <section class="shopping-cart spad col" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr class="text text-center">
                                    <th>STT</th>
                                    <th>Tổng giá trị</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái đơn hàng</th>
                                    <th>Trạng thái thanh toán</th>
                                    <th style="width: 12%">Thời gian</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="text text-center">
                                @php
                                    $stt = 1;
                                @endphp
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <p>{{ $stt }}</p>
                                            </div>
                                        </td>
                                        @php
                                            $stt++;
                                        @endphp
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <p class="format-currency">{{ $order->total }}đ</p>
                                            </div>
                                        </td>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <p>
                                                    @if ($order->paymentMethod == 1)
                                                        Thanh toán qua VNPay
                                                    @elseif($order->paymentMethod == 0)
                                                        Thanh toán khi nhận hàng
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <p>
                                                    @if ($order->status == 1)
                                                        Đơn hàng mới
                                                    @elseif($order->status == 2)
                                                        Đơn hàng đang được chuẩn bị
                                                    @elseif($order->status == 3)
                                                        Đơn hàng đang được vận chuyển
                                                    @elseif($order->status == 4)
                                                        Đơn hàng đã giao thành công
                                                    @elseif($order->status == 5)
                                                        Đơn hàng đã bị từ chối
                                                    @elseif($order->status == 6)
                                                        Đơn hàng đã bị hủy
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <p>
                                                    @if ($order->pay == 1)
                                                        Đã thanh toán
                                                    @else
                                                        Chưa thanh toán
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $order->created_at }}
                                        </td>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <a href="{{ route('detailOrder', $order->id) }}"><button type="button"
                                                        class="primary-btn">Chi tiết</button></a>
                                            </div>
                                            @if ($order->pay != 1 && $order->paymentMethod == 1)
                                                <div class="product__cart__item__text">
                                                    <form action="{{ route('checkOut') }}" method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" value="{{ $order->id }}" name="orderId">
                                                        <input type="hidden" value="{{ $order->paymentMethod }}"
                                                            name="paymentMethod">
                                                        <button type="submit" class="primary-btn" name="redirect">Thanh
                                                            toán</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-6 mx-auto">
                              {{ $orders->links() }}
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
    <!-- List Order Section End -->
@endsection
