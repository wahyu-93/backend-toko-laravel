@extends('layouts.app', ['title' => 'Kategori'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-folder"> Kategori</i>
                        </h6>
                    </div>

                    <div class="card-body">
                        <form method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm" style="padding-top: 10px">
                                            <i class="fa fa-plus-circle"></i>
                                            Tambah
                                        </a>
                                    </div>

                                    <input type="text" name="q" id="q" class="form-control" placeholder="cari berdasarkan nama kategori">
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
                                        <th scope="col" style="text-align: center; width:6%">No.</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col" style="text-align: center; width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @forelse($categories as $no => $category)
                                        <tr>
                                            <th scope="row" style="text-align: center">
                                                {{ ++$no + ($categories->currentPage()-1) * $categories->perPage() }}
                                            </th>

                                            <td class="text-center">
                                                <img src="{{ asset($category->image) }}"
                                                    style="width:50px">
                                            </td>

                                            <td>{{ $category->name }}</td>

                                            <td class="text-center">
                                                <a href="{{ route('admin.category.edit', $category->id)  }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>

                                                <button onclick="Delete(this.id)" class="btn btn-danger btn-sm" id="{{ $category->id }}">
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
                                {{ $categories->links("vendor.pagination.bootstrap-4") }}
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
            var id = id;
            var token = $("meta[name='csrf-token']").attr('content')

            swal({
                title: 'Apakah Anda Yakin',
                text: 'Ingin Menghapus Data Ini',
                icon: 'warning',
                buttons: [
                    'Tidak',
                    'Ya'
                ],
                dangerMode: true
            }).then(function(isConfirm){
                // hapus ajax
                $.ajax({
                    url: "/admin/category/" + id,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function(response){
                        console.log(response)
                        if(response.status == "success"){
                            swal({
                                title: 'Berhasil',
                                text: 'Data Berhasil Dihapus',
                                icon: 'success',
                                timer: 1000,
                                buttons: false
                            }).then(function(){
                                location.reload();
                            })
                        }
                        else {
                            swal({
                                title: 'Gagal',
                                text: 'Data Gagal Dihapus',
                                icon: 'error',
                                timer: 1000,
                                buttons: false
                            }).then(function(){
                                location.reload();
                            }) 
                        }
                    }
                })
            })
        }
                  
    </script>
@endsection
