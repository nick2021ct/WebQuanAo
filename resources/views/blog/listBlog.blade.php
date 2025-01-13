@extends('layouts.app')
@section('title')
   Danh sách Blog
@endsection
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="{{ asset('storage/img/breadcrumb-bg.jpg') }}" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Blog Của Chúng Tôi</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                    
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset('storage/images/blogs/' . $blog->image->srcImage) }}"></div>
                        <div class="blog__item__text">
                            <span><img src="img/icon/calendar.png" alt=""> {{ \Carbon\Carbon::parse($blog->created_at)->format('d.m.Y') }}</span>
                            <h5>{{$blog->title}}</h5>
                            <a href="{{route('detailBlog', $blog->id)}}">Đọc tiếp</a>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
