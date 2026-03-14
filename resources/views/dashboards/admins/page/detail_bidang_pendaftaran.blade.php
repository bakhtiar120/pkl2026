@extends('dashboards.admins.index')

@section('content')
    <div class="container-fluid">

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-0">
                <li class="breadcrumb-item"><a href="/admin/pendaftaran_berjalan">Pendaftaran Berjalan</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Detail Periode</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Bidang</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Detail Bidang</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            @include('sweetalert::alert')
            <!-- Card Detail -->
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card border-left-new shadow-new h-100 py-2">
                    <div class="card-body">
                        <div class="row">

                            <div class="col mb-2">
                                <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                    Periode Pendaftaran
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ date('d F Y', strtotime($query_pendaftaran->tgl_mulai_pendaftaran)) }}<br>
                                    {{ date('d F Y', strtotime($query_pendaftaran->tgl_selesai_pendaftaran)) }}
                                </div>
                            </div>

                            <div class="col mb-2">
                                <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                    Periode Pelaksanaan
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ date('d F Y', strtotime($query_pendaftaran->tgl_mulai_pelaksanaan)) }}<br>
                                    {{ date('d F Y', strtotime($query_pendaftaran->tgl_selesai_pelaksanaan)) }}
                                </div>
                            </div>

                            <div class="col mb-2">
                                <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                    Unit Kerja
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $query_pendaftaran->name }}
                                </div>
                            </div>

                            <div class="col mb-2">
                                <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                    Bidang
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $query_pendaftaran->nama_bidang }}
                                </div>
                            </div>

                            <div class="col mb-2">
                                <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                    Kuota / Peserta Lolos
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $query_pendaftaran->jumlah_kuota }} / {{ $jumlah_lolos }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card shadow-new mb-4">
                    <div class="card-body">

                        <!-- nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="belumverifikasi-tab" data-toggle="tab"
                                    href="#belumverifikasi" role="tab" aria-controls="belumverifikasi"
                                    aria-selected="true">Belum Verifikasi</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="lolos-tab" data-toggle="tab" href="#lolos" role="tab"
                                    aria-controls="lolos" aria-selected="false">Lolos</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tidaklolos-tab" data-toggle="tab" href="#tidaklolos" role="tab"
                                    aria-controls="tidaklolos" aria-selected="false">Tidak lolos</a>
                            </li>
                        </ul>
                        <!-- nav tabs end -->
                        <!-- tab content -->
                        <div class="tab-content" id="myTabContent">
                            <!-- belum verifikasi -->
                            <div class="tab-pane fade show active" id="belumverifikasi" role="tabpanel"
                                aria-labelledby="belumverifikasi-tab">
                                <div class="table-responsive mt-4">
                                    <table class="table table-hover" id="dataTable1" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nomor Pendafaran</th>
                                                <th>Nama Peserta</th>
                                                <th>Detail</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($member_not_verified as $member_1)
                                                <tr>
                                                    <td>{{ date('Ym', strtotime($member_1->created_at_)) . $member_1->id_member }}
                                                    </td>
                                                    <td>{{ $member_1->nama_lengkap }}</td>
                                                    <td>
                                                        <a href="/admin/detail-profile/{{ $member_1->id_member }}"><button
                                                                type="button"
                                                                class="btn btn-sm btn-outline-new">Detail</button></a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-outline-success terima-magang"
                                                            data-id="{{ $member_1->id_member }}"><i
                                                                class="fas fa-solid fa-check fa-sm pr-1"></i>Terima</a>
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-sm btn-outline-danger tolak-magang"
                                                            data-id="{{ $member_1->id_member }}"><i
                                                                class="fas fa-solid fa-times fa-sm pr-1"></i>Tolak</a>
                                                        <button onclick="showModal({{ $member_1->id_member }})"
                                                            type="button" class="btn btn-sm btn-outline-warning">Ubah
                                                            Unit Kerja & Bidang</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- belum verifikasi end-->
                            <!-- lolos -->
                            <div class="tab-pane fade" id="lolos" role="tabpanel" aria-labelledby="lolos-tab">
                                <div class="table-responsive mt-4">
                                    <table class="table table-hover" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nomor Pendafaran</th>
                                                <th>Nama Peseerta</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($member as $member1)
                                                <tr>
                                                    <td>{{ date('Ym', strtotime($member1->created_at_)) . $member1->id_member }}
                                                    </td>
                                                    <td>{{ $member1->nama_lengkap }}</td>
                                                    <td>
                                                        <a href="/admin/detail-profile/{{ $member1->id_member }}"><button
                                                                type="button"
                                                                class="btn btn-sm btn-outline-new">Detail</button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- lolos end -->
                            <!-- tidak lolos -->
                            <div class="tab-pane fade" id="tidaklolos" role="tabpanel" aria-labelledby="tidaklolos-tab">
                                <div class="table-responsive mt-4">
                                    <table class="table table-hover" id="dataTable3" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nomor Pendafaran</th>
                                                <th>Nama Peserta</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($member_not_lolos as $membernl)
                                                <tr>
                                                    <td>{{ date('Ym', strtotime($membernl->created_at_)) . $membernl->id_member }}
                                                    </td>
                                                    <td>{{ $membernl->nama_lengkap }}</td>
                                                    <td>
                                                        <a href="/admin/detail-profile/{{ $membernl->id_member }}"><button
                                                                type="button"
                                                                class="btn btn-sm btn-outline-new">Detail</button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- tidak lolos end -->
                        </div>
                        <!-- tab content end -->





                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ubah Unit Kerja dan Bidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="id_periode">Pilih Periode Pendaftaran</label>
                        <select class="form-control" name="id_periode" id="id_periode">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_unit_kerja">Pilih Unit Kerja</label>
                        <select class="form-control" id="id_unit_kerja" name="id_unit_kerja">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_kuota">Pilih Bidang PKL</label>
                        <select class="form-control" id="id_kuota" name="id_kuota">
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Periode Pelaksanaan</label>
                        <input id="tglMulaiAndSelesai" class="form-control" value="-" type="text" disabled>
                    </div>


                    <div class="form-group">
                        <label>Kuota Bidang PKL</label>
                        <input id="kuota_bidang" class="form-control" value="0" type="number" disabled>
                    </div>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary simpan-kuota">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let selectedPeriode = null
        let selectedUnit = null
        let selectedKuota = null

        function showModal(id, periode = null, unit = null, kuota = null) {

            $('#exampleModalCenter').modal("show")

            $(":input[name='id']").val(id)

            selectedPeriode = periode
            selectedUnit = unit
            selectedKuota = kuota

            loadPeriode()

        }


        /* =========================
           LOAD PERIODE
        ========================= */

        function loadPeriode() {

            $.get(`/admin/api/list-priode-pendaftaran-aktif`).done(function(res) {

                let html = ``

                $.each(res.data, function(i, val) {

                    html += `<option 
                        data-mulai="${val.tgl_mulai_pelaksanaan}"
                        data-selesai="${val.tgl_selesai_pelaksanaan}"
                        value="${val.id}">
                        ${moment(val.tgl_mulai_pendaftaran).locale('id').format('DD MMMM YYYY')}
                        -
                        ${moment(val.tgl_selesai_pendaftaran).locale('id').format('DD MMMM YYYY')}
                     </option>`
                })

                $("#id_periode").html(html)

                let periode = selectedPeriode ?? res.data[0].id

                $("#id_periode").val(periode)

                updateTanggal()

                loadUnitKerja(periode)

            })

        }


        /* =========================
           LOAD UNIT KERJA
        ========================= */

        function loadUnitKerja(id_periode) {

            $("#id_unit_kerja").html(`<option>Loading...</option>`)

            $.get(`/admin/api/list-unit-kerja/${id_periode}`).done(function(res) {

                let html = ``

                $.each(res.data, function(i, val) {
                    html += `<option value="${val.id}">${val.name}</option>`
                })

                $("#id_unit_kerja").html(html)

                let unit = selectedUnit ?? res.data[0].id

                $("#id_unit_kerja").val(unit)

                loadBidang(id_periode, unit)

            })

        }


        /* =========================
           LOAD BIDANG
        ========================= */

        function loadBidang(id_periode, id_unit) {

            $("#id_kuota").html(`<option>Loading...</option>`)

            $.get(`/admin/api/list-kuota/${id_periode}/${id_unit}`).done(function(res) {

                let html = ``

                $.each(res.data, function(i, val) {

                    html += `<option 
                        jumlah_kuota="${val.jumlah_kuota}" 
                        value="${val.id}">
                        ${val.nama_bidang}
                     </option>`
                })

                $("#id_kuota").html(html)

                let kuota = selectedKuota ?? res.data[0].id

                $("#id_kuota").val(kuota).change()

            })

        }


        /* =========================
           UPDATE TANGGAL
        ========================= */

        function updateTanggal() {

            let mulai = $("#id_periode option:selected").data("mulai")
            let selesai = $("#id_periode option:selected").data("selesai")

            $('#tglMulaiAndSelesai').val(
                `${moment(mulai).locale('id').format('DD MMMM YYYY')} - ${moment(selesai).locale('id').format('DD MMMM YYYY')}`
            )

        }


        /* =========================
           EVENT
        ========================= */

        $("#id_periode").change(function() {

            selectedUnit = null
            selectedKuota = null

            updateTanggal()

            loadUnitKerja($(this).val())

        })


        $("#id_unit_kerja").change(function() {

            selectedKuota = null

            loadBidang($("#id_periode").val(), $(this).val())

        })


        $("#id_kuota").change(function() {

            let kuota = $("#id_kuota option:selected").attr("jumlah_kuota")

            $("#kuota_bidang").val(kuota)

        })


        /* =========================
           SIMPAN
        ========================= */

        $(".simpan-kuota").click(function() {

            $.post(`/admin/api/simpan-pendaftaran`, {

                id_kuota: $("#id_kuota").val(),
                id_profil: $(":input[name='id']").val()

            }).done(function(res) {

                if (res.status == "success") {

                    alert("Data berhasil disimpan")

                    $('#exampleModalCenter').modal("hide")

                    location.reload()

                } else {

                    alert(res.message)

                }

            }).fail(function() {

                alert("Terjadi kesalahan server")

            })

        })
    </script>
@endsection
