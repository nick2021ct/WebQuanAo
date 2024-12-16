@extends('layouts.appAdmin')
@section('title')
    Chỉnh sửa sản phẩm({{ $product->name }})
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Chỉnh sửa sản phẩm({{ $product->name }})</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('product.update', $product->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" value="{{ $product->name }}">
                                    @error('name')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Giá gốc</label>
                                        <input type="text" name="price" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ $product->price }}">
                                        @error('price')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Giá sale</label>
                                        <input type="text" name="priceSale" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" value="{{ $product->priceSale }}">
                                        @error('priceSale')
                                            <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="exampleInputEmail1" class="form-label">Giới tính</label>
                                        <select name="gender" id="" class="form-select">
                                            <option value="1" @selected($product->gender == 1)>Male</option>
                                            <option value="2" @selected($product->gender == 2)>Female</option>
                                            <option value="3" @selected($product->gender == 3)>Unisex</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="exampleInputEmail1" class="form-label">Phân loại</label>
                                        <select name="category" id="" class="form-select">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected($product->idCategory == $category->id)>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="exampleInputEmail1" class="form-label">Thương hiệu</label>
                                        <select name="brand" id="" class="form-select">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" @selected($product->idBrand == $brand->id)>
                                                    {{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control" name="images[]" accept="image/*" multiple>
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('storage/images/products/' . $image->srcImage) }}" alt=""
                                            width="90" class="m-2">
                                    @endforeach
                                    @error('images')
                                        <div id="emailHelp" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <label for="exampleInputEmail1" class="form-label">Số lượng size</label>
                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="exampleInputEmail1" class="form-label">S</label>
                                        <input type="number" name="sizeS" class="form-control" min="0"
                                            value="{{ $product->size->S }}">
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="exampleInputEmail1" class="form-label">M</label>
                                        <input type="number" name="sizeM" class="form-control" min="0"
                                            value="{{ $product->size->M }}">
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="exampleInputEmail1" class="form-label">L</label>
                                        <input type="number" name="sizeL" class="form-control" min="0"
                                            value="{{ $product->size->L }}">
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="exampleInputEmail1" class="form-label">XL</label>
                                        <input type="number" name="sizeXL" class="form-control" min="0"
                                            value="{{ $product->size->XL }}">
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="exampleInputEmail1" class="form-label">2XL</label>
                                        <input type="number" name="size2XL" class="form-control" min="0"
                                            value="{{ $product->size->XXL }}">
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="exampleInputEmail1" class="form-label">3XL</label>
                                        <input type="number" name="size3XL" class="form-control" min="0"
                                            value="{{ $product->size->XXXL }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Mô tả</label>
                                    <textarea name="description" id="editor" cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
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
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
