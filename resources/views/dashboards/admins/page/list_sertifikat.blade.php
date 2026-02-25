@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item active" aria-current="page">Sertifikat</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sertifikat</h1>
    </div>

    <!-- Content Row -->              
    <div class="row">
        @include('sweetalert::alert')
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor Pendaftaran</th>
                                    <th>Bidang</th>
                                    <th>Nama Peserta</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($data_peserta as $data)
                              <tr>
                                <td>{{date("Ym",strtotime($data->created_at_)).$data->id}}</td>
                                <td>{{$data->nama_bidang}}</td>
                                <td>{{$data->nama_lengkap}}</td>
                                <td>
                                    <a href="/admin/generate-sertifikat/{{ $data->id }}"><button type="button" class="btn btn-sm btn-outline-new"><i class="fas fa-solid fa-arrow-down fa-sm pr-1"></i> Generate</button></a>
                                    <button type="button" class="btn btn-sm btn-outline-info" id="pilihMentor" data-toggle="modal" data-target="#exampleModal" data-nama="{{$data->nama_lengkap}}"
                                        data-picture="{{ $data->berkas_pas_foto }}" data-nomor-peserta="{{date("Ym",strtotime($data->created_at_)).$data->id}}" data-id="{{$data->id}}"><i class="fas fa-solid fa-arrow-up fa-sm pr-1"></i> Upload</button>
                                </td>
                              </tr>
                              @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload Sertifikat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-4"><img src="/assets_ip2022/img/no-image.png" class="img-thumbnail rounded float-left img-profil" alt="..."></div>
                    <div class="col-xl-8 col-md-8 mb-4">
                        <div class="row">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                          @endif
                            <input type="hidden" id="id_profil" name="id_profil" value="">
                            <div class="col-xl-12 col-md-12 mb-3">
                                <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                    Nomor Pendaftaran</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800" id="nomor_peserta"></div>
                            </div>
                            <div class="col-xl-12 col-md-12 mb-3">
                                <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                    Nama Peserta</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800" id="nama_peserta"></div>
                            </div>
                            <div class="col-xl-12 col-md-12 mb-3">
                                <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                    File Sertifikat</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    <input id="upload" type="file">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <a type="button" class="text-danger mr-3" data-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-new" id="btn-upload-sertifikat">Upload Sertifikat</button>
            </div>
        </div>
        </div>
    </div> 
</div>

@endsection