@inject('request', 'Illuminate\Http\Request')
@inject('artikel', 'App\Models\Artikel')


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PKL Online Indonesia Power</title>
  <meta content="" name="description">

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
  <link href="/assets_ip2022/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets_ip2022/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets_ip2022/css/style.css" rel="stylesheet">
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }    
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    html {
      height: 100%;
    }
    body {
      min-height: 100%;
      display: flex;
      flex-direction: column;
    }
    .content {
      flex: 1;
    }
    </style>

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
          @if(Auth::guest())
              <li>
                <a class="nav-link scrollto" href="{{url('login')}}">Masuk</a>
              </li> 
              <li>
                <a class="getstarted scrollto" href="{{url('register')}}">Daftar</a>
              </li> 
          @else
            @switch(Auth::user()->role)
                @case(1)
                <li>
                  <a class="getstarted scrollto" href="{{url('admin/dashboard')}}">Dasboard</a>
                </li>
                    @break 
                @case(2)
                <li>
                  <a class="getstarted scrollto" href="{{url('user/dashboard')}}">Dasboard</a>
                </li>
                    @break
                @case(3)
                <li>
                  <a class="getstarted scrollto" href="{{url('mentor/dashboard')}}">Dasboard</a>
                </li>
                    @break 
                @default              
            @endswitch
          @endif 
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->



  <main id="main" class="content">
    <!-- ======= About Section ======= -->
    <!-- End Recent Blog Posts Section -->

    <!-- ======= Contact Section ======= -->

    <section id="info-pkl" class="info-pkl">
      <div class="info-pkl-container">

      </div>
      <div class="container" data-aos="fade-up"> 
        <div class="row"> 
          <div class="col-md-4 p-4 order-2 order-lg-1 list-pengumuman">          
          </div>
          <div class="col-md-8 p-4 order-1 order-lg-2">
            <p id="info-pkl-judul" class="h3 judulpost"></p>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <p id="info-pkl-subjudul" class="tgl"></p>
                  </div>
                  <div class="col-md-8">
                    <p id="info-pkl-subjudul"> <i class="bi bi-person" style="color: #2B2E7A;"></i>&nbsp;Humas
                      PT PLN Indonesia Power Kamojang POMU</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12" style="color: #404040;" id="isi">
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
    </section><!-- End register-akun Section -->
  </main><!-- End #main -->
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
            <a href="https://www.youtube.com/channel/UCPulnU-un0DplD1yco24MLQ"><img src="/assets_ip2022/img/youtube_logo.png" width="32px" height="auto" style="margin-right: 10px;"></a>
            <a href="https://www.instagram.com/plnindonesiapower.kmj/"><img src="/assets_ip2022/img/instagram.png"></a>
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
  {{-- <script src="/assets_ip2022/vendor/purecounter/purecounter.js"></script> --}}
  <script src="/assets_ip2022/vendor/aos/aos.js"></script>
  <script src="/assets_ip2022/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets_ip2022/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/assets_ip2022/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets_ip2022/vendor/swiper/swiper-bundle.min.js"></script>
  {{-- <script src="/assets_ip2022/vendor/php-email-form/validate.js"></script> --}}
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <!-- Template Main JS File -->
  <script src="/assets_ip2022/js/main.js"></script>
  {{-- <script src="/assets_ip2022/js/sendiri.js"></script> --}} 
  <script>  
   lihat( {{$request->id}} )   
    function lihat(id){
    $.get(`/api/get-pengumuman/list/${id}`).done(function( data ) {     
          var html = '';
          if(data.data2.length != 0){ 
            $('.judulpost').html(data.data2[0].judul ? data.data2[0].judul : '');
            $('.tglmenu').html( data.data2[0].created_at ? moment(data.data2[0].created_at).locale('id').format('DD')+'</br>'+moment(data.data2[0].created_at).locale('id').format('MMM') : '')
            $('.tgl').html(data.data2[0].created_at?`<i class="bi bi-calendar2" style="color: #2B2E7A;"></i>&nbsp;`+moment(data.data2[0].created_at).locale('id').format('DD MMMM YYYY'):'')
            $('#isi').html(data.data2[0].isi?data.data2[0].isi:'');
            html +=`<div class="bd-callout bd-callout-info2">
              <div class="row">
                <div class="col-sm-12 d-inline-flex align-items-center justify-content-start align-self-center">
                  <span style="float: left;align-self: baseline;">
                    <p id="format-tanggal-box" class="p-2 tglmenu">${moment(data.data2[0].created_at).locale('id').format('DD')+'</br>'+moment(data.data2[0].created_at).locale('id').format('MMM')}</p>
                  </span>
                  <p id="content-info-box" style="display: flex;" class="p-2">
                  ${data.data2[0].judul} 
                  </p>
                </div>
              </div>
            </div>`; 
          }  
          if(data.data.length != 0){ 
            $.each( data.data, function( key, value ) {
              html +=`
              <div class="bd-callout bd-callout-warning2" onclick="lihat(${value.id})">
              <div class="row">
                <div class="col-sm-12 d-inline-flex align-items-center justify-content-start align-self-center">
                  <span style="float: left;align-self: baseline;">
                    <p id="format-tanggal-box" class="p-2">${moment(value.created_at).locale('id').format('DD')}<br>${moment(value.created_at).locale('id').format('MMM')}</p>
                  </span>
                  <p id="content-info-box" style="display: flex;" class="p-2">
                    ${value.judul}
                  </p>
                </div>
              </div>
            </div>`; 
            });
          }
            $('.list-pengumuman').html(html);
        });
    }
  </script>
 
 
</body>

</html>