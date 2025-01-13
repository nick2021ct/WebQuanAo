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
                <form action="{{ route('discountCode') }}" method="POST">
                    @csrf
                    <input type="text" placeholder="Hãy nhập mã giảm giá" name="code" value="@if(isset($voucher)){{ $voucher->code }}@endif" required>
                    <button type="submit">Xác nhận</button>
                </form>
                <div class="text-end">
                    <button type="button" class="btn btn-dark mt-2 " data-bs-toggle="modal" data-bs-target="#voucherModal">
                        Xem danh sách voucher
                    </button>

                </div>
            </div>
            <form action="{{ route('checkOut') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class=" mb-0"><strong>Chọn địa chỉ giao hàng</strong></h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                <i class="bi bi-plus-circle me-2"></i>Thêm Địa Chỉ
                            </button>
                        </div>
                        <hr>
                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-lg-6 mb-3">
                                    <div class="card address-card p-3">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="address_id" id="address{{ $address->id }}" value="{{ $address->id }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label class="form-check-label" for="address{{ $address->id }}">
                                                <strong>{{ $address->address_type }}</strong> <br>
                                                Tên: {{ $address->fullname }} <br>
                                                Địa chỉ: {{ $address->address }}<br>
                                                Số điện thoại: {{ $address->phone }} <br>
                                                Mã bưu điện: {{ $address->zip_code }} 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú<span></span></p>
                            <input type="text" placeholder="Ghi chú cho đơn hàng" name="note">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Tổng tiền</span></div>
                            <ul class="checkout__total__products">
                                @foreach ($carts as $cart)
                                    <li>{{ $cart->product->name }} x{{ $cart->qty }}<span>{{ number_format($cart->qty * $cart->product->priceSale, 0, ',', '.') }} ₫</span></li>
                                @endforeach
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Phí vận chuyển <span>Miễn phí</span></li>
                                <li>Mã giảm giá <span>@if(isset($voucher)){{ number_format($voucher->value, 0, ',', '.') }} ₫ @else 0 @endif</span></li>
                                <li>Tổng giá trị <span>@if(isset($voucher)){{ number_format($totalBill - $voucher->value, 0, ',', '.') }} ₫ <del style="font-size: 15px; color:black;">{{ number_format($totalBill, 0, ',', '.') }} ₫ </del> @else {{ number_format($totalBill, 0, ',', '.') }} ₫  @endif</span></li>
                                <input type="hidden" name="total" value="@if(isset($voucher)){{ $totalBill - $voucher->value }} @else {{ $totalBill }} @endif">
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

<!-- Modal for Adding Address -->
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

<!-- Modal for Voucher List -->
<div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white ">
                <h5 class="modal-title" id="voucherModalLabel"><i class="bi bi-tag me-2"></i>Danh sách Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('discountCode') }}" method="POST">
                    @csrf
                    <ul class="list-group">
                    @foreach ($voucherList as $voucher)
                        <li class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="selectCode"  value="{{ $voucher->code }}">
                                <label class="form-check-label" for="voucher{{ $voucher->id }}">
                                    <strong>{{ $voucher->code }}</strong> - Giảm {{ number_format($voucher->value, 0, ',', '.') }} ₫
                                </label>
                            </div>
                        </li>
                        @endforeach
                        <button type="submit" class="btn btn-dark">Chọn</button>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Checkout Section End -->
@endsection