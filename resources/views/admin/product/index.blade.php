@extends('layouts.appAdmin')
@section('title')
    Danh sách  sản phẩm
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                
                
                <div class="card w-100">
                    
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4 mt-5">Sản phẩm</h5>
                        <form method="GET" action="{{ route('product.index') }}" class="row">

                            <div class="col-md-4">
                                <label for="name" class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ request('name') }}">
                            </div>
                

                            <div class="col-md-4">
                                <label for="category" class="form-label">Danh mục</label>
                                <select name="category_id" id="category" class="form-select">
                                    <option value="">Tất cả</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="brand" class="form-label">Thuơng hiệu</label>
                                <select name="brand_id" id="brand" class="form-select">
                                    <option value="">Tất cả</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="min_price" class="form-label">Giá từ</label>
                                <input type="number" name="min_price" id="min_price" class="form-control" placeholder="VNĐ" value="{{ request('min_price') }}">
                            </div>

                            <div class="col-md-4">
                                <label for="max_price" class="form-label">Giá đến</label>
                                <input type="number" name="max_price" id="max_price" class="form-control" placeholder="VNĐ" value="{{ request('max_price') }}">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-50 me-2">Lọc</button>
                                <a href="{{ route('product.index') }}" class="btn btn-warning w-50">Xoá lọc</a>
                            </div>
                        </form>
                        <br>
                        @can('addProduct')
                            <a href="{{ route('product.create') }}"><button type="submit" class="btn btn-success m-1">Thêm sản
                                    phẩm</button></a>
                        @endcan
                        <div class="">
                            <table class="table text-nowrap mb-0 align-middle" id="example">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">STT</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tên sản phẩm</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Hình ảnh</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Số lượng</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Size</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Giá</h6>
                                        </th>
                                        {{-- <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Phân loại</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Thương hiệu</h6>
                                        </th> --}}
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Ngày tạo</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Hoạt động</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $stt = 1;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ $stt }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $product->name }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <img src="{{ asset('storage/images/products/' . $product->images->first()->srcImage) }}"
                                                    width="50" height="68" alt="">
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $product->number }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $product->sizeShow }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"> <span >{{ number_format( $product->priceSale, 0, ',', '.') }} ₫</span>
                                                   <del style="font-size: 12px"> <span >{{ number_format( $product->price, 0, ',', '.') }} ₫</span></del>
                                                    </p>
                                            </td>
                                            {{-- <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $product->category->name }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $product->brand->name }}</p>
                                            </td> --}}
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $product->created_at->format('d-m-Y') }}</p>
                                            </td>
                                            <td class="border-bottom-0" style="display: flex;  padding-top:30px;">
                                                @if (is_null($product->deleted_at))
                                                    @can('updateProduct')
                                                        <a href="{{ route('product.edit', $product->id) }}"><button
                                                                type="submit" class="btn btn-info m-1">Chỉnh sửa</button></a>
                                                    @endcan
                                                    @can('deleteProduct')
                                                        <form action="{{ route('product.destroy', $product->id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger m-1"
                                                                onclick="return deleteConfirmation()">Xóa</button>
                                                        </form>
                                                    @endcan
                                                @else
                                                    @can('deleteProduct')
                                                        <a href="{{ route('admin.product.restore', $product->id) }}"><button
                                                                type="submit" class="btn btn-primary m-1">Restore</button></a>
                                                    @endcan
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $stt++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
