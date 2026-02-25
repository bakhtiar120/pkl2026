@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Library</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Buat Data Fakultas</h1>

    <!-- Content Row -->
    <div class="row">
        <!-- Data Table -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new">
                <div class="card-body">
                    <!-- form  -->
                    <form action="{{ url('/admin/create-fakultas') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-3 col-md-9 col-sm-12">
                            <label class="h6 font-weight-bold text-gray-500">Waktu</label>
                        </div>
                        <div class="col-xl-9 col-md-9 col-sm-12">
                    
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputDate1">Nama Fakultas</label>
                                    <input type="text" class="form-control" id="nama_fakultas" name="nama_fakultas" />
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <span class="float-right">
                                    <a target="_blank" rel="nofollow" href="" class="text-danger mr-3">Batal</a>
                                    <button type="submit" class="btn btn-new" id="simpan-fakultas">Simpan Data</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection