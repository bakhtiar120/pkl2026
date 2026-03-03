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
                                                            Bidang</button>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Ubah Bidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="id_periode">Pilih Priode Pendaftaran</label>
                        <select class="form-control" name="id_periode" id="id_periode">
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
        function showModal(id) {
            $('#exampleModalCenter').modal("show");
            $(`:input[name='id']`).val(id)
        }

        function list_kuota(id_periode) {
            $.get(`/admin/api/list-kuota/${id_periode}`).done(function(data) {
                var html = ``;
                $.each(data.data, function(key, val) {
                    html +=
                        `<option jumlah_kuota="${val.jumlah_kuota}" value="${val.id}">${val.nama_bidang} </option>`;
                });
                $("#id_kuota").html(html);
                if (!$(`:input[name='id']`).val()) {
                    $(":input[name='id_kuota']").val(data.data[0].id).change();
                    $('#kuota_bidang').val(data.data[0].jumlah_kuota);
                    $("#id_kuota").change();
                }
            });
        }

        $.get(`/admin/api/list-priode-pendaftaran-aktif`).done(function(data) {
            if (data.data.length) {
                var html = ``;
                $.each(data.data, function(key, val) {
                    html +=
                        `<option data-tgl_mulai_pelaksanaan="${val.tgl_mulai_pelaksanaan}"  data-tgl_selesai_pelaksanaan="${val.tgl_selesai_pelaksanaan}" value="${val.id}">${moment(val.tgl_mulai_pendaftaran).locale('id').format('DD MMMM YYYY')} - ${moment(val.tgl_selesai_pendaftaran).locale('id').format('DD MMMM YYYY')}</option>`;
                });
                $("#id_periode").html(html);
                if (data.data) {
                    list_kuota(data.data[0].id);
                    $(":input[name='id_periode']").val(data.data[0].id).change();
                    $(".simpan-kuota").prop('disabled', false);
                }
            } else {
                $(".simpan-kuota").prop('disabled', true);
            }
        });

        $("#id_kuota").change(function() {
            var jumlah_kuota = $(`#id_kuota>[value='${$("#id_kuota").val()}']`).attr('jumlah_kuota');
            $('#kuota_bidang').val(jumlah_kuota);
        });

        $("#id_periode").change(function() {
            var isi =
                `${moment($(`#id_periode>[value='${$("#id_periode").val()}']`).data('tgl_mulai_pelaksanaan')).locale('id').format('DD MMMM YYYY')} - ${moment($(`#id_periode>[value='${$("#id_periode").val()}']`).data('tgl_selesai_pelaksanaan')).locale('id').format('DD MMMM YYYY')}`;
            $('#tglMulaiAndSelesai').val(isi);
            $.get(`/admin/api/list-kuota/${$(this).val()}`).done(function(data) {
                var html = ``;
                $.each(data.data, function(key, val) {
                    html +=
                        `<option jumlah_kuota="${val.jumlah_kuota}" value="${val.id}">${val.nama_bidang} </option>`;
                });
                $("#id_kuota").html(html);
                $(":input[name='id_kuota']").val(data.data[0].id).change();
                $('#kuota_bidang').val(data.data[0].jumlah_kuota);
                $("#id_kuota").change();
            });
        });

        $('.simpan-kuota').on("click", function() {
            $.post(`/admin/api/simpan-pendaftaran`, {
                id_kuota: $("#id_kuota").val(),
                id_profil: $(`:input[name='id']`).val(),
            }).done(function(data) {
                $('#exampleModalCenter').modal("hide");
                location.reload();
            });
        })
    </script>
@endsection
