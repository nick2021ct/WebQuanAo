@extends('layouts.app')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Chi tiết đơn hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang chủ</a>
                            <a href="{{ route('listOrder') }}">Đơn hàng</a>
                            <span>Chi tiết</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- List Order Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
                        <div class="container padding-bottom-3x mb-1">
                            <div class="card-body">
                            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                                
                            <div class="step {{ $order->status >=1 ? 'completed' : '' }} ">
                                <div class="step-icon-wrap">
                                <div class="step-icon"><i class="pe-7s-cart"></i></div>
                                </div>
                                <h4 class="step-title">Đơn hàng mới</h4>
                            </div>
                            <div class="step {{ $order->status >=2 ? 'completed' : '' }} ">
                                <div class="step-icon-wrap">
                                <div class="step-icon"><i class="pe-7s-config"></i></div>
                                </div>
                                <h4 class="step-title">Đang được chuẩn bị</h4>
                            </div>
                            <div class="step {{ $order->status >=3 ? 'completed' : '' }} ">
                                <div class="step-icon-wrap">
                                <div class="step-icon"><i class="pe-7s-car"></i></div>
                                </div>
                                <h4 class="step-title">Đang được vận chuyển</h4>
                            </div>
                            <div class="step {{ $order->status >=4 ? 'completed' : '' }} ">
                                <div class="step-icon-wrap">
                                <div class="step-icon"><i class="pe-7s-home"></i></div>
                                </div>
                                <h4 class="step-title">Đã giao thành công</h4>
                            </div>
                            @if ($order->status >=5)
                            <div class="step completed">
                                <div class="step-icon-wrap">
                                <div class="step-icon"><i class="pe-7s-close-circle"></i></div>
                                </div>
                                <h4 class="step-title">Đơn hàng đã bị hủy</h4>
                            </div>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th>Tổng giá trị</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái đơn hàng</th>
                                    <th>Trạng thái thanh toán</th>
                                    @if (in_array($order->status,[1,2,3]))
                                    <th>Tuỳ chọn</th>                                        
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p>{{ number_format($order->total, 0, ',', '.'). ' ₫' }}</p>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p> @if ($order->paymentMethod == 1)
                                            Thanh toán qua VNPay
                                            @elseif($order->paymentMethod == 0)
                                            Thanh toán khi nhận hàng
                                            @endif </p>
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
                                    <td >{{ $order->pay ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
                                    @if (in_array($order->status,[1,2]))
                                    <td>
                                        <a href="{{ route('updateStatusOrder',$order->id) }}" 
                                        class="btn btn-danger">
                                        Huỷ đơn hàng</a>
                                    </td>
                                    @endif
                                    @if ($order->status == 3)
                                    <td>
                                        <a href="{{ route('orderSuccess',$order->id) }}" 
                                        class="btn btn-success">
                                        Đã nhận được đơn</a>
                                    </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th>Người nhận hàng</th>
                                    <th>Loại địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Mã bưu điện</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p>{{ $order->orderAddress->fullname }}</p>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p>{{ $order->orderAddress->address_type }}</p>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p>{{ $order->orderAddress->phone }}</p>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p>{{ $order->orderAddress->address }}</p>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p>{{ $order->orderAddress->zip_code }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <h3>Sản phẩm</h3><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Kích cỡ</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $stt = 1;
                                @endphp
                                @foreach ($products as $product)
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
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset('storage/images/products/'.$product->product->images->first()->srcImage) }}" alt="" width="80">
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p>{{ $product->product->name }}</p>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p>{{ number_format($product->product->priceSale, 0, ',', '.') }} ₫
                                                @if($product->product->priceSale < $product->product->price)
                                                    <del style="font-size: 15px" class="text-danger format-currency">{{$product->product->price}}đ</del>
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p>{{ $product->qty }}</p>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p style="text-transform: uppercase">{{ $product->size }}</p>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <p  class="format-currency">{{$product->product->priceSale * $product->qty }}đ</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- List Order Section End -->
@endsection