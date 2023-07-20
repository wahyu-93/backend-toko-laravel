@extends('layouts.app', ['title' => 'Order'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fa fa-shopping-bag"></i>
                            Orders
                        </h6>
                    </div>

                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">                                    
                                    <input type="text" name="q" id="q" placeholder="cari berdasarkan No. Invoice" class="form-control">
                                    
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
                                        <th scope="col">No. Invoice</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Grand Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" style="width: 8%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($invoices as $no => $order)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $invoices->firstItem() + $no  }}</th>
                                            <td>{{ $order->invoice }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->grand_total }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.order.show',$order) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-list-ul"></i>
                                                </a>
                                            </td>
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
                                {{ $invoices->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection