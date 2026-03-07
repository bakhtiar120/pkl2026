@extends('dashboards.admins.index')

@section('content')
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="/admin/pendaftaran_berjalan">Pendaftaran Berjalan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buat Pendaftaran</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Buat Pendaftaran</h1>

        <!-- Content Row -->
        <div class="row">
            <!-- Data Table -->
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow-new">
                    <div class="card-body">
                        <!-- form  -->
                        <form>
                            @csrf
                            <div class="row">
                                <div class="col-xl-3 col-md-9 col-sm-12">
                                    <label class="h6 font-weight-bold text-gray-500">Waktu</label>
                                </div>
                                <div class="col-xl-9 col-md-9 col-sm-12">

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputDate1">Periode Pendaftaran</label>
                                            <input type="text" class="form-control" id="tgl_pendaftaran"
                                                name="tgl_pendaftaran" />

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputDate1">Periode Pelaksanaan</label>
                                            <input type="text" class="form-control" id="tgl_pelaksanaan"
                                                name="tgl_pelaksanaan" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-3 col-sm-12">
                                    <label class="h6 font-weight-bold text-gray-500">Unit Bidang</label>
                                </div>

                                <div class="col-xl-9 col-md-9 col-sm-12">

                                    <div id="unit-container"></div>

                                    <button type="button" class="btn btn-sm btn-primary mt-2" id="add-unit">
                                        + Tambah Unit Bidang
                                    </button>

                                </div>
                            </div>
                            <div id="unit-template" style="display:none;">

                                <div class="card mb-3 unit-card">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>Unit Bidang</label>
                                            <select class="form-control unit-select">
                                                <option value="">-- Pilih Unit --</option>
                                                @foreach ($unit_bidangs as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row bidang-wrapper">

                                            @foreach ($bidangs as $bidang)
                                                <div class="col-md-6 mb-2">
                                                    <label>{{ $bidang->nama_bidang }}</label>

                                                    <input type="hidden" class="id-bidang" value="{{ $bidang->id }}">

                                                    <input type="number" class="form-control kuota-input" value="0">
                                                </div>
                                            @endforeach

                                        </div>

                                        <button type="button" class="btn btn-danger btn-sm mt-2 remove-unit">
                                            Hapus Unit
                                        </button>
                                        <div class="mt-2 text-end">
                                            <strong>Total Kuota: <span class="total-kuota">0</span></strong>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12">
                                    <span class="float-right">
                                        <a rel="nofollow" href="javascript:history.back()"
                                            class="text-danger mr-3">Batal</a>
                                        <button type="button" class="btn btn-new" id="btn-pendaftaran">Simpan dan
                                            Terbitkan</button>
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
