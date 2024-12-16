@extends('layouts.appAdmin')
@section('title')
    Danh sách bài viết
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4 mt-5">Blogs</h5>
                        @can('addCategory')
                            <a href="{{ route('blog.create') }}"><button type="submit" class="btn btn-success m-1">Thêm bài
                                    viết</button></a>
                        @endcan
                        <div class="">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">STT</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tiêu đề</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Ảnh bìa</h6>
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
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ $stt }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ Str::limit($blog->title,50) }}</p>
                                            </td>

                                            <td class="border-bottom-0">
                                                <img src="{{ asset('storage/images/blogs/' . $blog->image->srcImage) }}"
                                                    width="68" height="68" alt="">
                                            </td>
                                            <td class="border-bottom-0" style="display: flex;">

                                                @if (is_null($blog->deleted_at))
                                                    @can('updateCategory')
                                                        <a href="{{ route('blog.edit', $blog->id) }}"><button type="submit"
                                                                class="btn btn-info m-1">Cập nhật</button></a>
                                                    @endcan
                                                    @can('deleteBlog')
                                                        <form action="{{ route('blog.destroy', $blog->id) }}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger m-1"
                                                                onclick="return deleteConfirmation()">Xóa</button>
                                                        </form>
                                                    @endcan
                                                @else
                                                    @can('deleteBlog')
                                                        <a href="{{ route('admin.blog.restore', $blog->id) }}"><button
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
