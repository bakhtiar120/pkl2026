@extends('dashboards.admins.index')

@section('content')
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item active" aria-current="page">Data Unit Kerja</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        @include('sweetalert::alert')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Unit Kerja</h1>
            <span>
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-new shadow-sm" id="createNewUnitKerja">
                    <i class="fas fa-plus fa-sm pr-1"></i>Tambah Unit Kerja
                </button>
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
                                        <th>Nama Unit Kerja</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($unitkerjas as $unit)
                                        <tr>
                                            <td>{{ $unit->name }}</td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-outline-success editUnitKerja"
                                                    data-id="{{ $unit->id }}">
                                                    <i class="fas fa-pen fa-sm pr-1"></i>Edit
                                                </a>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-outline-danger delete-confirm-unit-kerja"
                                                    data-id="{{ $unit->id }}"><i
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
        <div class="modal fade" id="ajax-unit-kerja-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ajaxUnitKerjaModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditUnitKerjaForm" name="addEditUnitKerjaForm"
                            class="form-horizontal" method="POST">
                            <input type="hidden" name="id" id="id">
                            @csrf
                            <div class="form-group">
                                <label>Nama Unit Kerja</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Masukkan Nama Unit Kerja" required>
                            </div>
                            <div class="form-group mt-3 text-left">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Data
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
