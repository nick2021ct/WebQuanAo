@extends('layouts.app')
@section('title')
    Giỏ hàng
@endsection
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang chủ</a>
                            <a href="{{ route('listProduct') }}">Sản phẩm</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Giỏ hàng Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            @if (isset($carts[0]->id))
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Kích cỡ</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('updateCart') }}" method="post">
                                        @csrf
                                        @method('POST')
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img src="{{ asset('storage/images/products/' . $cart->product->images->first()->srcImage) }}"
                                                            alt="" width="80">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <h6>{{ $cart->product->name }}</h6>
                                                        <h5 class="format-currency">{{ $cart->product->priceSale }}đ</h5>
                                                        <h5><del style="font-size: 15px"
                                                                class="text-danger format-currency">{{ $cart->product->price }}đ</del>
                                                        </h5>
                                                    </div>
                                                </td>
                                                <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <input type="text" value="{{ $cart->qty }}"
                                                                name="{{ $cart->id }}" min="1">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__price">{{ $cart->size }}</td>
                                                <td class="cart__price  format-currency">{{ $cart->total }}đ</td>
                                                <td class="cart__close"><a href="{{ route('deleteInCart', $cart->id) }}"><i
                                                            class="fa fa-close"></i></a></td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="{{ route('listProduct') }}">Tiếp tục mua sắm</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <button type="submit">Cập nhật giỏ hàng</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                
                        <div class="cart__total">
                            <h6>Đơn hàng</h6>
                            <ul>
                                <li>Phí vận chuyển <span>Miễn phí</span></li>
                                <li>Tổng giá trị <span>
                                        @if (isset($voucher))
                                            <span class="format-currency">{{ $totalBill - $voucher->value }}đ</span> <del
                                                style="font-size: 15px; color:black;"
                                                class="format-currency">{{ $totalBill }}đ</del>
                                        @else
                                            <span class="format-currency">{{ $totalBill }}đ</span>
                                        @endif
                                    </span></li>
                            </ul>
                            <a href="{{ route('checkOut') }}" class="primary-btn">Thanh toán</a>
                        </div>
                    </div>
                </div>
            @else
                <h3>Bạn chưa có sản phẩm nào trong giỏ. Hãy mua sắm!</h3>
            @endif
        </div>
    </section>
    <!-- Giỏ hàng Section End -->
@endsection
