@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item"><a href="/admin/show-data-mentor">Mentor</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tambah Mentor</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Mentor</h1>

    <!-- Content Row -->
    <div class="row">
        <!-- Data Table -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new">
                <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12">
                        <div class="alert alert-info">
                            Password mentor secara default adalah "12345678". Mentor dapat merubah password melalui aplikasi Mentor -> Ubah Password.
                        </div>
                    </div>
                </div>
                    <!-- form  -->
                    <form>
                    <div class="row">
                        <div class="col-xl-3 col-md-3 col-sm-12">
                            <label class="h6 font-weight-bold text-gray-500">Tambah Mentor</label>
                        </div>
                        <div class="col-xl-9 col-md-9 col-sm-12">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <div class="form-row">
                                
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group col-md-12">
                                    <label for="namamentor">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_mentor" name="nama_mentor" placeholder="Nama mentor">
                                    @if ($errors->has('nama_mentor'))
                                    <span class="text-danger">{{ $errors->first('nama_mentor') }}</span>
                                @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                                </div>
                                <div class="form-group col-md-12">
                                  <label for="nip">NIP</label>
                                  <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan">
                                  </div>
                                  <div class="form-group col-md-12">
                                    <label for="pilihMentor">Pilih Bidang</label>
                                    <select class="js-example-basic-single form-control" name="nama_bidang" id="nama_bidang">
                                        @foreach ($bidangs as $bidang)
                                        <option value={{$bidang->id}}>{{$bidang->nama_bidang}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12"><hr></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <span class="float-right">
                                <a  rel="nofollow" href="javascript:history.back()" class="text-danger mr-3">Batal</a>
                                <button type="submit" class="btn btn-new" id="btn-save-data-mentor">Simpan Perubahan</button>
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