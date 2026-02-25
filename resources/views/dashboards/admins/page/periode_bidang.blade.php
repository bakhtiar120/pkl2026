@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    @include('sweetalert::alert')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item"><a href="#">Pendaftaran Berjalan</a></li>
          <li class="breadcrumb-item"><a href="#">Detail Periode</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail Bidang</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">Detail Bidang</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Card Detail -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-new shadow-new h-100 py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-3 mb-2">
                            <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                Periode Pendaftaran</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">18 Januari 2022<br>29 Januari 2022</div>
                        </div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                Periode Pelaksanaan</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">01 Maret 2022<br>31 Maret 2022</div>
                        </div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                Bidang</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">Listrik</div>
                        </div>
                        <div class="col-xl-3 col-md-3 mb-2">
                            <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                Kuota / Peserta Lolos</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">5 / 3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor Pendafaran</th>
                                    <th>Nama Peseerta</th>
                                    <th>Detail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                              <tr>
                                <td>4103141060</td>
                                <td>Garinda Resnu Philipus</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-new">Detail</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-success">Terima</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">Tolak</button>
                                </td>
                              </tr>
                              <tr>
                                <td>4103141049</td>
                                <td>Uca Candra</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-new">Detail</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-success">Terima</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">Tolak</button>
                                </td>
                              </tr>
                              <tr>
                                <td>4103141036</td>
                                <td>Della Dwi Indri Atika</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-new">Detail</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-success">Terima</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">Tolak</button>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection