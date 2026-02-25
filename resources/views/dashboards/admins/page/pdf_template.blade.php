<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

    <!-- internal CSS -->
    <style>
      body {
        margin: 0;
        font-family: "Segoe UI", Roboto, Arial, Helvetica, sans-serif;
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.3;
        color: #212529;
        background-color: #fff;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
      }

      .container{
        width: 100%;
        padding-right: var(--bs-gutter-x,.75rem);
        padding-left: var(--bs-gutter-x,.75rem);
        margin-right: auto;
        margin-left: auto;
      }

      @media screen and (min-width: 576px) {
        .container {
          max-width: 540px;
        }
      }

      @media screen and (min-width: 768px) {
        .container {
          max-width: 720px;
        }
      }

      @media screen and (min-width: 992px) {
        .container {
          max-width: 960px;
        }
      }

      @media screen and (min-width: 1200px) {
        .container {
          max-width: 1140px;
        }
      }

      @media screen and (min-width: 1400px) {
        .container {
          max-width: 1320px;
        }
      }

      .row{
        width: 100%;
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(var(--bs-gutter-y) * -1);
        margin-right: calc(var(--bs-gutter-x) * -.5);
        margin-left: calc(var(--bs-gutter-x) * -.5);
      }

      .col-md-12 {
          flex: 0 0 auto;
          width: 100%;
      }

      .col-md-8 {
          flex: 0 0 auto;
          width: 66.66666667%;
      }

      .col-md-7 {
          flex: 0 0 auto;
          width: 58.33333333%;
      }

      .col-md-5 {
          flex: 0 0 auto;
          width: 41.66666667%;
      }

      .col-md-4 {
          flex: 0 0 auto;
          width: 33.33333333%;
      }

      .logo-container{
        height: 60px;
        padding-top: 1.5rem;
      }
      .logo-header{
        height: 100%;
        width: auto;
      }
      .tabelatas tr td{
        padding: 0 !important;
      }

      .table{
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        vertical-align: top;
      }

      .table-garis {
        width: 100%;
        border-collapse: collapse;        
      }

      .th-garis, .td-garis {
        border: 1px solid;
        text-align: left;
        padding: 0.5rem !important;
      }
    </style>

    <title>Pemberitahuan</title>
  </head>
  <body>

      <div class="container">
          <!-- header surat -->
          <div class="row">
            <div class="col-md-12">
              <div class="logo-container">
                <img class="logo-header" src="assets/img/logo.png" alt="">
                <img class="logo-header" src="assets/img/small.png" alt="" style="float: right;">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <p class="h6">
                <b style="color: #2B2E7A;">Kamojang Power Generation and O&M Services Unit (KMJ)</b><br>
                Komplek Perumahan PLTP Kamojang Kotak Pos 125 Garut 44101<br>
                Telepon : 022- 7805475 - 7814478<br>
                Facsimile : 022- 7801013 - 7805469
                <hr class="mt-0" style="opacity: 100%;border: 1px solid #212529 !important;">
              </p>
            </div>
          </div>
          <!-- header surat end -->

          <!-- Penerima Surat -->
          <!-- kolom kiri -->
          <div class="row mb-3">
            <div class="col-md-8">
                <table class="table table-sm table-borderless tabelatas h6">
                  <tr>
                    <td colspan="2">Nomor</td>
                    <td colspan="9">: &nbsp; 0183/070/KMJPOMU/2021</td>
                  </tr>
                  <tr>
                    <td colspan="2">Surat Sdr</td>
                    <td colspan="9">: &nbsp; </td>
                  </tr>
                  <tr>
                    <td colspan="2">No Lampiran</td>
                    <td colspan="9">: &nbsp; 0</td>
                  </tr>
                  <tr>
                    <td colspan="2">Sifat</td>
                    <td colspan="9">: &nbsp; Biasa</td>
                  </tr>
                  <tr>
                    <td colspan="2">Perihal</td>
                    <td colspan="9">: &nbsp; Balasan Permohonan Kerja Praktek</td>
                  </tr>
                </table>
            </div>

          <!-- kolom kanan -->
            <div class="col-md-4">
              <table class="table table-sm table-borderless tabelatas h6">
                <tr>
                  <td>Kamojang, 13 August 2021</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Kepada :</td>
                </tr>
                <tr>
                  <td>Universitas Merdeka</td>
                </tr>
                <tr>
                  <td>Surabaya;</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- header surat END-->

          <div class="row mb-3">
            <div class="col-md-12"><p class="h6">
              Merujuk pada Surat Edaran General Manager PT Indonesia Power Kamojang Power Generation and O&M
              Services Unit Nomor: 009.E/012/KMJPOMU/2021 Tanggal 01 Februari 2021 tentang Pedoman Penerimaan
              Praktek Kerja Lapangan (PKL) secara Daring / Online maka dengan ini diberitahukan kepada pihak Sekolah /
              Universitas yang mengajukan permohonan pelaksanaan Kerja Praktek / Penelitian dengan rincian sebagai
              berikut:</p>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-8">
              <table class="table-garis" style="opacity: 100%;border: 1px solid #212529 !important;">
                <thead>
                  <tr>
                    <th scope="col" class="th-garis">NO</th>
                    <th scope="col" class="th-garis">NAMA</th>
                    <th scope="col" class="th-garis">NIM</th>
                    <th scope="col" class="th-garis">PROGRAM STUDI</th>
                    <th scope="col" class="th-garis">PERIODE</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($member as $member1)
                  <tr>
                    <td class="td-garis">1</td>
                    <td class="td-garis">{{$member1->nama_lengkap}}</td>
                    <td class="td-garis">{{$member1->nim}}</td>
                    <td class="td-garis">Teknik Informatika</td>
                    <td class="td-garis">Maret 2022</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="row mb-5">
            <div class="col-md-12"><p class="h6">
              Setelah dilakukan pertimbangan atas ketersediaan kuota dan seleksi berkas administrasi, dengan ini
              disampaikan bahwa pengajuan tersebut <b>disetujui</b>.</p>
              <p class="h6">Demikian yang dapat disampaikan dan terima kasih.
              </p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
              <div class="d-flex justify-content-center mb-2">
                <p class="h6" style="text-transform: uppercase;display: flex!important;justify-content: center!important;">MANAJER ADMINISTRASI KMJ POMU</p>
              </div>
              <div class="d-flex justify-content-center mb-2" style="display: flex!important;justify-content: center!important;">
                <img src="https://qrexplore.com/icon/apple-icon.png" alt="" style="width: 100px;height: auto;">
              </div>
              <div class="d-flex justify-content-center">
                <p class="h6" style="text-transform: uppercase;display: flex!important;justify-content: center!important;">EVA WIRABUANA</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <p class="h6">Tembusan</p>
              <p class="h6" style="text-transform: uppercase;">&nbsp; DITO HASTA KRISANDY;REZA RAHMAN RAMADHAN;YEYEP S. ISKANDAR;</p>
            </div>
          </div>


      </div>

  </body>
</html>