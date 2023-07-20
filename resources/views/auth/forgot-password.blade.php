@extends('layouts.auth', ['tittle' => 'Forgot Password'])

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
                            <h1 class="h5 text-gray-900 mb-3">RESET PASSWORD</h1>
                        </div>

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button> 
                        </form>
                    </div>
                </div>
                
                <div class="text-center text-white">
                    <a href="/login" class="text-dark">Kembali ke Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection