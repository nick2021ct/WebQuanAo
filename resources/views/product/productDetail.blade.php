@extends('layouts.app')
@section('title')
    {{ $product->name }}
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
    <!-- Shop Details Section Begin -->

    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="/">Trang chủ</a>
                            <a href="{{ route('listProduct') }}">Shop</a>
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            @php
                                $i = 1;
                                $active = 'active';
                            @endphp
                            @foreach ($images as $image)
                                <li class="nav-item">
                                    <a class="nav-link {{ $active }}" data-toggle="tab"
                                        href="#tabs-{{ $i }}" role="tab">
                                        <div class="product__thumb__pic set-bg"
                                            data-setbg="{{ asset('storage/images/products/' . $image->srcImage) }}">
                                        </div>
                                    </a>
                                </li>
                                @php
                                    $i++;
                                    if ($i > 1) {
                                        $active = '';
                                    }
                                @endphp
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            @php
                                $i = 1;
                                $active = 'active';
                            @endphp
                            @foreach ($images as $image)
                                <div class="tab-pane {{ $active }}" id="tabs-{{ $i }}" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{ asset('storage/images/products/' . $image->srcImage) }}"
                                            alt="">
                                    </div>
                                </div>
                                @php
                                    $i++;
                                    if ($i > 1) {
                                        $active = '';
                                    }
                                @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product->name }}</h4>
                            <div class="d-flex justify-content-center py-2">

                                <div id="rateProduct"></div>
                            </div>
                            <h3 class="d-flex justify-content-center align-items-center">
                                <div class="format-currency">{{ $product->priceSale }}đ</div> <span
                                    class="format-currency">{{ $product->price }}đ</span>
                            </h3>

                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <form action="{{ route('addToCart', $product->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <span>Size:</span>
                                        @if ($product->size->XXXL > 0)
                                            <label for="xxxl">xxxl

                                            </label>
                                        @endif
                                        @if ($product->size->XXL > 0)
                                            <label for="xxl">xxl

                                            </label>
                                        @endif
                                        @if ($product->size->XL > 0)
                                            <label for="xl">xl

                                            </label>
                                        @endif
                                        @if ($product->size->L > 0)
                                            <label for="l">l

                                            </label>
                                        @endif
                                        @if ($product->size->M > 0)
                                            <label for="m">m

                                            </label>
                                        @endif
                                        @if ($product->size->S > 0)
                                            <label for="s">s

                                            </label>
                                        @endif
                                </div>
                            </div>
                            <div class="product__details__cart__option d-flex align-items-center justify-content-center">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" name="qty">
                                    </div>
                                </div>
                                <button type="submit" class="primary-btn">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                            @error('size')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('qty')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="product__details__btns__option">


                                <a style="cursor: pointer" onclick="add_heart({{ $product->id }})"><img
                                        src="{{ asset('storage/img/icon/heart.png') }}" alt=""
                                        id="Myheart_{{ $product->id }}" width="20">
                                </a>
                                <a data-toggle="modal" data-target="#compare" style="cursor: pointer"
                                    onclick="add_compare({{ $product->id }})"><img
                                        src="{{ asset('storage/img/icon/compare.png') }}" alt="" width="20">
                                </a>
                            </div>
                            <div style="width: 300px;margin: 0 auto">

                                <div class="product-size-guide"><a data-toggle="modal" data-target="#size" style="cursor: pointer">Gợi ý tìm size</a></div>
                            </div>
                            <div class="product__details__last__option">

                                <ul>
                                    <li><span>SKU:</span> 2023{{ $product->id }}</li>
                                    <li><span>Dòng sản phẩm:</span> {{ $product->category->name }}</li>
                                    <li><span>Thương hiệu:</span> {{ $product->brand->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $product->id }}">
                    <input type="hidden" id="wishlist_name{{ $product->id }}" value="{{ $product->name }}">
                    <input type="hidden" id="wishlist_image{{ $product->id }}"
                        value="{{ URL::to('storage/images/products/' . $productImage->srcImage) }}">
                    <input type="hidden" id="wishlist_pricesale{{ $product->id }}" value="{{ $product->priceSale }}">
                    <input type="hidden" id="wishlist_price{{ $product->id }}" value="{{ $product->price }}">
                    <input type="hidden" id="wishlist_url{{ $product->id }}"
                        value="{{ URL::to('/detail-product/' . $product->id) }}">
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Đánh
                                        giá({{ count($comments) > 0 ? count($comments) : '0' }})</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        @php
                                            echo $product->description;
                                        @endphp
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">
                                        <div class="blog__details__comment">
                                            @if (count($comments) > 0)
                                                <div style="height: 300px; overflow-y: auto; overflow-x: hidden;">
                                                    @foreach ($comments as $index => $item)
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                            </div>
                                                            <div class="col-lg-8 py-2"
                                                                style="border-bottom: 1px solid #d9d9d9;">
                                                                <div class="rateYo d-block"
                                                                    id="rateItem_{{ $index }}">
                                                                </div>
                                                                <div class="p-1"
                                                                    style="color: #b7b7b7; font-size: 12px">
                                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y') }}
                                                                </div>
                                                                <div class="d-flex gap-2 p-1">
                                                                    <h5 class="mr-2 font-weight-bold">
                                                                        {{ $item->user->fullname }}
                                                                    </h5>
                                                                    <div style="color: #8a8888">
                                                                        {{ $item->content }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <h2 class="text-center" style="color: #b7b7b7; font-size: 25px">Chưa có
                                                    đánh giá nào</h2>
                                            @endif

                                            @if (Auth::check() && $cart && $cart->idUser == Auth::user()->id && $countCommentUser == 0 && $order != null)
                                                <!-- Nội dung bạn muốn hiển thị khi người dùng đã đăng nhập -->
                                                <form action="{{ route('comment.store') }}" method="POST"
                                                    id="form_create">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="row mt-4">
                                                        <div class="col-lg-2">
                                                        </div>
                                                        <div class="col-lg-8 text-center">
                                                            <div class="text-center">
                                                                <h3 class="related-title">Đánh giá sản phẩm</h3>
                                                            </div>
                                                            <div class="text-center py-2">
                                                                <div id="rateYo"></div>
                                                            </div>
                                                            <input type="hidden" name="rating" id="rating_start"
                                                                required>

                                                            <input type="hidden" name="idProduct"
                                                                value="{{ $product->id }}">
                                                            <textarea placeholder="Comment" name="content" id="content" required></textarea>
                                                        </div>
                                                        <div class="col-lg-2">
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="site-btn" onclick="submitform()">Gửi
                                                        đánh
                                                        giá</button>
                                                </div>
                                            @else
                                            @endif

                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->
    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            @if (count($relatedProducts) > 0)
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="related-title">Sản phẩm cùng loại</h3>
                    </div>
                </div>
                <div class="row">

                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('storage/images/products/' . $relatedProduct->srcImage) }}">
                                    <span class="label">New</span>
                                    <ul class="product__hover">
                                        <li><a style="cursor: pointer"
                                                onclick="add_heart({{ $relatedProduct->id }})"><img
                                                    src="{{ asset('storage/img/icon/heart.png') }}" alt=""
                                                    id="Myheart_{{ $relatedProduct->id }}">
                                                <span>Yêu thích</span></a></li>
                                        <li><a data-toggle="modal" data-target="#compare" style="cursor: pointer"
                                                onclick="add_compare({{ $relatedProduct->id }})"><img
                                                    src="{{ asset('storage/img/icon/compare.png') }}" alt="">
                                                <span>So sánh</span></a></li>
                                        <li><a href="{{ route('detailProduct', $relatedProduct->id) }}"><img
                                                    src="{{ asset('storage/img/icon/search.png') }}"
                                                    alt=""><span>Chi tiết</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $relatedProduct->name }}</h6>
                                    <a href="{{ route('detailProduct', $relatedProduct->id) }}" class="add-cart">+ Mua
                                        ngay</a>

                                    <h5><span class="format-currency">{{ $relatedProduct->priceSale }}đ</span> <del><span
                                                class="format-currency">{{ $relatedProduct->price }}đ</span></del></h5>

                                </div>
                                
                            </div>
                        </div>
                        <input type="hidden" value="{{ $relatedProduct->id }}">
                        <input type="hidden" id="wishlist_name{{ $relatedProduct->id }}"
                            value="{{ $relatedProduct->name }}">
                        <input type="hidden" id="wishlist_image{{ $relatedProduct->id }}"
                            value="{{ URL::to('storage/images/products/' . $relatedProduct->srcImage) }}">
                        <input type="hidden" id="wishlist_pricesale{{ $relatedProduct->id }}"
                            value="{{ $relatedProduct->priceSale }}">
                        <input type="hidden" id="wishlist_price{{ $relatedProduct->id }}"
                            value="{{ $relatedProduct->price }}">
                        <input type="hidden" id="wishlist_url{{ $relatedProduct->id }}"
                            value="{{ URL::to('/detail-product/' . $relatedProduct->id) }}">
                    @endforeach
                </div>
            @else
            @endif
        </div>
    </section>
    <!-- Related Section End -->
@section('js')
    @error('content')
        <script>
            Toastify({
                text: "{{ $message }}",
                className: "info",
                style: {
                    background: "red",
                }
            }).showToast();
        </script>
    @enderror
    <script>

        $(function() {
            $("#rateYo").rateYo({
                rating: 0
            }).on('rateyo.set', function(e, data) {
                $('#rating_start').val(data.rating);
                // alert("The rating is set to" + data.rating + "!")
            });
        });
        $(function() {
            $("#rateProduct").rateYo({
                rating: {{ $averageRating }}
            }).on('rateyo.set', function(e, data) {
                $('#rating_start').val(data.rating);
                // alert("The rating is set to" + data.rating + "!")
            });
        });
        $(function() {
            // Initialize individual item ratings
            @foreach ($comments as $index => $item)
                $("#rateItem_{{ $index }}").rateYo({
                    rating: {{ $item->rating }}
                })
            @endforeach
        });


        function makeToast(message, color) {
            Toastify({
                text: message,
                backgroundColor: color,
            }).showToast();
        }


        function submitform() {
            var $form = $('#form_create')[0];
            var contentValue = $('#content').val().trim(); // Thay '#content' bằng id của trường content thực tế

            if ($form.checkValidity()) {
                if (checkContentLength(contentValue)) {
                    $form.submit();
                } else {
                    makeToast('Nội dung cần có tối đa 300 ký tự', '#F28585');
                }
            } else {
                makeToast('Bạn cần nhập đầy đủ đánh giá sao và nội dung', '#F28585');
            }
            return false;
        }

        function checkContentLength(content) {
            var maxLength = 300;
            return content.length <= maxLength;
        }

        submitform();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
@endsection
@endsection
