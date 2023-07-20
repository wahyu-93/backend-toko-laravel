@extends('layouts.app', ['title' => 'Tambah Produk'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fa fa-shopping-bag"></i>
                            Produk
                        </h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">

                                @error('image')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title">title Produk</label>
                                <input type="text" name="title" id="title" class="form-control @error('nama') is-invalid @enderror" value="{{ old('title') }}" placeholder="Masukkan Nama Produk">

                                @error('title')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Kategori</label>
                                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                            <option value="">--Pilih Kategori--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category_id')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight">Berat (gram)</label>
                                        <input type="number" name="weight" id="weight" class="form-control @error('weight')is-invalid @enderror" value="{{ old('weight') }}" placeholder="Berat Produk (gram)">

                                        @error('weight')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content">Deskripsi</label>
                                <textarea name="content" id="content" rows="6" class="form-control content @error('content') is-invalid @enderror"></textarea>

                                @error('content')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Harga</label>
                                        <input type="number" name="price" id="price" class="form-control @error('price')is-invalid @enderror" value="{{ old('price') }}" placeholder="Harga Produk">

                                        @error('price')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> 
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount">Diskon (%)</label>
                                        <input type="number" name="discount" id="discount" class="form-control @error('discount')is-invalid @enderror" value="{{ old('discount') }}" placeholder="Diskon Produk (%)">

                                        @error('discount')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-submit mr-1 btn-sm">
                                <i class="fa fa-paper-plane"></i>
                                Simpan
                            </button>

                            <button type="reset" class="btn btn-warning btn-reset mr-1 btn-sm">
                                <i class="fa fa-redo"></i>
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.4/tinymce.min.js"></script>
    <script>
        var editor_config = {
            selector: "textarea.content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
        };

        tinymce.init(editor_config);
    </script>
@endsection