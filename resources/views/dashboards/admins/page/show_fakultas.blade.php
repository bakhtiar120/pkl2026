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
        <h1 class="h3 mb-0 text-gray-800">Fakultas</h1>
        <span>
            <a href="{{url('/admin/create-fakultas')}}" class="d-none d-sm-inline-block btn btn-sm btn-new shadow-sm"><i
                class="fas fa-plus fa-sm pr-1"></i> Fakultas</a>
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
                                    <th>Nama Fakultas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($fakultas as $fakultas1)
                              <tr>
                                <td>{{ $fakultas1->id }}</td>
                                <input type="hidden" value="{{ url('/admin/delete-fakultas/') }}/{{$fakultas1->id}}" id="url_delete_fakultas">
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-success"><i
                                        class="fas fa-pen fa-sm pr-1"></i>Edit</button>
                                        
                                        <a class="delete-confirm-fakultas" href="{{ url('/admin/delete-fakultas/') }}/{{$fakultas1->id}}" id="button_delete_fakultas" ><button type="button" class="btn btn-sm btn-outline-danger "><i
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