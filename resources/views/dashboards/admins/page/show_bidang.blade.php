@extends('dashboards.admins.index')
  
@section('content')
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item active" aria-current="page">Data Bidang</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bidang</h1>
        <span>
          <a href="{{url('/admin/create-bidang')}}" class="d-none d-sm-inline-block btn btn-sm btn-new shadow-sm"><i
            class="fas fa-plus fa-sm pr-1"></i>Tambah Bidang</a>
        </span>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Bidang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($bidangs as $bidang)
                              <tr>
                                <td>{{ $bidang->nama_bidang }}</td>
                                <td>
                                <a href="edit-data-bidang/{{ $bidang->id }}" class="btn btn-sm btn-outline-success" data-id="{{ $bidang->id }}"><i
                                        class="fas fa-pen fa-sm pr-1"></i>Edit</a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger delete-confirm-bidang" data-id="{{ $bidang->id }}"><i
                                          class="fas fa-trash fa-sm pr-1"></i>Hapus</a>
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
    <div class="modal fade" id="ajax-bidang-model" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ajaxBidangModel"></h4>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="addEditBidangForm" name="addEditBookForm" class="form-horizontal" method="POST">
              <input type="hidden" name="id" id="id">
              @csrf
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nama Bidang</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" placeholder="Masukkan Nama Bidang" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBidang">Simpan Data
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>

</div>
@endsection