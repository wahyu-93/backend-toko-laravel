@extends('layouts.app', ['title' => 'Tambah User'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fa fa-users"></i>
                            Tambah User
                        </h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.user.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required placeholder="Masukkan Nama User" value="{{ old('name') }}">
    
                                        @error('name')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Alamat Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required placeholder="Masukkan Alamat Email" value="{{ old('email') }}">
    
                                        @error('email')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Masukkan Password</label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukkan password" value="{{ old('password') }}">
        
                                        @error('password')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" id="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukkan password">
        
                                        @error('password')
                                            <div class="invalid-feedback" style="display: block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <button class="btn btn-primary btn-sm" type="submit">
                                <i class="fa fa-paper-plane"></i>
                                Simpan
                            </button>
    
                            <button class="btn btn-warning btn-sm" type="reset">
                                <i class="fa fa-redo"></i>
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection