@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang chủ</a>
                            <a href="{{ route('listProduct') }}">Sản phẩm</a>
                            <span>Đặt hàng thành công</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <h2 class="text-center">PA2T cảm ơn bạn!</h2>
            <br>
            <h3>Đặt hàng thành công</h3>
            <h4>Bạn sẽ nhận hàng trong khoảng 2 đến 5 ngày</h4>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection