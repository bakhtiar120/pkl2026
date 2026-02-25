@inject('profile', 'App\Models\ProfilMember')
@inject('pendaftaran', 'App\Models\Pendaftaran')
@php
$akses = $profile::join('pendaftaran','profil_member.id','=','pendaftaran.id_profil')->where('user_id',Auth::user()->id)->first(); 
@endphp
@if($akses != null) 
  @if($akses->status_pendaftaran == 'Proses')
    <script>window.location = "/user/pendaftaran-pkl-online";</script>
  @elseif($akses->status_pendaftaran == 'Lolos')
    <script>window.location = "/user/dashboard";</script>
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
          <li><a class="nav-link scrollto" href="{{ route('logout.perform') }}">Keluar&nbsp;<i class="bi bi-box-arrow-right" style="font-size: 20px;"></i></a></li>
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
          <div class="col-lg-12">
            <div class="alert alert-primary text-center" role="alert">
              Anda telah menyelesaikan pendaftarn PKL Online. Pengumuman hasil lulus administrasi dikirim pada email terdaftar (cek bagian SPAM) atau dapat dilihat pada halaman Info PKL.
            </div>
          </div>
          <div class="col-lg-12 entries">
            <article class="entry" style="background-color: #FFFFFF;border-radius: 8px;">
              <div class="row">
                <div class="col-md-12 col-md-offset-1">
                  <h3 class="pt-4">Nomor Pendaftaran :  <b class="id"></b></h3>
                  <h5>Tanggal Pendaftaran :  <b class="tgl"></b></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-md-offset-1">
                  <div class="row">
                    <div class="col-sm-3">
                      <h5 class="pt-4">Validasi Data</h5>
                      <br>
                      <div class="alert alert-success2"><b class="nama-bidang"></b></div>
                      <img style="max-width: 211px;" class="img-thumbnail pas_foto" src="/assets_ip2022/img/no-image.png"
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
                          <td class="td1">Berkas Syarat Pendaftaran Dalam 1 File</td>
                          <td>
                            <button type="button" dataurl class="btn btn-labeled btn-outline-primary2 lihat_berkas" disabled>
                              <span class="btn-label"><i class="fa fa-eye"></i></span>
                            </button>
                          </td>
                        </tr>
                        <tr>
                          <td class="td1">Pas Foto 3x4 </td>
                          <td>
                            <button type="button" dataurl class="btn btn-labeled btn-outline-primary2 lihat_pas_foto" disabled>
                              <span class="btn-label"><i class="fa fa-eye"></i></span>
                            </button>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>

                </div>
              </div>
            </article><!-- End blog entry -->
          </div><!-- End blog entries list -->
        </div>
      </div>
    </section><!-- End Blog Section -->

    
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12" style="text-align: left;">

            <div class="col-md-12">
              <p class="h4 p-2" style="font-weight: bold;">Syarat Pendaftaran<br>PKL Online</p>
            </div>
            <div class="col-md-12 syaratpkl-box p-2">
              <span style="float: left;"><i class="bi bi-exclamation-circle-fill p-2"></i></span>
              <div style="display: flex;">
                <p>Catatan Point 1 sampai dengan 7 dijadikan dalam satu file dan tidak
                  lebih besar dari 2 MB</p>
              </div>
            </div>
            <div class="col-md-12">
              <p class="p-4">
                <span style="float: left;">1.&nbsp;</span><span style="display: flex;">Surat Pengajuan Praktek Kerja Lapangan (PKL) dari Instansi Pendidikan terkait<br></span>
                <span style="float: left;">2.&nbsp;</span><span style="display: flex;">Proposal Praktek Kerja Lapangan (PKL)<br></span>
                <span style="float: left;">3.&nbsp;</span><span style="display: flex;">Transkrip Nilai sampai dengan semester terakhir<br></span>
                <span style="float: left;">4.&nbsp;</span><span style="display: flex;">Curriculum Vitae<br></span>
                <span style="float: left;">5.&nbsp;</span><span style="display: flex;">Kartu Pelajar / Mahasiswa<br></span>
                <span style="float: left;">6.&nbsp;</span><span style="display: flex;">Pas Foto 3x4 menggunakan background merah<br></span>
                <span style="float: left;">7.&nbsp;</span><span style="display: flex;">Surat Kesediaan<br></span>
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
              <img src="/assets_ip2022/img/logo_footer.png" alt="" width="260px" height="100px">
            </a>
          </div>
          <div class="col-lg-3 col-6 footer-links">
            <h4>Kontak Kami</h4>
            <ul>
              <li><i class="bi bi-geo-alt"></i> <a href="#">Desa Laksana,Ibun, Kabupaten Bandung, Jawa Barat</a></li>
              <li><i class="bi bi-telephone"></i> <a href="#">(022) 7814478, (0262) 229150</a></li>
              <li><i class="bi bi-envelope"></i> <a href="#">humas.kmj@indonesiapower.co.id</a></li>
            </ul>
          </div>
          <div class="col-lg-1 col-6 footer-links">
          </div>
          <div class="col-lg-3 col-md-12 footer-contact text-md-start">
            <h4>Sosial Media</h4>
            <a href="https://www.youtube.com/channel/UCPulnU-un0DplD1yco24MLQ"><img src="../../assets_ip2022/img/youtube_logo.png" width="32px" height="auto" style="margin-right: 10px;"></a>
            <a href="https://www.instagram.com/plnindonesiapower.kmj/"><img src="../../assets_ip2022/img/instagram.png"></a>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


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
  
  <script type="text/javascript" src="/assets_ip2022/js/bootstrap-filestyle.min.js"> </script>
  <script src="/asset/js/moment.min.js"></script>


  <script>
     
    $(document).ready(function() {
      
  
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 

    $.get( `/user/api/profil-member`).done(function( data ) {
      //console.log(data);
      if(data.data){ 
        set_value(data.data);
        get_pendaftaran(data.data.id);
      }  
    });


      $(`.lihat_pas_foto`).on('click',function(){
        window.open($(this).attr('dataurl'), '_blank'); 
      })
      $(`.lihat_berkas`).on('click',function(){
        window.open($(this).attr('dataurl'), '_blank'); 
      }) 
});

function get_pendaftaran(id){
  $.get( `/user/api/get-pendaftaran/${id}`).done(function( data ) {  
      $('.nama-bidang').html(data.data.nama_bidang);
      //$('.id').html(data.data.id);
      $('.status_pendaftaran').html(data.data.status_pendaftaran);
      $('.tgl').html( moment(data.created_at).locale('id').format('DD MMMM YYYY')); 
  });
}
 

  function set_value(data){
        $(`.lihat_pas_foto`).attr('dataurl',data.berkas_pas_foto);
        $(`.lihat_berkas`).attr('dataurl',data.bekas_syarat_pendaftaran);
        $(`.lihat_berkas`).attr('dataurl') ? $(`.lihat_berkas`).prop('disabled', false) :  $(`.lihat_berkas`).prop('disabled', true);
        $(`.lihat_pas_foto`).attr('dataurl') ? $(`.lihat_pas_foto`).prop('disabled', false) :  $(`.lihat_pas_foto`).prop('disabled', true);
        $(`.pas_foto`).attr('src',data.berkas_pas_foto);
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
        $(`.id`).html(moment(data.created_at).locale('id').format('YYYYMM')+data.id);
        $(`.program_studi`).html(data.program_studi);
        $(`.fakultas`).html(data.fakultas);
        $(`.kota_universitas`).html(data.kota_universitas);
        $(`.nim`).html(data.nim);           
  }
</script>
</body>

</html>