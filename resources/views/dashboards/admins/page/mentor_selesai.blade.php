@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item active" aria-current="page">Selesai Pilih Mentor</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selesai Pilih Mentor</h1>
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
                                    <th>Nama Mentor</th>
                                    <th>Detail Peserta</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($data_peserta as $data)
                              <tr>
                                <td>{{date("Ym",strtotime($data->created_at_)).$data->id}}</td>
                                <td>{{$data->nama_bidang}}</td>
                                <td>{{$data->nama_lengkap}}</td>
                                <td>{{$data->nama}}</td>
                                <td>
                                    <a href="/admin/detail-profile/{{ $data->id_member }}"><button type="button" class="btn btn-sm btn-outline-new">Detail</button></a>
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

</div>

@endsection