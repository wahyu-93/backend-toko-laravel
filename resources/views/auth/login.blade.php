@extends('layouts.auth', ['tittle' => 'Login'])

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
                            <h1 class="h5 text-gray-900 mb-3">LOGIN ADMIN</h1>
                        </div>

                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <hr>

                            <a href="/forgot-password">Lupa Password ?</a>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection