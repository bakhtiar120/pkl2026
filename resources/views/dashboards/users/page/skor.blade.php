@extends('dashboards.users.index')
  
@section('content') 
     <!-- Begin Page Content -->
     <div class="container-fluid"> 

        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Penilaian</h1>
            </div>

        <!-- DataTales Example -->
        <div class="card border-left-new shadow-new h-100 py-2 mb-4">
            <div class="card-body">
                <div class="col-xl-9 col-md-9 mb-2">
                    <div class="row">
                            <div class="col-xl-2 col-md-2 mb-1">
                                <img src="/assets_ip2022/img/no-image.png" id="berkas_pas_foto" class="img-thumbnail rounded" alt="...">                    
                            </div>
                            <div class="col-xl-8 col-md-8 mb-1">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 mb-3">
                                        <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                            Nomor Pendaftaran</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800" id="id"></div>
                                    </div>
                                    <div class="col-xl-12 col-md-12 mb-3">
                                        <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                            Nama Peserta</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800" id="nama_lengkap"></div>
                                    </div>
                                    <div class="col-xl-12 col-md-12 mb-3">
                                        <div class="text-xs font-weight-bold text-new text-uppercase mb-1 pt-2">
                                            Perguruan Tinggi</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800" id="nama_perguruan_tinggi"></div>
                                    </div>
                                    <div class="col-xl-12 col-md-12 mb-3">
                                        <div class="text-xs font-weight-bold text-new text-uppercase mb-1 pt-2">
                                        Nomor Handphone</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800" id="nomor_handphone"></div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

            </div> <!-- Card Body -->
        </div> <!-- Card Shadow -->

        <div class="card shadow-new mb-4">
            <div class="card-body">
                <div class="col-xl-12 col-md-12">
                  <h5 class="font-weight-bold text-new">Penilaian</h5>
                </div>

                <div class="col-xl-12 col-md-12"><hr></div>

                <div class="col-xl-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>  
                                <th>Nama Penilaian</th> 
                                <th>Nilai</th> 
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Integritas</td>
                            <td id="skor_integritas"> </td>
                          </tr>
                          <tr>
                            <td>Pengembagan Diri</td>
                            <td id="skor_pengembagan_diri"> </td>
                          </tr>
                          <tr>
                            <td>Kreatifitas</td>
                            <td id="skor_kreatifitas"> </td>
                          </tr>
                          <tr>
                            <td>Komunikasi</td>
                            <td id="skor_komunikasi"> </td>
                          </tr>
                          <tr>
                            <td>Analisis</td>
                            <td id="skor_analisis"> </td>
                          </tr>
                          <tr>
                            <td>Kerjasama</td>
                            <td id="skor_kerja_sama"> </td>
                          </tr>
                          <tr>
                            <td>Pemahaman</td>
                            <td id="skor_pemahaman"> </td>
                          </tr>
                          <tr>
                            <td>Presentasi</td>
                            <td id="skor_presentasi"> </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div> <!-- Card Body -->
        </div> <!-- Card Shadow -->

        

    </div>
    <!-- /.container-fluid --> 
<script>

$(document).ready(function() {
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    $.get( `/user/api/get-skor`).done(function( data ) {
      //console.log(data);
      if(data.data){ 
        set_value(data.data);
      }  
    });  
});

function set_value(data){
             
        $(`#id`).html(moment(data.created_at).locale('id').format('YYYYMM')+data.id);
        $(`#nama_lengkap`).html(data.nama_lengkap);    
        $(`#skor_integritas`).html(data.skor_integritas);    
        $(`#skor_pengembagan_diri`).html(data.skor_pengembagan_diri);    
        $(`#skor_kreatifitas`).html(data.skor_kreatifitas);    
        $(`#skor_komunikasi`).html(data.skor_komunikasi);    
        $(`#skor_analisis`).html(data.skor_analisis);    
        $(`#skor_kerja_sama`).html(data.skor_kerja_sama);    
        $(`#skor_pemahaman`).html(data.skor_pemahaman);    
        $(`#skor_presentasi`).html(data.skor_presentasi);
        $('#nama_perguruan_tinggi').html(data.nama_perguruan_tinggi);
        $('#nomor_handphone').html(data.nomor_handphone); 
        $('#berkas_pas_foto').attr('src',data.berkas_pas_foto);     
       
         
         
        
  }
    

    
</script>


@endsection