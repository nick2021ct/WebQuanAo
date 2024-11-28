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
                            <a href="">Sản phẩm</a>
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
                                    <form action="" method="post">
                                        
                                            <tr>
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img src="{{ asset('images/products/') }}"
                                                            alt="" width="80">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <h6></h6>
                                                        <h5 class="format-currency"></h5>
                                                        <h5><del style="font-size: 15px"
                                                                class="text-danger format-currency"></del>
                                                        </h5>
                                                    </div>
                                                </td>
                                                <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <input type="text" value=""
                                                                name="" min="1">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__price"></td>
                                                <td class="cart__price  format-currency">đ</td>
                                                <td class="cart__close"><a href=""><i
                                                            class="fa fa-close"></i></a></td>
                                            </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="">Tiếp tục mua sắm</a>
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
                                </li>
                            </ul>
                            <a href="" class="primary-btn">Thanh toán</a>
                        </div>
                    </div>
                </div>
                <h3>Bạn chưa có sản phẩm nào trong giỏ. Hãy mua sắm!</h3>
        </div>
    </section>
    <!-- Giỏ hàng Section End -->
@endsection
