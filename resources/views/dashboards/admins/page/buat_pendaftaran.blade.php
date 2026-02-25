@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item"><a href="/admin/pendaftaran_berjalan">Pendaftaran Berjalan</a></li>
          <li class="breadcrumb-item active" aria-current="page">Buat Pendaftaran</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Buat Pendaftaran</h1>

    <!-- Content Row -->
    <div class="row">
        <!-- Data Table -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new">
                <div class="card-body">
                    <!-- form  -->
                    <form>
                    @csrf
                    <div class="row">
                        <div class="col-xl-3 col-md-9 col-sm-12">
                            <label class="h6 font-weight-bold text-gray-500">Waktu</label>
                        </div>
                        <div class="col-xl-9 col-md-9 col-sm-12">
                    
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputDate1">Periode Pendaftaran</label>
                                    <input type="text" class="form-control" id="tgl_pendaftaran" name="tgl_pendaftaran" />
                                    
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputDate1">Periode Pelaksanaan</label>
                                    <input type="text" class="form-control" id="tgl_pelaksanaan" name="tgl_pelaksanaan" />
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-3 col-sm-12">
                            <label class="h6 font-weight-bold text-gray-500">Kuota tiap bidang</label>
                        </div>
                        <div class="col-xl-9 col-md-9 col-sm-12">
                        <div class="alert alert-info text-center"><b>Wajib masukan nilai kuota. Apabila tidak dibuka pendaftaran pada suatu bidang, masukan nilai kuota nol (0)</b></div>
                            <div class="form-row">
                                @foreach ($bidangs as $bidang)
                                <div class="form-group col-md-6">
                                  <label for="inputBidang1">{{ $bidang->nama_bidang}}</label>
                                  <input type="hidden" name="idbidang" id="idbidang" value={{$bidang->id}}>
                                  <input type="number" class="form-control" id="inputBidang" name="inputBidang" value="0" placeholder="Belum masukan kuota!">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12"><hr></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <span class="float-right">
                                <a rel="nofollow" href="javascript:history.back()" class="text-danger mr-3">Batal</a>
                                <button type="button" class="btn btn-new" id="btn-pendaftaran">Simpan dan Terbitkan</button>
                            </span>
                        </div>
                    </div>
                    
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection