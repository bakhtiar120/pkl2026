@inject('profile', 'App\Models\ProfilMember')
@inject('pendaftaran', 'App\Models\Pendaftaran')
@php
    $akses = $profile
        ::join('pendaftaran', 'profil_member.id', '=', 'pendaftaran.id_profil')
        ->where('user_id', Auth::user()->id)
        ->first();
@endphp
@if ($akses != null)
    @if ($akses->status_pendaftaran == 'Belum Verifikasi')
        <script>
            window.location = "/user/proses";
        </script>
    @elseif($akses->status_pendaftaran == 'Lolos')
        <script>
            window.location = "/user/dashboard";
        </script>
    @endif
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PKL Online Indonesia Power</title>
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets_ip2022/img/favicon.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <!-- <link href="/assets_ip2022/vendor/aos/aos.css" rel="stylesheet"> -->
    <link href="/assets_ip2022/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets_ip2022/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets_ip2022/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets_ip2022/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets_ip2022/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets_ip2022/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets_ip2022/css/style.css" rel="stylesheet">

    <!-- style form winzard -->
    <link href="/assets_ip2022/css/style2.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: FlexStart - v1.9.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="" class="header fixed-top header-scrolled">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="/assets_ip2022/img/logo.png" alt="">
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="">{{ Auth::user()->email }}</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('logout.perform') }}">Keluar&nbsp;<i
                                class="bi bi-box-arrow-right" style="font-size: 20px;"></i></a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->
    <main id="main">
        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog " style="background-color: #F5F5F5;">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="row pt-5 ">
                    <h4>Pendaftaran PKL online</h4>
                    <div class="col-lg-12 entries">
                        <article class="entry" style="background-color: #FFFFFF;border-radius: 8px;">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-1">
                                    <form id="formdatadiri" class="f1">
                                        <div class="f1-steps">
                                            <div class="f1-progress">
                                                <div class="f1-progress-line" data-now-value="25"
                                                    data-number-of-steps="4" style="width: 25%;">
                                                </div>
                                            </div>
                                            <div class="f1-step active">
                                                <div class="f1-step-icon"><i class="fa fa-id-card"></i></div>
                                                <p>Data Peserta PKL</p>
                                            </div>
                                            <div class="f1-step">
                                                <div class="f1-step-icon"><i class="fa fa-file-text"></i></div>
                                                <p>Unggah Berkas</p>
                                            </div>
                                            <div class="f1-step">
                                                <div class="f1-step-icon"><i class="fa fa-user-circle-o"></i></div>
                                                <p>Pilih Bidang</p>
                                            </div>
                                            <div class="f1-step">
                                                <div class="f1-step-icon"><i class="fa fa-check-square-o"></i></div>
                                                <p>Validasi Data</p>
                                            </div>
                                        </div>
                                        <!-- step 1 -->
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5 class="pt-4">Data Diri Peserta</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth::user()->id }}">

                                                        <input type="hidden" name="id" value="">

                                                        @csrf
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Nama Lengkap</label>
                                                                <input class="form-control" name="nama_lengkap"
                                                                    value="" type="text"
                                                                    placeholder="Nama Lengkap" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Nomer Induk Mahasiswa</label>
                                                                <input class="form-control" name="nim"
                                                                    value="" type="number"
                                                                    placeholder="Nomer Induk Mahasiswa" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Tempat Lahir</label>
                                                                <input class="form-control" name="tempat_lahir"
                                                                    value="" type="text"
                                                                    placeholder="Tempat Lahir">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Tanggal Lahir</label>
                                                                <input class="form-control" name="tanggal_lahir"
                                                                    value="" type="date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Jenis Kelamin</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input"
                                                                        name="jenis_kelamin" type="radio"
                                                                        id="inlineradio1" value="Laki Laki" checked>
                                                                    <label class="form-check-label"
                                                                        for="inlineradio1">Laki Laki</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input"
                                                                        name="jenis_kelamin" type="radio"
                                                                        id="inlineradio2" value="Perempuan">
                                                                    <label class="form-check-label"
                                                                        for="inlineradio2">Perempuan</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group pt-4">
                                                                <label>Agama</label>
                                                                <select class="form-select" value=""
                                                                    id="agama" name="agama">
                                                                    <option value="Islam">Islam</option>
                                                                    <option value="Protestan">Protestan</option>
                                                                    <option value="Katolik">Katolik</option>
                                                                    <option value="Hindu">Hindu</option>
                                                                    <option value="Buddha">Buddha</option>
                                                                    <option value="Khonghucu">Khonghucu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group pt-4">
                                                                <label for="alamat">Alamat</label>
                                                                <textarea name="alamat" class="form-control" id="alamat" rows="3"> </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Nomor Handphone</label>
                                                                <input class="form-control" name="nomor_handphone"
                                                                    type="number" placeholder="Nomor Handphone">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-5">
                                                <hr>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5 class="pt-4">Data Dosen Pembimbing</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Nama Lengkap&nbsp;</label>
                                                                <label style="color: darkgrey;">(Beserta Gelar)</label>
                                                                <input class="form-control" type="text"
                                                                    name="nama_dosen_pembimbing"
                                                                    placeholder="Nama Lengkap">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Jenis Kelamin</label><br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input"
                                                                        name="jenis_kelamin_dosen_pembimbing"
                                                                        type="radio"
                                                                        id="jeniskelamindosenpembimbing"
                                                                        value="Laki Laki" checked>
                                                                    <label class="form-check-label"
                                                                        for="jeniskelamindosenpembimbing">Laki
                                                                        Laki</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input"
                                                                        name="jenis_kelamin_dosen_pembimbing"
                                                                        type="radio"
                                                                        id="jeniskelamindosenpembimbing1"
                                                                        value="Perempuan">
                                                                    <label class="form-check-label"
                                                                        for="jeniskelamindosenpembimbing1">Perempuan</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Email</label>
                                                                <input name="email_dosen_pembimbing"
                                                                    class="form-control" type="email"
                                                                    placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Nomor Handphone</label>
                                                                <input name="nomor_handphone_dosen_pembimbing"
                                                                    class="form-control" type="number"
                                                                    placeholder="Nomor Handphone">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-5">
                                                <hr>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5 class="pt-4">Data Perguruan Tinggi Peserta</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Nama Perguruan Tinggi Peserta</label>
                                                                <input name="nama_perguruan_tinggi"
                                                                    class="form-control" type="text"
                                                                    placeholder="Nama perguruan Tinggi Peserta">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group pt-4">
                                                                <label for="exampleFormControlTextarea1">Alamat</label>
                                                                <textarea name="alamat_perguruan_tinggi" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Kota Perguruan Tinggi Peserta</label>
                                                                <input name="kota_universitas" class="form-control"
                                                                    type="text"
                                                                    placeholder="Kota Perguruan Tinggi Peserta">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">

                                                                <label>Fakultas</label>
                                                                <select name="fakultas" class="form-select"
                                                                    value="" id="agama" name="agama">
                                                                    <option value="Teknik">Teknik</option>
                                                                    <option value="Non Teknik">Non Teknik</option>
                                                                </select>

                                                            </div>
                                                            <div class="form-group pt-4">
                                                                <label>Program Studi</label>
                                                                <input name="program_studi" class="form-control"
                                                                    type="text" placeholder="Program Studi">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row pt-5">
                                                <hr>
                                            </div>


                                            <div class="row">
                                                <div class="f1-buttons pt-4">
                                                    <button class="btn btn-sm btn-primary2 btn-next">Selanjutnya
                                                    </button>
                                                </div>
                                            </div>

                                        </fieldset>
                                        <!-- step 2 -->
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5 class="pt-4">Unggah Berkas</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="alert alert-info text-center">Pastikan ukuran dan
                                                        format file yang diunggah sesuai dengan ketentuan.</div>
                                                    <!-- Form Upload file -->
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <div class="form-group pt-4">
                                                                <label class="control-label">Berkas Syarat Pendaftaran
                                                                    Dalam 1 File <i style="color:#2B2E7A ;"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#staticBackdrop"
                                                                        class="bi bi-info-circle-fill"></i></label>&nbsp;
                                                                <label style="color: darkgrey;">(max. 5 Mb format
                                                                    .pdf)</label>
                                                                <div class="input-group custom-file-button">
                                                                    <label class="input-group-text" for="berkas">
                                                                        <i class="fa fa-paperclip"></i>&nbsp;Pilih File
                                                                    </label>
                                                                    <input type="file" accept=".pdf"
                                                                        name="fileberkas" id="berkas"
                                                                        class="form-control" id="berkas">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="position-relative t-btn-mobile">
                                                                <div class="position-absolute bottom-0 start-0">
                                                                    <button dataurl="" type="button"
                                                                        class="btn btn-labeled btn-outline-primary2 lihat_berkas"
                                                                        disabled>
                                                                        <span class="btn-label"><i
                                                                                class="fa fa-eye"></i>&nbsp;Lihat</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <div class="form-group pt-4">
                                                                <label class="control-label">Pas Foto 3x4
                                                                    &nbsp;</label>
                                                                <label style="color: darkgrey;">(max. 500Kb format
                                                                    .jpg)</label>
                                                                <div class="input-group custom-file-button">
                                                                    <label class="input-group-text" for="pasfoto">
                                                                        <i class="fa fa-paperclip"></i>&nbsp;Pilih File
                                                                    </label>
                                                                    <input accept="image/*" type="file"
                                                                        name="filepasfoto" class="form-control"
                                                                        id="pasfoto">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="position-relative t-btn-mobile">
                                                                <div class="position-absolute bottom-0 start-0">
                                                                    <button type="button" dataurl=""
                                                                        class="btn btn-labeled btn-outline-primary2 lihat_pas_foto"
                                                                        disabled>
                                                                        <span class="btn-label"><i
                                                                                class="fa fa-eye"></i>&nbsp;Lihat</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="f1-buttons pt-4">
                                                <button type="button" class="btn btn-light2 btn-previous">
                                                    Kembali</button>
                                                <button type="button"
                                                    class="btn btn-sm btn-primary2 btn-next btn-next-upload"
                                                    disabled>Selanjutnya </button>
                                            </div>

                                        </fieldset>
                                        <!-- step 3 -->
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5 class="pt-4">Bidang PKL</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Pilih Periode Pendaftaran</label>
                                                                <select class="form-select" name="id_periode"
                                                                    id="id_periode">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Periode Pelaksanaan</label>
                                                                <input id="tglMulaiAndSelesai" class="form-control"
                                                                    value="-" type="text" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Baru  -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Pilih Unit Kerja</label>
                                                                <select class="form-select" name="id_unit_kerja"
                                                                    id="id_unit_kerja">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Baru End -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Pilih Bidang PKL</label>
                                                                <select class="form-select" id="id_kuota"
                                                                    name="id_kuota">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group pt-4">
                                                                <label>Kuota Bidang PKL</label>
                                                                <input id="kuota_bidang" class="form-control"
                                                                    value="0" type="number" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="f1-buttons pt-4">
                                                            <button type="button"
                                                                class="btn btn-light2 btn-previous"> Kembali</button>
                                                            <button type="button" type="submit"
                                                                class="btn btn-sm btn-primary2 btn-next simpan-kuota">Selanjutnya
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- step 4 -->
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5 class="pt-4">Validasi Data</h5>
                                                    <br>
                                                    <div class="alert alert-success2"><b class="nama-bidang"></b>
                                                    </div>
                                                    <img style="max-width: 211px;" class="img-thumbnail pas_foto"
                                                        src="/assets_ip2022/img/no-image.png"
                                                        class="rounded float-left" alt="...">
                                                </div>
                                                <div class="col-sm-9 pt-4">
                                                    <table width="100%">
                                                        <tr>
                                                            <td colspan="2">
                                                                <h5>Data Diri Peserta</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1">Nama Lengkap</td>
                                                            <td class="nama_lengkap"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1">Tempat Tanggal Lahir</td>
                                                            <td class="ttl"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1">Jenis Kelamin </td>
                                                            <td class="jenis_kelamin"> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1"> Agama</td>
                                                            <td class="td1 agama"> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1"> Alamat</td>
                                                            <td class="alamat"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1"> Nomor Handphone</td>
                                                            <td class="nomor_handphone"> </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <hr>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <h5>Data Dosen Pembibing</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1">Nama Lengkap</td>
                                                            <td class="nama_dosen_pembimbing"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1">Jenis Kelamin </td>
                                                            <td class="jenis_kelamin_dosen_pembimbing"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1"> Email</td>
                                                            <td class="email_dosen_pembimbing"> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1"> Nomor Handphone</td>
                                                            <td class="nomor_handphone_dosen_pembimbing"> </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <hr>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <h5>Data Perguruan Tinggi</h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1">Nama Perguruan Tinggi</td>
                                                            <td class="nama_perguruan_tinggi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1">Alamat</td>
                                                            <td class="alamat_perguruan_tinggi"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1"> Fakultas </td>
                                                            <td class="fakultas"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1"> Program Studi</td>
                                                            <td class="program_studi"></td>
                                                        </tr>
                                                    </table>
                                                    <hr>
                                                    <table class="table1">
                                                        <tr>
                                                            <td style="width: 100%;">
                                                                <h5>Berkas</h5>
                                                            </td>
                                                            <td style="width: 10%;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1">Berkas Syarat Pendaftaran Dalam 1 File
                                                            </td>
                                                            <td>
                                                                <button type="button" dataurl
                                                                    class="btn btn-labeled btn-outline-primary2 lihat_berkas"
                                                                    disabled>
                                                                    <span class="btn-label"><i
                                                                            class="fa fa-eye"></i></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td1">Pas Foto 3x4 </td>
                                                            <td>
                                                                <button type="button" dataurl
                                                                    class="btn btn-labeled btn-outline-primary2 lihat_pas_foto"
                                                                    disabled>
                                                                    <span class="btn-label"><i
                                                                            class="fa fa-eye"></i></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="f1-buttons pt-4">
                                                <button type="button" class="btn btn-light2 btn-previous">
                                                    Kembali</button>
                                                <button
                                                    class="btn btn-sm btn-primary2 btn-next validasi-pendaftaran">Validasi
                                                    dan Selesaikan Pendaftaran</button>
                                            </div>
                                        </fieldset>
                                </div>
                                </form>
                            </div>
                        </article><!-- End blog entry -->
                    </div><!-- End blog entries list -->
                </div>
            </div>
        </section><!-- End Blog Section -->


        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12" style="text-align: left;">

                                <div class="col-md-12">
                                    <p class="h4 p-2" style="font-weight: bold;">Syarat Pendaftaran<br>PKL Online</p>
                                </div>
                                <div class="col-md-12 syaratpkl-box p-2">
                                    <span style="float: left;"><i
                                            class="bi bi-exclamation-circle-fill p-2"></i></span>
                                    <div style="display: flex;">
                                        <p>Catatan Point 1 sampai dengan 6 dijadikan dalam satu file dan tidak
                                            lebih besar dari 2 MB</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="p-4">
                                        <span style="float: left;">1.&nbsp;</span><span style="display: flex;">Surat
                                            Pengajuan Praktek Kerja Lapangan (PKL) dari Instansi Pendidikan
                                            terkait<br></span>
                                        <span style="float: left;">2.&nbsp;</span><span
                                            style="display: flex;">Proposal Praktek Kerja Lapangan (PKL)<br></span>
                                        <span style="float: left;">3.&nbsp;</span><span
                                            style="display: flex;">Transkrip Nilai sampai dengan semester
                                            terakhir<br></span>
                                        <span style="float: left;">4.&nbsp;</span><span
                                            style="display: flex;">Curriculum Vitae<br></span>
                                        <span style="float: left;">5.&nbsp;</span><span style="display: flex;">Kartu
                                            Pelajar / Mahasiswa<br></span>
                                        <span style="float: left;">6.&nbsp;</span><span style="display: flex;">Pas
                                            Foto 3x4 menggunakan background merah<br></span>
                                        {{-- <span style="float: left;">7.&nbsp;</span><span style="display: flex;">Surat Kesediaan<br></span> --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary2" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>



    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="index.html">
                            <img src="/assets_ip2022/img/logo_footer.png" alt="" width="260px"
                                height="100px">
                        </a>
                    </div>
                    <div class="col-lg-3 col-6 footer-links">
                        <h4>Kontak Kami</h4>
                        <ul>
                            <li><i class="bi bi-geo-alt"></i> <a href="#">Desa Laksana,Ibun, Kabupaten Bandung,
                                    Jawa Barat</a></li>
                            <li><i class="bi bi-telephone"></i> <a href="#">(022) 7814478, (0262) 229150</a>
                            </li>
                            <li><i class="bi bi-envelope"></i> <a href="#">humas.kmj@indonesiapower.co.id</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-1 col-6 footer-links">
                    </div>
                    <div class="col-lg-3 col-md-12 footer-contact text-md-start">
                        <h4>Sosial Media</h4>
                        <a href="https://www.youtube.com/channel/UCPulnU-un0DplD1yco24MLQ"><img
                                src="../../assets_ip2022/img/youtube_logo.png" width="32px" height="auto"
                                style="margin-right: 10px;"></a>
                        <a href="https://www.instagram.com/plnindonesiapower.kmj/"><img
                                src="../../assets_ip2022/img/instagram.png"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container footer-bottom clearfix">
            <div class="float-start">
                <h5>Copyright © 2021 PT PLN Indonesia Power Kamojang POMU. All rights reserved.Version 1.0.0</h5>
            </div>
            <div class="float-end">
                <h5>Version 1.0.0</h5>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <!-- Vendor JS Files -->
    <script src="/assets_ip2022/vendor/purecounter/purecounter.js"></script>
    <script src="/assets_ip2022/vendor/aos/aos.js"></script>
    <script src="/assets_ip2022/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets_ip2022/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/assets_ip2022/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets_ip2022/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/assets_ip2022/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets_ip2022/js/main.js"></script>
    <!-- <script src="/assets_ip2022/js/sendiri.js"></script> -->
    <script src="/asset/js/jquery.min.js"></script>
    <script src="/asset/js/jquery.min.js"></script>
    <script src="/asset/js/jquery.serialize-object.min.js"></script>

    <script type="text/javascript" src="/assets_ip2022/js/bootstrap-filestyle.min.js"></script>
    <script src="/asset/js/moment.min.js"></script>


    <script>
        function scroll_to_class(element_class, removed_height) {
            var scroll_to = $(element_class).offset().top - removed_height;
            // if($(window).scrollTop() != scroll_to) {
            // 	$('html, body').stop().animate({scrollTop: scroll_to}, 0);
            // }
        }

        function bar_progress(progress_line_object, direction) {
            var number_of_steps = progress_line_object.data('number-of-steps');
            var now_value = progress_line_object.data('now-value');
            var new_value = 0;
            if (direction == 'right') {
                new_value = now_value + (100 / number_of_steps);
            } else if (direction == 'left') {
                new_value = now_value - (100 / number_of_steps);
            }
            progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
        }

        $(document).ready(function() {
            // Form
            $('.f1 fieldset:first').fadeIn('slow');

            $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
                $(this).removeClass('input-error');
            });

            // step selanjutnya (ketika klik tombol selanjutnya)
            $('.f1 .btn-next').on('click', function() {
                var parent_fieldset = $(this).parents('fieldset');
                var next_step = true;
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                // validasi form
                parent_fieldset.find(
                    'input[type="text"], input[type="password"],input[type="number"],input[type="date"], textarea'
                ).each(function() {
                    if ($(this).val() == "" || $(this).val() == undefined) {
                        $(this).addClass('input-error');
                        next_step = false;
                    } else {
                        $(this).removeClass('input-error');
                    }
                });

                if (next_step) {
                    parent_fieldset.fadeOut(400, function() {
                        // change icons
                        current_active_step.removeClass('active').addClass('activated').next()
                            .addClass('active');
                        // progress bar
                        bar_progress(progress_line, 'right');
                        // show next step
                        $(this).next().fadeIn();
                        // scroll window to beginning of the form
                        scroll_to_class($('.f1'), 20);
                    });
                }
            });

            // step sbelumnya (ketika klik tombol sebelumnya)
            $('.f1 .btn-previous').on('click', function() {
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                $(this).parents('fieldset').fadeOut(400, function() {
                    // change icons
                    current_active_step.removeClass('active').prev().removeClass('activated')
                        .addClass('active');
                    // progress bar
                    bar_progress(progress_line, 'left');
                    // show previous step
                    $(this).prev().fadeIn();
                    // scroll window to beginning of the form
                    scroll_to_class($('.f1'), 20);
                });
            });

            // submit (ketika klik tombol submit diakhir wizard)
            $('.f1').on('submit', function(e) {
                // validasi form
                $(this).find('input[type="text"], input[type="password"], textarea').each(function() {
                    if ($(this).val() == "") {
                        e.preventDefault();
                        $(this).addClass('input-error');
                    } else {
                        $(this).removeClass('input-error');
                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.get(`/user/api/profil-member`).done(function(data) {
                if (data.data) {
                    set_value(data.data);
                }
            });


            $("#formdatadiri").submit(function(event) {
                event.preventDefault();
                $.post("/user/api/pendaftaran", $(this).serializeObject()).done(function(data) {
                    set_value(data.data);
                });
            });


            $(`.lihat_pas_foto`).on('click', function() {
                window.open($(this).attr('dataurl'), '_blank');
            })

            $(`.lihat_berkas`).on('click', function() {
                window.open($(this).attr('dataurl'), '_blank');
            })


            $('#berkas').change(function() {
                var file_data = $(this).prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.ajax({
                    url: '/user/api/upload-berkas',
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(data) {
                        $(`.lihat_berkas`).attr('dataurl', data.data);
                        $(`.lihat_berkas`).prop('disabled', false);
                        checkPasFotoAndDocument()
                    }
                });
            });

            $('#pasfoto').change(function() {
                var file_data = $(this).prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.ajax({
                    url: '/user/api/upload-pasfoto',
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(x) {
                        $(`.lihat_pas_foto`).attr('dataurl', x.data);
                        $(`.pas_foto`).attr('src', x.data);
                        $(`.lihat_pas_foto`).prop('disabled', false); //btn-next-upload
                        checkPasFotoAndDocument();
                    }
                });
            });


            let selectedUnit = null
            let selectedKuota = null
            $.get(`/user/api/list-priode-pendaftaran-aktif`).done(function(data) {
                if (data.data.length) {
                    var html = ``;
                    $.each(data.data, function(key, val) {
                        html +=
                            `<option data-tgl_mulai_pelaksanaan="${val.tgl_mulai_pelaksanaan}"  data-tgl_selesai_pelaksanaan="${val.tgl_selesai_pelaksanaan}" value="${val.id}">${moment(val.tgl_mulai_pendaftaran).locale('id').format('DD MMMM YYYY')} - ${moment(val.tgl_selesai_pendaftaran).locale('id').format('DD MMMM YYYY')}</option>`;
                    });
                    $("#id_periode").html(html);
                    if (data.data) {
                        loadUnitKerja(data.data[0].id);
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
                loadUnitKerja($(this).val())
                // $.get(`/user/api/list-kuota/${$(this).val()}`).done(function(data) {
                //     var html = ``;
                //     $.each(data.data, function(key, val) {
                //         html +=
                //             `<option jumlah_kuota="${val.jumlah_kuota}" value="${val.id}">${val.nama_bidang} </option>`;
                //     });
                //     $("#id_kuota").html(html);
                //     $(":input[name='id_kuota']").val(data.data[0].id).change();
                //     $('#kuota_bidang').val(data.data[0].jumlah_kuota);
                //     $("#id_kuota").change();
                // });
            });

            function loadUnitKerja(id_periode) {

                $("#id_unit_kerja").html(`<option>Loading...</option>`)

                $.get(`/user/api/list-unit-kerja/${id_periode}`).done(function(res) {

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

            $("#id_unit_kerja").change(function() {

                let id_periode = $("#id_periode").val()
                let id_unit = $(this).val()

                selectedUnit = id_unit
                selectedKuota = null

                loadBidang(id_periode, id_unit)

            })

            function loadBidang(id_periode, id_unit) {
                console.log('load bidang')

                $("#id_kuota").html(`<option>Loading...</option>`)

                $.get(`/user/api/list-kuota/${id_periode}/${id_unit}`).done(function(res) {

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

            $('.simpan-kuota').on("click", function() {
                $.post(`/user/api/simpan-pendaftaran`, {
                    id_kuota: $("#id_kuota").val(),
                    id_profil: $(`:input[name='id']`).val(),
                }).done(function(data) {
                    if (data.data) {
                        $('.nama-bidang').html(data.data.nama_bidang);
                    }
                });
            })

            $('.validasi-pendaftaran').on("click", function() {
                $.post(`/user/api/validasi-pendaftaran`, {

                }).done(function(data) {
                    location.replace('/user/proses');
                });
            })

        });



        function list_kuota(id_periode) {
            $.get(`/user/api/list-kuota/${id_periode}`).done(function(data) {
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

        function set_value(data) {
            $(`:input[name='agama']`).val(data.agama);
            $(`:input[name='alamat']`).val(data.alamat);
            $(`:input[name='email_dosen_pembimbing']`).val(data.email_dosen_pembimbing);
            $(`:input[name='alamat_perguruan_tinggi']`).val(data.alamat_perguruan_tinggi);
            $(`:input[name='jenis_kelamin'][value='${data.jenis_kelamin}']`).prop(`checked`, true);;
            $(`:input[name='jenis_kelamin_dosen_pembimbing'][value='${data.jenis_kelamin_dosen_pembimbing}']`).prop(
                `checked`, true);;
            $(`:input[name='nama_dosen_pembimbing']`).val(data.nama_dosen_pembimbing);
            $(`:input[name='nama_lengkap']`).val(data.nama_lengkap);
            $(`:input[name='nama_perguruan_tinggi']`).val(data.nama_perguruan_tinggi);
            $(`:input[name='nomor_handphone']`).val(data.nomor_handphone);
            $(`:input[name='tanggal_lahir']`).val(data.tanggal_lahir);
            $(`:input[name='tempat_lahir']`).val(data.tempat_lahir);
            $(`:input[name='nomor_handphone_dosen_pembimbing']`).val(data.nomor_handphone_dosen_pembimbing);
            $(`:input[name='id']`).val(data.id);
            $(`:input[name='program_studi']`).val(data.program_studi);
            $(`:input[name='fakultas']`).val(data.fakultas);
            $(`:input[name='kota_universitas']`).val(data.kota_universitas);
            $(`:input[name='nim']`).val(data.nim);

            $(`.lihat_pas_foto`).attr('dataurl', data.berkas_pas_foto);
            $(`.lihat_berkas`).attr('dataurl', data.bekas_syarat_pendaftaran);

            $(`.lihat_berkas`).attr('dataurl') ? $(`.lihat_berkas`).prop('disabled', false) : $(`.lihat_berkas`).prop(
                'disabled', true);
            $(`.lihat_pas_foto`).attr('dataurl') ? $(`.lihat_pas_foto`).prop('disabled', false) : $(`.lihat_pas_foto`).prop(
                'disabled', true);

            $(`.pas_foto`).attr('src', data.berkas_pas_foto);

            $(`.agama`).html(data.agama);
            $(`.alamat`).html(data.alamat);
            $(`.email_dosen_pembimbing`).html(data.email_dosen_pembimbing);
            $(`.alamat_perguruan_tinggi`).html(data.alamat_perguruan_tinggi);
            $(`.jenis_kelamin`).html(data.jenis_kelamin);
            $(`.jenis_kelamin_dosen_pembimbing`).html(data.jenis_kelamin_dosen_pembimbing);
            $(`.nama_dosen_pembimbing`).html(data.nama_dosen_pembimbing);
            $(`.nama_lengkap`).html(data.nama_lengkap);
            $(`.nama_perguruan_tinggi`).html(data.nama_perguruan_tinggi);
            $(`.nomor_handphone`).html(data.nomor_handphone);
            $(`.ttl`).html(`${data.tempat_lahir}, ${moment(data.tanggal_lahir).locale('id').format('DD MMMM YYYY')}`);
            $(`.nomor_handphone_dosen_pembimbing`).html(data.nomor_handphone_dosen_pembimbing);
            $(`.id`).html(data.id);
            $(`.program_studi`).html(data.program_studi);
            $(`.fakultas`).html(data.fakultas);
            $(`.kota_universitas`).html(data.kota_universitas);
            $(`.nim`).html(data.nim);
            checkPasFotoAndDocument();
        }

        function checkPasFotoAndDocument() {
            if (!$(`.lihat_pas_foto`).prop('disabled') && !$(`.lihat_berkas`).prop('disabled')) {
                $(`.btn-next-upload`).prop('disabled', false);
            }
        }
    </script>
</body>

</html>
