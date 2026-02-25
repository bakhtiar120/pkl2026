@extends('dashboards.admins.index')
  
@section('content')
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item active" aria-current="page">Data Admin</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin</h1>
        <span>
          <a href="javascript:void(0)" id="createnewadmin" class="d-none d-sm-inline-block btn btn-sm btn-new shadow-sm"><i
            class="fas fa-plus fa-sm pr-1"></i> Tambah Admin</a>
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
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Tanggal Pembuatan</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($admins as $admin)
                              <tr>
                                <td>{{ $admin->email }}</td>
                                <td>Admin</td>
                                <td>{{$admin->created_at->isoFormat('D MMMM Y')}}</td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="CustomerForm" name="CustomerForm" class="form-horizontal">
                       {{-- <input type="hidden" name="Customer_id" id="Customer_id"> --}}
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="" maxlength="50" required="">
                            </div>
                        </div>
    
                        <div class="col-sm-offset-2 col-sm-10">
                         <button type="submit" class="btn btn-primary" id="savebtnadmin" value="create">Simpan Data
                         </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection