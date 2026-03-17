@extends('dashboards.admins.index')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="/admin/pendaftaran_berjalan">Pendaftaran Berjalan</a></li>
                <li class="breadcrumb-item active">Edit Kuota Pendaftaran</li>
            </ol>
        </nav>

        <h1 class="h3 mb-4 text-gray-800">Edit Kuota Pendaftaran</h1>

        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow-new">
                    <div class="card-body">

                        <form>
                            @csrf

                            <input type="hidden" id="inputperiode" value="{{ $id_periode }}">

                            <div class="row">

                                <!-- LEFT PANEL -->
                                <div class="col-xl-3">

                                    <label>Tambah Unit</label>

                                    <select class="form-control" id="select-unit">
                                        <option value="">-- Pilih Unit --</option>

                                        @foreach ($unit_bidangs as $unit)
                                            <option value="{{ $unit->id }}"
                                                @if (isset($units[$unit->id])) disabled @endif>
                                                {{ $unit->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <ul class="nav flex-column nav-pills mt-3" id="unit-list">

                                        @php $i=0; @endphp

                                        @foreach ($units as $unitId => $data)
                                            @php
                                                $i++;
                                                $unitName = $data[0]->nama_unit;
                                            @endphp

                                            <li class="nav-item">

                                                <a class="nav-link {{ $i == 1 ? 'active' : '' }}" data-toggle="pill"
                                                    href="#unit_{{ $i }}">

                                                    <div class="d-flex justify-content-between w-100">

                                                        <div>
                                                            {{ $unitName }}
                                                            <strong>(<span class="nav-total">
                                                                    {{ collect($data)->sum('jumlah_kuota') }}
                                                                </span>)</strong>
                                                        </div>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger remove-unit">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                    </div>

                                                </a>

                                            </li>
                                        @endforeach

                                    </ul>


                                </div>

                                <!-- RIGHT PANEL -->
                                <div class="col-xl-9">

                                    <div class="tab-content" id="unit-tab-content">

                                        @php $i=0; @endphp

                                        @foreach ($units as $unitId => $data)
                                            @php $i++; @endphp

                                            <div class="tab-pane fade {{ $i == 1 ? 'show active' : '' }}"
                                                id="unit_{{ $i }}">

                                                <input type="hidden" class="unit-id-input" value="{{ $unitId }}">

                                                <div class="row bidang-wrapper">

                                                    @foreach ($bidangs as $bidang)
                                                        @php
                                                            $kuota = collect($data)
                                                                ->where('id_bidang', $bidang->id)
                                                                ->first();
                                                        @endphp

                                                        <div class="col-md-6 mb-2">

                                                            <label>{{ $bidang->nama_bidang }}</label>

                                                            <input type="hidden" value="{{ $bidang->id }}"
                                                                class="id-bidang">

                                                            <input type="number" class="form-control kuota-input"
                                                                value="{{ $kuota->jumlah_kuota ?? 0 }}">

                                                        </div>
                                                    @endforeach

                                                </div>

                                                <div class="mt-2">
                                                    <strong>Total Kuota:
                                                        <span class="total-kuota">
                                                            {{ collect($data)->sum('jumlah_kuota') }}
                                                        </span>
                                                    </strong>
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>


                                </div>

                            </div>
                            <div id="unit-template" style="display:none;">

                                <div class="tab-pane fade unit-tab" id="unit_INDEX">

                                    <input type="hidden" class="unit-id-input">

                                    <div class="row bidang-wrapper">

                                        @foreach ($bidangs as $bidang)
                                            <div class="col-md-6 mb-2">
                                                <label>{{ $bidang->nama_bidang }}</label>

                                                <input type="hidden" value="{{ $bidang->id }}" class="id-bidang">

                                                <input type="number" class="form-control kuota-input" value="0">
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="mt-2">
                                        <strong>Total Kuota:
                                            <span class="total-kuota">0</span>
                                        </strong>
                                    </div>

                                </div>

                            </div>

                            <hr>

                            <div class="text-right">
                                <a href="javascript:history.back()" class="text-danger mr-3">Batal</a>
                                <button type="button" class="btn btn-new" id="update-kuota-pendaftaran">
                                    Update Kuota
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
