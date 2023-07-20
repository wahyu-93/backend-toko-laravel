@extends('layouts.app', ['title' => 'Edit Kategori'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-folder"></i>
                            Edit Kategori
                        </h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.category.update', $category) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="image">Gambar</label>

                                <p>
                                    <img src="{{ $category->image }}" alt="Gagal Upload" width="250" height="250">
                                </p>                              

                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                <span class="text-danger">*Abaikan Jika Tidak Ingin Mengubah Foto</span>

                                @error('image')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Kategori</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $category->name }}">

                                @error('name')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit">
                                <i class="fa fa-paper-plane"></i>
                                Update
                            </button>

                            <a class="btn btn-warning btn-reset" href="{{ route('admin.category.index') }}">
                                <i class="fa fa-redo"></i>
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection