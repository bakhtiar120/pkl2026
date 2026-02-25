@extends('dashboards.admins.index')
  
@section('content')
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item active" aria-current="page">Data Mentor</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mentor</h1>
        <span>
          <a href="{{url('/admin/create-mentor')}}" class="d-none d-sm-inline-block btn btn-sm btn-new shadow-sm"><i
            class="fas fa-plus fa-sm pr-1"></i> Tambah Mentor</a>
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
                                    <th>Nama Mentor</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($mentors as $mentor)
                              <tr>
                                <td>{{ $mentor->nama }}</td>
                                <td>{{ $mentor->nip }}</td>
                                <td>{{ $mentor->jabatan }}</td>
                                <td>
                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-success edit-mentor" data-id="{{ $mentor->id }}"><i
                                        class="fas fa-pen fa-sm pr-1"></i>Edit</a>
                                    <input type="hidden" value="{{ url('/admin/delete-mentor/') }}/{{$mentor->id}}" id="url_delete_mentor">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger delete-confirm-mentor" data-id="{{ $mentor->id}}"><i
                                      class="fas fa-trash fa-sm pr-1"></i>Delete</a>
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