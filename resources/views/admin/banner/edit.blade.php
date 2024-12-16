@extends('layouts.appAdmin')
@section('title')
   Chỉnh sửa Banner({{$banner->name}})
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Chỉnh sửa Banner({{ $banner->name }})</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('banner.update', $banner->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $banner->name }}">
                                    @error('name')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Hình ảnh</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <img src="{{ asset('storage/images/banners/' . $banner->srcImage) }}" width="100%"
                                        alt="">
                                    @error('image')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
