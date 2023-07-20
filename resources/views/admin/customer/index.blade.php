@extends('layouts.app', ['title' => 'Customer'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fa fa-users"></i>
                            Customers
                        </h6>
                    </div>

                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">                                    
                                    <input type="text" name="q" id="q" placeholder="cari berdasarkan Nama Customer" class="form-control">
                                    
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-search"></i>
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center; width: 6%">No.</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Bergabung</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($customers as $no => $customer)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $customers->firstItem() + $no  }}</th>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ dateID($customer->created_at) }}</td>
                                        </tr>      
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Belum Tersedia!
                                        </div>   
                                    @endforelse
                                </tbody>
                            </table>

                            <div style="text-align: center">
                                {{-- vendor.pagination.bootstrap-4 harus dipublish lewat php artisan --}}
                                {{ $customers->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection