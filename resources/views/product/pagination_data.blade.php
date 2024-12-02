<div class="row">
    @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg"
                    data-setbg="{{ asset('storage/images/products/' . $product->image->srcImage) }}"
                    style="background-image: url({{ asset('storage/images/products/' . $product->image->srcImage) }});">
                    <ul class="product__hover">
                        <li><a style="cursor: pointer" onclick="add_heart({{ $product->id }})"><img
                                    src="{{ asset('storage/img/icon/heart.png') }}" alt=""
                                    id="Myheart_{{ $product->id }}">
                                <span>Yêu thích</span></a></li>
                        <li><a data-toggle="modal" data-target="#compare" style="cursor: pointer"
                                onclick="add_compare({{ $product->id }})"><img
                                    src="{{ asset('storage/img/icon/compare.png') }}" alt="">
                                <span>So sánh</span></a></li>
                        <li><a href="{{ route('detailProduct', $product->id) }}"><img
                                    src="{{ asset('storage/img/icon/search.png') }}" alt=""> <span>Chi
                                    tiết</span></a>
                        </li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6>{{ $product->name }}</h6>
                    <a href="{{ route('detailProduct', $product->id) }}" class="add-cart">+ Mua ngay</a>
                    <h5>
                        <span> {{ number_format($product->priceSale, 0, ',', '.') }} ₫</span>
                        <span class="price_sale">{{ number_format($product->price, 0, ',', '.') }} ₫</span>
                    </h5>
                </div>
            </div>
        </div>
        <input type="hidden" value="{{ $product->id }}">
        <input type="hidden" id="wishlist_name{{ $product->id }}" value="{{ $product->name }}">
        <input type="hidden" id="wishlist_image{{ $product->id }}"
            value="{{ URL::to('storage/images/products/' . $product->image->srcImage) }}">
        <input type="hidden" id="wishlist_pricesale{{ $product->id }}" value="{{ $product->priceSale }}">
        <input type="hidden" id="wishlist_price{{ $product->id }}" value="{{ $product->price }}">
        <input type="hidden" id="wishlist_url{{ $product->id }}"
            value="{{ URL::to('/detail-product/' . $product->id) }}">
    @endforeach
</div>
<div class="row">
    <div class="col-lg-12">


        <div class="product__pagination ">

            @if ($products->lastPage() > 1)
                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <a class="{{ $products->currentPage() == $i ? 'active' : '' }}"
                        href="{{ $products->url($i) }}">{{ $i }}</a>
                @endfor
            @endif
        </div>

    </div>
</div>
</div>
