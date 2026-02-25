@inject('request', 'Illuminate\Http\Request')
@inject('ProfilMember', 'App\Models\ProfilMember')

@if ($request->id)
  @php 
  $member = $ProfilMember::where('profil_member.id', $request->id)
  ->join('pendaftaran','pendaftaran.id_profil','=','profil_member.id')
  ->join('kuota_pendaftaran','pendaftaran.id_kuota','=','kuota_pendaftaran.id')
  ->join('periode','kuota_pendaftaran.id_periode','=','periode.id')
  ->select('profil_member.*','pendaftaran.status_pendaftaran','pendaftaran.updated_at','periode.tgl_mulai_pelaksanaan')
  ->first();
  $bulan = array(
            1 =>       'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

   $var = explode('-', $member->tgl_mulai_pelaksanaan);
    $bulan_pkl= $bulan[(int)$var[1]] . ' ' . $var[0];
  @endphp

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/asset/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
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
        margin-right: calc(var(--bs-gutter-x) * +1);
        margin-left: calc(var(--bs-gutter-x) * +.25);
      }

      .col-md-12 {
          /* flex: 0 0 auto; */
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
    </style>

    <title>Pemberitahuan</title>
  </head>
  <body>

      <div class="container">
          <!-- header surat -->
          <div class="row">
            <div class="col-md-12">
              <div class="logo-container">
                <img class="logo-header" src="/asset/img/logo.png" alt="">
                <img class="logo-header" src="/asset/img/small.png" alt="" style="float: right;padding-right:10px;">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <p class="h6">
                <b style="color: #2B2E7A;margin-left:5px">Kamojang Power Generation and O&M Services Unit (KMJ)</b><br>
                <div style="margin-left:5px">
                  Komplek Perumahan PLTP Kamojang Kotak Pos 125 Garut 44101<br>
                Telepon : 022- 7805475 - 7814478<br>
                Facsimile : 022- 7801013 - 7805469
                </div>
                <hr class="mt-0" style="opacity: 100%;border: 1px solid #212529 !important;">
              </p>
            </div>
          </div>
          <!-- header surat end -->

          <!-- Penerima Surat -->
          <!-- kolom kiri -->
          <div class="row mb-3">
            <div class="col-md-8" style="margin-left:1px">
                <table class="table table-sm table-borderless tabelatas h6">
                  <tr>
                    <td colspan="2">Nomor</td>
                    <td colspan="9">: &nbsp; {{sprintf("%04s", $member->id);}}/{{date("m",strtotime($member->tgl_mulai_pelaksanaan));}}0/KMJPOMU/{{date("Y",strtotime($member->tgl_mulai_pelaksanaan));}}</td>
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
            <div class="col-md-4" style="margin-left:-15px">
              <table class="table table-sm table-borderless tabelatas h6">
                <tr>
                  <td>Kamojang, {{$member->updated_at->isoFormat('D MMMM Y')}}</td>
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
                  <td>{{$member->nama_perguruan_tinggi}}</td>
                </tr>
                <tr>
                  <td>{{$member->kota_universitas}};</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- header surat END-->

          <div class="row mb-3">
            <div class="col-md-12">
            <p class="h6" style="margin-left:5px">
              Merujuk pada Surat Edaran General Manager PT Indonesia Power Kamojang Power Generation and O&M Services Unit Nomor: 009.E/012/KMJPOMU/2021 Tanggal 01 Februari 2021 tentang Pedoman Penerimaan Praktek Kerja Lapangan (PKL) secara Daring / Online maka dengan ini diberitahukan kepada pihak Sekolah / Universitas yang mengajukan permohonan pelaksanaan Kerja Praktek / Penelitian dengan rincian sebagai berikut:</p>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-8" style="margin-left:5px">
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
                  <tr>
                    <td class="td-garis">1</td>
                    <td class="td-garis">{{$member->nama_lengkap}}</td>
                    <td class="td-garis">{{$member->nim}}</td>
                    <td class="td-garis">{{$member->program_studi}}</td>
                    <td class="td-garis">{{$bulan_pkl}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row mb-5">
            <div class="col-md-12"><p class="h6" style="margin-left:5px">
              Setelah dilakukan pertimbangan atas ketersediaan kuota dan seleksi berkas administrasi, dengan ini
              disampaikan bahwa pengajuan tersebut @if($member->status_pendaftaran=="Lolos")<b>disetujui.</b>@endif
              @if($member->status_pendaftaran=="Tidak Lolos")<b>ditolak.</b> @endif
              </p>
              <p class="h6" style="margin-left:5px">Demikian yang dapat disampaikan dan terima kasih.
              </p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5" style="margin-top: -10px">
              <div class="d-flex justify-content-center mb-2">
                <p class="h6" style="text-transform: uppercase;display: flex!important;justify-content: center!important;">MANAJER ADMINISTRASI KMJ POMU</p>
              </div>
              <div class="d-flex justify-content-center mb-2" style="display: flex!important;justify-content: center!important;">
                
                <img src="/asset/img/Stempel.png" alt="" style="width: 120px;height: auto;z-index: 1;margin-left: -60px;">

              </div>
              <div class="d-flex justify-content-center mb-2" style="display: flex!important;justify-content: center!important;">
                <div style="width: 200px;margin-top:-90px">
                  <img src="/asset/img/TTDEva.png" alt="" style="width: 100%;height: auto;z-index: 3;">
                </div>

              </div>
              <div class="d-flex justify-content-center">
                <p class="h6" style="text-transform: uppercase;display: flex!important;justify-content: center!important;">EVA WIRABUANA</p>
              </div>
            </div>
          </div>

          {{-- <div class="row" >
            <div class="col-md-12">
              <p class="h6" style="margin-left:4px;">Tembusan</p>
              <p class="h6" style="text-transform: uppercase; margin-left:4px;">&nbsp; DITO HASTA KRISANDY;REZA RAHMAN RAMADHAN;YEYEP S. ISKANDAR;</p>
            </div>
          </div> --}}


      </div>
      <script> 
        //https://ekoopmans.github.io/html2pdf.js/#cdn
      
        var opt = {
          margin:       [5, 5, 5, 5],
          filename:     'lampiran.pdf',
          image:        { type: 'jpeg', quality: 0.98 },
          html2canvas:  { dpi: 192, scale: 2, letterRendering: true},
          jsPDF:        { unit: 'pt', format: 'letter', orientation: 'portrait' }
        };
        
        
        // var element = document.getElementById('container');  
        var worker = html2pdf().set(opt).from(`${$('.container').html()}`).save();
         
               
        </script>
  </body>
  
</html>
    
@endif
