@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item"><a href="#">Mentor</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Mentor</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Mentor</h1>

    <!-- Content Row -->
    <div class="row">
        <!-- Data Table -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new">
                <div class="card-body">
                    <!-- form  -->
                    <form>
                    <div class="row">
                        <div class="col-xl-3 col-md-3 col-sm-12">
                            <label class="h6 font-weight-bold text-gray-500">Edit Mentor</label>
                        </div>
                        <div class="col-xl-9 col-md-9 col-sm-12">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12">
                            <div class="form-row">
                                
                                <input type="hidden" name="id_mentor" id="id_mentor" value="{{$data_mentor->id}}">
                                <input type="hidden" name="id_mentor" id="id_user" value="{{$data_user->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group col-md-6">
                                    <label for="namamentor">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_mentor" name="nama_mentor" value="{{ $data_mentor->nama }}">
                                    
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $data_user->email }}" >
                                </div>
                                <div class="form-group col-md-12">
                                  <label for="nip">NIP</label>
                                  <input type="text" class="form-control" id="nip" name="nip" value="{{ $data_mentor->nip }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{$data_mentor->jabatan}}">
                                  </div>
                                  {{-- <div class="form-group col-md-6">
                                    <label for="pilihMentor">Pilih Bidang</label>
                                    <select class="js-example-basic-single form-control" name="nama_bidang" id="nama_bidang">
                                        @foreach ($bidangs as $bidang)
                                        <option value={{$bidang->id}} {{$bidang->id == 1 ? 'selected' : ''}}>{{$bidang->nama_bidang}}</option>
                                        @endforeach
                                      </select>
                                  </div> --}}
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
                                <a  rel="nofollow" href="javascript:history.back()" class="text-danger mr-3">Batal</a>
                                <button type="submit" class="btn btn-new" id="btn-update-mentor">update</button>
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