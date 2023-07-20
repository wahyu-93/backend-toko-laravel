@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- page heading --}}

        {{-- content row --}}

        <div class="row">
            {{-- alert chart --}}
            <div class="col-md-4">
                <div class="card boder-0 shadow mb-4">
                    {{-- card-header - dropdown --}}
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Pendapatan Bulan Ini</h6>
                    </div>

                    {{-- card body --}}
                    <div class="card-body">
                        <h5>{{ moneyFormat($revenueMonth) }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card boder-0 shadow mb-4">
                    {{-- card-header - dropdown --}}
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Pendapatan Tahun Ini</h6>
                    </div>

                    {{-- card body --}}
                    <div class="card-body">
                        <h5>{{ moneyFormat($revenueYear) }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card boder-0 shadow mb-4">
                    {{-- card-header - dropdown --}}
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Semua Pendapatan</h6>
                    </div>

                    {{-- card body --}}
                    <div class="card-body">
                        <h5>{{ moneyFormat($revenueAll) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- earning (monthly) card example --}}
            <div class="col-xl-3 col-md-6 mb-6">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pending
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $pending }}
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="fas fa-circle-notch fa-spin fa-2x" style="color: #4d72df"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- pending request card example --}}
            <div class="col-xl-3 col-md-6 mb-6">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Success
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $success }}
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x" style="color: #1cc88a"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- pending request card example --}}
            <div class="col-xl-3 col-md-6 mb-6">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Expired
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $expired }}
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x" style="color: #f6c23e"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- pending request card example --}}
            <div class="col-xl-3 col-md-6 mb-6">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Failed
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $failed }}
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="fas fa-times-circle fa-2x" style="color: darkred"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection