<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gwendolyn:wght@400;700&family=Lora:wght@400;600;700&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <script src="/asset/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- internal CSS -->
    <style>
      @page {
        size: A4 landscape;
      }

      @page {
          margin-top: auto;
          margin-bottom: 0cm;
          margin-left: 0cm;
          margin-right: 0cm;
      }

      body {
        margin: 0;
        font-family: 'Lora', serif;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.3;
        color: #212529;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
      }

      .container{
        width: 90%;
        padding-right: var(--bs-gutter-x,.75rem);
        padding-left: var(--bs-gutter-x,.75rem);
        margin-top: var(--bs-gutter-y,.75rem);
        margin-bottom: var(--bs-gutter-y,.75rem);
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
        /* margin-top: calc(var(--bs-gutter-y) * -1);
        margin-right: calc(var(--bs-gutter-x) * -.5);
        margin-left: calc(var(--bs-gutter-x) * -.5); */
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
        height: 100px;
        padding-top: 1rem;
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

      .sertifikat {
        font-family: 'Gwendolyn', cursive;
        font-size: 64px;
        font-weight: 700;
        line-height: 0;
      }
    </style>

    <title>Sertifikat</title>
  </head>
  <body>

      <div class="container">
          <!-- header surat -->
          <div class="row">
            <div class="col-md-12">              
              <div class="logo-container">
                {{-- <img class="logo-header" src="logo.png" alt="">
                <img class="logo-header" src="small.png" alt="" style="float: right;padding-right: 6px;"> --}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <p class="sertifikat" style="display: flex!important;justify-content: center!important;margin-top: 0px;margin-bottom: 40px;">Sertifikat</p>
                <p style="display: flex!important;justify-content: center!important;">No &nbsp; {{sprintf("%04d", $data_peserta->id_member);}}/{{sprintf("%03d",date('m',strtotime($data_peserta->tgl_mulai_pelaksanaan)))}}/KMJPOMU/{{date('Y',strtotime($data_peserta->tgl_mulai_pelaksanaan))}}</p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <p style="display: flex!important;justify-content: center!important;text-align: center;">General Manager PT Indonesia Power 
                Kamojang Power Generation and 0&M Services Unit (POMU)</br>menerangkan bahwa:</p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <table class="table table-sm table-borderless tabelatas h6" style="display: flex!important;justify-content: center!important;">
                  <tr>
                    <td colspan="2">Nama&nbsp;</td>
                    <td colspan="9">: &nbsp; {{$data_peserta->nama_lengkap}}</td>
                  </tr>
                  <tr>
                    <td colspan="2">Instansi Pendidikan&nbsp;</td>
                    <td colspan="9">: &nbsp; {{$data_peserta->nama_perguruan_tinggi}}</td>
                  </tr>
                  <tr>
                    <td colspan="2">Program Studi&nbsp;</td>
                    <td colspan="9">: &nbsp; {{$data_peserta->program_studi}}</td>
                  </tr>
                </table>
            </div>

            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
                  <p style="display: flex!important;justify-content: center!important;text-align: center;">Telah melaksanakan:</br>
                    PRAKTEK KERJA LAPANGAN</br>
                    di</br>
                    PT. INDONESIA POWER KAMOJANG POMU</br>
                    Pada tanggal : {{$tanggal_mulai}} s.d {{$tanggal_selesai}}</br>
                    Dengan Predikat : {{$predikat}}({{intval($temp/$jumlah)}})</br>
                    </br>
                    Kamojang, {{date('d F Y')}}</br>
                    General Manager</br>
                  </p>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                </br>
                </br>
                </br>
                </br>

                <p class="h6" style="text-transform: uppercase;display: flex!important;justify-content: center!important;text-align: center;margin: 0px;">IBNU AGUS SANTOSA</p>
              </div>
            </div>

            {{-- <div class="row">
              <div class="col-md-12 d-flex justify-content-center">                 
                  <p style="display: flex!important;justify-content: center!important;text-align: center;margin-bottom: -80px;font-family: 'Roboto', sans-serif;font-weight: 300;"><i>Energy of Things</i></p>
              </div>
            </div> --}}

            <div class="row">
              <div class="col-md-12">
                {{-- <img src="https://qrexplore.com/icon/apple-icon.png" alt="" style="width: 40px;height: auto;padding: 10px;"> --}}
              </div>
            </div>


      </div>
      <script> 
        //https://ekoopmans.github.io/html2pdf.js/#cdn
      
        var opt = {
          margin:       [2, 3, 2, 3],
          filename:     'sertifikat.pdf',
          image:        { type: 'jpeg', quality: 0.98 },
          html2canvas:  { dpi: 192, scale: 2, letterRendering: true},
          jsPDF:        { unit: 'pt', format: 'a4', orientation: 'landscape' }
        };
        
        
        // var element = document.getElementById('container');  
        var worker = html2pdf().set(opt).from(`${$('.container').html()}`).save();
         
               
        </script>
  </body>
</html>