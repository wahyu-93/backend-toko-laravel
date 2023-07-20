@extends('layouts.auth', ['tittle' => 'Reset Password'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="img-logo text-center mt-5">
                    <img src="{{ asset('assets/img/company.png') }}" alt="error load image" style="width: 80px">
                </div>

                <div class="card -hidden border-0 shadow-lg mb-3 mt-5">
                    <div class="card-body p-4">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="text-center">
                            <h1 class="h5 text-gray-900 mb-3">UPDATE PASSWORD</h1>
                        </div>

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" required autocomplete="email">
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password Baru" required autocomplete="new-password">
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="font-weight-bold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirm" class="form-control @error('password') is-invalid @enderror" placeholder="Konfirmasi Password Baru" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Update Password</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection