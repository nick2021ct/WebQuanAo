@extends('layouts.appAdmin')
@section('title')
    Chỉnh sửa thương hiệu({{ $brand->name }})
@endsection
@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Chỉnh sửa thương hiệu({{ $brand->name }})</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('brand.update', $brand->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên thương hiệu</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $brand->name }}">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Mô tả</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ $brand->description }}</textarea>
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