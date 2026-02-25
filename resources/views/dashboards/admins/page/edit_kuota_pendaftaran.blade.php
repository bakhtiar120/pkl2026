@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item"><a href="/admin/pendaftaran_berjalan">Pendaftaran Berjalan</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Kuota Pendaftaran</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Kuota Pendaftaran</h1>

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
                        <div class="col-xl-3 col-md-3 col-sm-12">
                            <label class="h6 font-weight-bold text-gray-500">Kuota tiap bidang</label>
                        </div>
                        <div class="col-xl-9 col-md-9 col-sm-12">
                        <div class="alert alert-info text-center"><b>Wajib masukan nilai kuota. Apabila tidak dibuka pendaftaran pada suatu bidang, masukan nilai kuota nol (0)</b></div>
                        <input type="hidden" name="inputperiode" id="inputperiode" value={{$id_periode}}>    
                        <div class="form-row">
                                @foreach ($bidangs as $bidang)
                                <div class="form-group col-md-6">
                                  <label for="inputBidang1">{{ $bidang->nama_bidang}}</label>
                                  <input type="hidden" name="idbidang" id="idbidang" value={{$bidang->id_bidang}}>
                                  <input type="number" class="form-control" id="inputBidang" name="inputBidang" value={{$bidang->jumlah_kuota}} placeholder="Belum masukan kuota!">
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
                                <button type="button" class="btn btn-new" id="update-kuota-pendaftaran">Update Kuota</button>
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