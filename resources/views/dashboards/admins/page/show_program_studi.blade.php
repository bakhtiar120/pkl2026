@extends('dashboards.admins.index')
  
@section('content')
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item active" aria-current="page">Data Prodi Fakultas Teknik</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Program Studi</h1>
        <span>
            <a href="{{url('/admin/create-prodi')}}" class="d-none d-sm-inline-block btn btn-sm btn-new shadow-sm"><i
                class="fas fa-plus fa-sm pr-1"></i> Program Studi</a>
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
                                    <th>Nama Program Studi</th>
                                    <th>Nama Fakultas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($prodis as $prodi)
                            
                              <tr>
                                <td>{{ $prodi->nama_program_studi }}</td>
                                <td>{{ $prodi->nama_fakultas }}</td>
                                <td>
                                    <a href="{{ url('/admin/edit-prodi/') }}/{{$prodi->id}}"><button type="button" class="btn btn-sm btn-outline-success"><i
                                        class="fas fa-pen fa-sm pr-1"></i>Edit</button></a>
                                        <input type="hidden" value="{{ url('/admin/delete-prodi/') }}/{{$prodi->id}}" id="url_delete">
                                        <a href="{{ url('/admin/delete-prodi/') }}/{{$prodi->id}}"><button type="button" class="btn btn-sm btn-outline-danger delete-confirm"><i
                                        class="fas fa-trash fa-sm pr-1"></i>Hapus</button></a>
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