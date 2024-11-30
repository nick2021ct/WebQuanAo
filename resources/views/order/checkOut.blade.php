@extends('layouts.app')
@section('title')
   Thanh toán
@endsection
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Thanh toán</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang chủ</a>
                            <a href="{{ route('listProduct') }}">Sản phẩm</a>
                            <span>Thanh toán</span>
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
            <div class="checkout__form">
                <div class="cart__discount">
                    <h6>Mã giảm giá</h6>
                    <form action="" method="POST">
                       
                        <input type="text" placeholder="Hãy nhập mã giảm giá" name="code" value="" required>
                        <button type="submit">Xác nhận</button>
                    </form>
                </div>
                <form action="" method="POST">
               
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Thông tin đặt hàng</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Tên khách hàng<span>*</span></p>
                                        <input type="text" name="name" value="{{ $user->fullname }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)" name="address" value="{{ $user->address }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" name="phone" value="{{ $user->phone }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú<span></span></p>
                                <input type="text"
                                placeholder="" name="note">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Tổng tiền</span></div>
                                <ul class="checkout__total__products">
                                 
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Phí vận chuyển <span>Miễn phí</span></li>
                                    <li>Mã giảm giá <span></span></li>
                                    <li>Tổng giá trị <span></span></li>
                                    <input type="hidden" name="total" value="">
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Thanh toán khi nhận hàng
                                        <input type="radio" id="payment" name="paymentMethod" value="0">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Thanh toán với VNPay
                                        <input type="radio" id="paypal" name="paymentMethod" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn" name="redirect">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection