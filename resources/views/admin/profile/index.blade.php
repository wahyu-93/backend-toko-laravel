@extends('layouts.app', ['title' => 'Profile'])

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        @if(session('status')=='profile-information-updated')
                            Profile has been updated
                        @endif

                        @if(session('status')=='password-updated')
                            Password has been updated
                        @endif

                        @if(session('status')=='two-factor-authentication-disabled')
                            Two factor authentication disabled
                        @endif

                        @if(session('status')=='two-factor-authentication-enabled')
                            Two factor authentication enabled
                        @endif

                        @if(session('status')=='recovery-codes-generated')
                            Recovery codes generated
                        @endif                       
            
                    </div>
                </div>
            @endif

            {{-- page heading --}}
            <div class="row">
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
                    <div class="col-md-5 mb-5">
                        <div class="card border-0 shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold">
                                    <i class="fas fa-key"></i>
                                    Two-Factor Authentication
                                </h6>
                            </div>

                            <div class="card-body">
                                @if (! auth()->user()->two_factor_secret)
                                    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                        @csrf
                                        {{-- enabled 2FA --}}
                                        <button type="submit" class="btn btn-primary text-uppercase">
                                            Enable Two-Factor
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                        {{-- disabled 2FA --}}
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger text-uppercase">
                                            Disable Two-Factor
                                        </button>
                                    </form>

                                    @if(session('status')=='two-factor-authentication-enabled')
                                        {{-- show vg qrcode. after enabling 2fa --}}
                                        <p>
                                            Otentikasi dua faktor sekarang diaktifkan, Pindai kode QR berikut menggunakan apikasi pengautentikasi ponsel anda.
                                        </p>
    
                                        <div class="mb-3">
                                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                        </div>
                                    @endif
    
                                    {{-- show 2fa recovery code --}}
                                    <p>
                                        simpan recovery code ini dengan aman. ini dapat digunakan untuk memulihkan akses ke akun anda jika perangkat otentikasi dua faktor anda hilang
                                    </p>
    
                                    <div style="background: rgb(44, 44, 44);color: white" class="rounded p-3 mb-2">
                                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                            <div>
                                                {{ $code }}
                                            </div>
                                        @endforeach
                                    </div>
    
                                    {{-- regenerate 2fa recovery codes --}}
                                    <form action="{{ url('user/two-factor-recovery-codes') }}" method="POST">
                                        @csrf
    
                                        <button type="submit" class="btn btn-dark text-uppercase">
                                            Regenerate Recovery Codes
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="col-md-7">
                    <div class="card border-0 shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bpld">
                                <i class="fas fa-user-circle"></i>
                                Edit Profile
                            </h6>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('user-profile-information.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name" class="text-uppercase">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? auth()->user()->name }}" autofocus required autocomplete="name">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="text-uppercase">Email</label>
                                    <input type="text" email="email" id="email" class="form-control" value="{{ old('email') ?? auth()->user()->email }}" autofocus required autocomplete="email">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary text-uppercase" type="submit">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card border-0-shadow mt-3 mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-unlock"></i>
                                Update Password
                            </h6>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('user-password.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="current_password" class="text-uppercase">Current Password</label>
                                    <input type="password" name="current_password" id="current_password" class="form-control" required autocomplete="current-password">
                                </div>

                                <div class="form-group">
                                    <label for="password" class="text-uppercase">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="text-uppercase">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary text-uppercase" type="submit">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection