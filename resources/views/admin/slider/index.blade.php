@extends('layouts.app', ['title' => 'Sliders'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fa fa-image"></i>
                            Upload Slider
                        </h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                           <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">

                                    @error('image')
                                        <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" name="link" id="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}">

                                    @error('link')
                                        <span class="invalid-feedback" style="display: block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-paper-plane"></i>
                                        Simpan
                                    </button>

                                    <button type="reset" class="btn btn-warning btn-sm">
                                        <i class="fa fa-redo"></i>
                                        Reset
                                    </button>
                                </div>
                           </form>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fa fa-laptop"></i>
                            Sliders
                        </h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center; width: 6%">No.</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Link</th>
                                        <th scope="col" style="width: 10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($sliders as $no => $slider)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $sliders->firstItem() + $no  }}</th>
                                            <td>
                                                <img src="{{ $slider->image }}" alt="gagal load" style="width: 200px" class="text-center">
                                            </td>
                                            <td>{{ $slider->link }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm" id="{{ $slider->id }}" onClick="Delete(this.id)">
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
                                {{ $sliders->links("vendor.pagination.bootstrap-4") }}
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
            var token = $('meta[name=csrf-token]').attr('content');

            // confirm swal 
            swal ({
                title: 'Apakah Anda Yakin?',
                text: 'Data Akan Dihapus',
                icon: 'warning',
                buttons: [
                    'Tidak',
                    'Ya'
                ],
                dangerMode: true
            }).then(function(isConfirm){
                if(isConfirm){
                    $.ajax({
                        'url': 'slider/' + id,
                        'type': 'DELETE',
                        'data':{
                            'id': id,
                            '_token': token
                        },
                        success: function(response){
                            if(response.status=='success'){
                                swal({
                                    title: 'Berhasil',
                                    text: 'Data Berhasil Dihapus',
                                    timer: 1000,
                                    showConfirmButtons: false,
                                    showCancelButtons: false,
                                    buttons:false,
                                }).then(function(){
                                    location.reload()
                                })
                            }
                            else {
                                swal({
                                    title: 'Gagal',
                                    text: 'Data Gagal Dihapus',
                                    timer: 1000,
                                    showConfirmButtons: false,
                                    showCancelButtons: false,
                                    buttons:false,
                                }).then(function(){
                                    location.reload()
                                })
                            }
                        }
                    })
                }
                else {
                    return true;
                }
            })
        }
    </script>
@endsection