@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item active" aria-current="page">Nilai Peserta </li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nilai Peserta </h1>
        
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Periode Pendaftaran</th>
                                    <th>Periode Pelaksanaan</th>
                                    <th>Total Kuota</th>
                                    <th>Total Peserta Lolos</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($periodes as $periode)
                                <tr>
                                  <td>{{date('d F Y', strtotime($periode->tgl_mulai_pendaftaran))}}<br>{{date('d F Y', strtotime($periode->tgl_selesai_pendaftaran))}} </td>
                                  <td>{{date('d F Y', strtotime($periode->tgl_mulai_pelaksanaan));}}<br>{{date('d F Y', strtotime($periode->tgl_selesai_pelaksanaan))}}</td>
                                  <td>{{$periode->jumlah_kuota}}</td>
                                  <td>{{$periode->jumlah_lolos}}</td>
                                  <td>
                                      <a href="{{ url('/admin/detail-nilai-peserta-bidang-pendaftaran/') }}/{{$periode->id}}"> <button type="button" class="btn btn-sm btn-outline-new">Detail</button></a>
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