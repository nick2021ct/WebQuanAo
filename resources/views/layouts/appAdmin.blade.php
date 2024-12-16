<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    {{-- CKEditor --}}
    <script src="{{ asset('ckeditor5-build-classic/ckeditor.js') }}"></script>
    {{-- Font awesome --}}
    <script src="https://kit.fontawesome.com/7d23d1769b.js" crossorigin="anonymous"></script>
    {{-- JS --}}
    <script>
        function deleteConfirmation() {
            return confirm('Bạn chắc không?');
        }
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap4.css">
    {{-- DataPickker --}}
    @yield('css')
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ route('home') }}" class="text-nowrap logo-img">
                        <img src="{{ asset('storage/img/logo.png') }}" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">    
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">QUẢN LÝ</span>
                        </li>
                        @can('showAccount')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('account.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <span class="hide-menu">Tài khoản</span>
                                </a>
                            </li>
                        @endcan
                        @can('showCategory')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('category.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="fa-solid fa-list"></i>
                                    </span>
                                    <span class="hide-menu">Phân loại</span>
                                </a>
                            </li>
                        @endcan
                        @can('showBrand')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('brand.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="fa-solid fa-copyright"></i>
                                    </span>
                                    <span class="hide-menu">Thương hiệu</span>
                                </a>
                            </li>
                        @endcan
                        @can('showProduct')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('product.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="fa-solid fa-shirt"></i>
                                    </span>
                                    <span class="hide-menu">Sản phẩm</span>
                                </a>
                            </li>
                        @endcan
                        @can('showBanner')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('banner.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="fa-solid fa-rectangle-ad"></i>
                                    </span>
                                    <span class="hide-menu">Banner</span>
                                </a>
                            </li>
                        @endcan
                        @can('showBlog')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('blog.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-article"></i>
                                    </span>
                                    <span class="hide-menu">Blog</span>
                                </a>
                            </li>
                        @endcan
                        @can('showVoucher')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('voucher.index') }}" aria-expanded="false">
                                    <span>
                                        <i class="fa-brands fa-salesforce"></i>
                                    </span>
                                    <span class="hide-menu">Voucher</span>
                                </a>
                            </li>
                        @endcan
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('bill.index')}}" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-table"></i>
                                </span>
                                <span class="hide-menu">Đơn hàng</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">PHÂN QUYỀN</span>
                        </li>

                        @if (Auth::user()->role == 1)
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('admin.account.createStaff') }}"
                                    aria-expanded="false">
                                    <span>
                                        <i class="fa-solid fa-user-plus"></i>
                                    </span>
                                    <span class="hide-menu">Tạo nhân viên</span>
                                </a>
                            </li>
                        @endif

                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                @include('layouts.headerAdmin')
            </header>
            <!--  Header End -->
            @yield('content')
        </div>
    </div>
    <!--  Footer Start -->
    @include('layouts.footerAdmin')

    <!--  Footer End -->
</body>
@yield('js')
<script>
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount);
    }

    $(document).ready(function() {
        $('.format-currency').each(function() {
            var amount = $(this).text().replace('đ', '').replace(',', '');
            $(this).text(formatCurrency(amount));
        });
    });
</script>
</html>
