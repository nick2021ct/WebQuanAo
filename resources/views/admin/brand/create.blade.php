@extends('layouts.appAdmin')

@section('title')
    Tạo thương hiệu mới
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Thêm thương hiệu </h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('brand.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên thương hiệu</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    @error('name')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Mô tả</label>
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Tạo thương hiệu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
