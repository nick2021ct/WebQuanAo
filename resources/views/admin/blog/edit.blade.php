@extends('layouts.appAdmin')
@section('title')
    Chỉnh sửa bài viết({{ $blog->title }})
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Chỉnh sửa bài viết({{ $blog->title }})</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tiêu đề</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $blog->title }}">
                                    @error('title')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Ảnh bìa</label>
                                        <input type="file" name="image" accept="image/* class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp">
                                        <img src="{{ asset('storage/images/blogs/' . $blog->image->srcImage) }}"
                                            alt="" width="100%">
                                        @error('image')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Mô tả</label>
                                    <textarea name="description" id="editor" cols="50" rows="50" class="form-control">{{ $blog->description }}</textarea>
                                    <script>
                                        ClassicEditor
                                            .create(document.querySelector('#editor'))
                                            .catch(error => {
                                                console.error(error);
                                            });
                                    </script>
                                    @error('description')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Hoàn tất</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
