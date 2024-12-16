<div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7">
                <div class="header__top__left">
                    <p>Chào thu 2024, nhập Voucher Zara2024 để được giảm ngay 150.000</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                <div class="header__top__right">
                    <div class="header__top__hover">

                    </div>
                    <div class="header__top__links">
                        {{-- <a href="#">FAQs</a> --}}
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">

            @if (Auth::check())
                <div class="header__top__hover">
                    <span>Hi, {{ Auth::user()->username }} <i class="arrow_carrot-down"></i></span>
                    <ul class="text-center">
                        <a href="{{ route('logout') }}">
                            <li>Đăng xuất</li>
                        </a>
                        @if (Auth::user()->role == 1)
                            <a href="{{ route('admin.dashboard') }}">
                                <li>Quản trị</li>
                            </a>
                        @endif
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}">Đăng nhập</a>
            @endif
        </div>

    </div>
    <div class="offcanvas__nav__option">
        {{-- <a href="#" class="search-switch"><img src="{{ asset('storage/img/icon/search.png') }}"
                alt=""></a> --}}
        <a data-toggle="modal" data-target="#heart" style="cursor: pointer"><img
                src="{{ asset('storage/img/icon/heart.png') }}" alt="">
        </a>
      
            <span></span></a>
        {{-- <a href="#"><img src="{{ asset('storage/img/icon/cart.png') }}" alt=""> <span>0</span></a>
        <div class="price">$0.00</div> --}}
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
        <p>Chào thu 2024, nhập Voucher Zara2024 để được giảm ngay 150.000.

        </p>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <div class="header__logo">
                <a href="/"><img src="{{ asset('storage/img/logo.png') }}" alt=""></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <nav class="header__menu mobile-menu">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="{{ route('listProduct') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('listOrder') }}">Đơn hàng</a></li>
                    <li><a href="{{ route('listBlog') }}">Bài viết</a></li>
                    <li><a href="{{route('about')}}">Về chúng tôi</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="header__nav__option">
                {{-- <a href="#" class="search-switch"><img src="{{ asset('storage/img/icon/search.png') }}"
                        alt=""></a> --}}
                <a data-toggle="modal" data-target="#heart" style="cursor: pointer"><img
                        src="{{ asset('storage/img/icon/heart.png') }}" alt="">
                </a>
                <a href="{{ route('viewCart') }}"><img src="{{ asset('storage/img/icon/cart.png') }}" alt="">
                    <span></span></a>
                <div class="price"></div>
            </div>
        </div>
    </div>
    <div class="canvas__open"><i class="fa fa-bars"></i></div>
</div>
