@extends('layouts.auth',['title' => 'Forgot Password'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="img-logo text-center mt-5">
                    <img src="{{ asset('assets/img/company.png') }}" alt="gagal upload" style="width:80px">
                </div>

                <div class="card o-hidden border-0 shadow-lg mb-3 mt-5">
                    <div class="card-body p-4">
                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible">
                                {{session('status')}}
                            </div>
                        @endif

                        <div class="text-center">
                            <h1 class="text-gray-900 mb-3 h5">
                                Confirm Password
                            </h1>

                            <form action="{{ route('password.confirm') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="password" class="text-uppercase">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" tabindex="1">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg mb-3" tabindex="4">
                                        Confirm Password
                                    </button>
                                    <div class="text-center text-white">
                                        <label>
                                            <a href="/forgot-password" class="text-whote">Lupa Password ?</a>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection