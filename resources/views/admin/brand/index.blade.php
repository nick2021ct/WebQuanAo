@extends('layouts.appAdmin')
@section('title')
    Danh sách thương hiệu
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4 mt-5">Thương hiệu</h5>
                        @can('addBrand')
                            <a href="{{ route('brand.create') }}"><button type="submit" class="btn btn-success m-1">Thêm sản
                                    phẩm</button></a>
                        @endcan
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="example">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">STT</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tên thương hiệu</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Số lượng</h6>
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
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ $stt }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $brand->name }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $brand->qty }}</p>
                                            </td>
                                            <td class="border-bottom-0" style="display: flex;">
                                                @if (is_null($brand->deleted_at))
                                                    @can('updateBrand')
                                                        <a href="{{ route('brand.edit', $brand->id) }}"><button type="submit"
                                                                class="btn btn-info m-1">Cập nhật</button></a>
                                                    @endcan
                                                    @can('deleteBrand')
                                                        <form action="{{ route('brand.destroy', $brand->id) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger m-1"
                                                                onclick="return deleteConfirmation()">Xóa</button>
                                                        </form>
                                                    @endcan
                                                @else
                                                    @can('deleteBrand')
                                                        <a href="{{ route('admin.brand.restore', $brand->id) }}"><button
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
