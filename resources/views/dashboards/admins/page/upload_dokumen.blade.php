@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item active" aria-current="page">Surat Edaran</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Surat Edaran</h1>

    <!-- Content Row -->
    <div class="row">
        <!-- Data Table -->
        <div class="col-xl-12 col-md-12 mb-4">
        @include('sweetalert::alert')
            <div class="card shadow-new">
                <div class="card-body">
                    <!-- form  -->
                    <form>
                    <div class="row">
                        <div class="col-xl-3 col-md-3 col-sm-12">
                            <label class="h6 font-weight-bold text-gray-500">Upload Dokumen</label>
                        </div>
                        <div class="col-xl-9 col-md-9 col-sm-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>File Upload</label>
                                    <div class="input-group d-flex align-items-center">
                                        <input type="file" class="form-control-file" id="upload_dokumen" name="upload_dokumen" accept="application/pdf" >
                                    </div>
                                    <p class="mt-2" id="uploaddokumencheck"
                        style="color: red">
                        File Harus dipilih
                    </p>
                                </div>
                                <div class="col-md-6"></div>
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group col-md-6">
                                    <label for="namadokumen">Nama Dokumen</label>
                                    <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" placeholder="Nama Dokumen">
                                    <p class="mt-2" id="namadokumencheck"
                        style="color: red">
                        Nama Dokumen Wajib diisi
                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12"><hr></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <span class="float-right">
                                <a rel="nofollow" href="javascript:history.back()"  class="text-danger mr-3">Batal</a>
                                <button type="submit" class="btn btn-new" id="btn-upload-dokumen" disabled>Upload</button>
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