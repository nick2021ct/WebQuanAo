@extends('layouts.app')
@section('title')
    Trang chủ
@endsection
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            @foreach ($banners as $banner)
                <div class="hero__items set-bg" data-setbg="{{ asset('storage/images/banners/' . $banner->srcImage) }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-7 col-md-8">
                                <div class="hero__text">
                                    <h6>Bộ sưu tập mùa hè</h6>
                                    <h2>{{ $banner->name }}</h2>
                                    <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                        commitment to exceptional quality.</p>
                                    <a href="{{ route('listProduct') }}"
                                        class="primary-btn d-flex justify-content-center align-items-center">
                                        <div>Mua ngay </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                        /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                                /////////////////////////////////////////////////////////
//////////////////////////////////////
////////////////////////////////////////
///////////////////////////////////////
<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('name')
                                <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Thêm Banner</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Banner</label>
              
                                            
                            
                        
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="{{ asset('storage/img/banner/banner-1.jpg') }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Bộ Sưu Tập Quần Áo 2024</h2>
                            <a href="{{ route('listProduct') }}">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="{{ asset('storage/img/banner/banner-2.jpg') }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Phụ Kiện</h2>
                            <a href="{{ route('listProduct') }}">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="{{ asset('storage/img/banner/banner-3.jpg') }}" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Giày Xuân 2024</h2>
                            <a href="{{ route('listProduct') }}">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Sản Phẩm</span>
                        <h2>Được Quan Tâm Nhất</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('storage/images/products/' . $product->image->srcImage) }}">
                                <span class="label">Sale</span>
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
                                                src="{{ asset('storage/img/icon/search.png') }}" alt=""><span>Chi tiết</span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{ $product->name }}</h6>
                                <a href="{{ route('detailProduct', $product->id) }}" class="add-cart">+ Mua ngay</a>
                                <h5>
                                    <span class="format-currency">{{ $product->priceSale }}đ</span>
                                    <del><span class="format-currency">{{ $product->price }}đ</span></del>
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
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    {{-- <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="{{ asset('storage/img/product-sale.png') }}" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>$29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Multi-pocket Chest Bag Black</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    {{-- <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/img/instagram/instagram-1.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/img/instagram/instagram-2.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/img/instagram/instagram-3.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/img/instagram/instagram-4.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/img/instagram/instagram-5.jpg') }}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{ asset('storage/img/instagram/instagram-6.jpg') }}"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                        <h3>#Male_Fashion</h3>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Tin Mới Nhất</span>
                        <h2>Thời Trang Xu Hướng Mới</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg"
                                data-setbg="{{ asset('storage/images/blogs/' . $blog->image->srcImage) }}"></div>
                            <div class="blog__item__text">
                                <span><img src="img/icon/calendar.png" alt="">
                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('d.m.Y') }}</span>
                                <h5>{{ $blog->title }}</h5>
                                <a href="{{ route('detailBlog', $blog->id) }}">Đọc tiếp</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
@endsection
