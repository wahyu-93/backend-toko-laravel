@extends('layouts.app', ['title' => 'Product'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fa fa-shopping-bag"></i>
                            Produk
                        </h6>
                    </div>

                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm" style="padding-top: 10px">
                                            <i class="fa fa-plus-circle"></i>
                                            Tambah
                                        </a>
                                    </div>
                                    
                                    <input type="text" name="q" id="q" placeholder="cari berdasarkan nama produk" class="form-control">
                                    
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
                                        <th scope="col">Nama Product</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col" style="width: 8%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($products as $no => $product)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $products->firstItem() + $no  }}</th>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.product.edit',$product) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button onclick="Delete(this.id)" class="btn btn-danger btn-sm" id="{{ $product->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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
                                {{ $products->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function Delete(id)
        {
            // get id dan token
            var id = id;
            var token = $("meta[name='csrf-token']").attr('content');
            
            // jalankan swal alert confirmasi
            swal({
                title: "Apakah Anda Yakin ?",
                text: "Ingin Menghapus Data ini!",
                icon: "warning",
                buttons: [
                    "Tidak",
                    "Ya"
                ],
                dangerMode: true
            }).then(function(isConfirm){
                if(isConfirm){
                    // jquery ajax
                    $.ajax({
                        'url': 'product/'+id,
                        'data':{
                            'id': id,
                            '_token': token
                        },
                        type: 'DELETE',
                        success: function(response){
                            console.log(response)
                            if(response.status=='success'){
                                swal({
                                    title: "Berhasil",
                                    text: "Data Berhasil Dihapus",
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButtons: false,
                                    showCancelButtons: false,
                                    buttons: false,
                                }).then(function(){
                                    location.reload()
                                })
                            }
                            else {
                                swal({
                                    title: "Gagal",
                                    text: "Data Gagal Dihapus",
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButtons: false,
                                    showCancelButtons: false,
                                    buttons: false,
                                }).then(function(){
                                    location.reload()
                                })
                            }
                        }
                    })
                }
                else {
                    return true
                }
            })
        
        }
    </script>
@endsection