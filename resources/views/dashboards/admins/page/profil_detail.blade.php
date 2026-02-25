@extends('dashboards.admins.index')
 
@inject('request','Illuminate\Http\Request')
@section('content') 
     <div class="container-fluid">
 
        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Profil</h1>
            </div>
 
<div class="row">
 
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow-new mb-4"> 
            <div class="card-body">
                    <div class="row">
                      <div class="col-md-12 col-md-offset-1 mb-4">
                        <h4 class="pt-4">Nomor Pendaftaran :  <b class="id"></b></h3>
                        <h5>Tanggal Pendaftaran :  <b class="tgl"></b></h5>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-md-offset-1">
                            <div class="alert alert-success text-center"><b class="nama-bidang"></b></div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-md-offset-1">
                        <div class="row">
                          <div class="col-sm-2">
                            <img style="" class="img-thumbnail pas_foto" src="/assets_ip2022/img/no-image.png"
                              class="rounded float-left" alt="...">
                          </div>
                          <div class="col-sm-10 pt-4">
                          <style>
                            .td1{
                                color: #858796;
                                }
                          </style>
                            <table class="table table-sm table-borderless">
                              <tr>
                                <td  colspan="3">
                                  <h5>Data Diri Peserta</h5>
                                </td>
                              </tr>
                              <tr>
                                <td class="td1">Nama Lengkap</td>
                                <td class="nama_lengkap" colspan="2"></td>
                              </tr>
                              <tr>
                                <td class="td1">Tempat Tanggal Lahir</td>
                                <td class="ttl" colspan="2"></td>
                              </tr>
                              <tr>
                                <td class="td1">Jenis Kelamin </td>
                                <td class="jenis_kelamin" colspan="2"> </td>
                              </tr>
                              <tr>
                                <td class="td1"> Agama</td>
                                <td class="agama" colspan="2"> </td>
                              </tr>
                              <tr>
                                <td class="td1"> Alamat</td>
                                <td class="alamat" colspan="2"></td>
                              </tr>
                              <tr>
                                <td class="td1"> Nomor Handphone</td>
                                <td class="nomor_handphone" colspan="2"></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <hr>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <h5>Data Dosen Pembimbing</h5>
                                </td>
                              </tr>
                              <tr>
                                <td class="td1">Nama Lengkap</td>
                                <td class="nama_dosen_pembimbing" colspan="2"></td>
                              </tr>
                              <tr>
                                <td class="td1">Jenis Kelamin </td>
                                <td class="jenis_kelamin_dosen_pembimbing" colspan="2"></td>
                              </tr>
                              <tr>
                                <td class="td1"> Email</td>
                                <td class="email_dosen_pembimbing" colspan="2"> </td>
                              </tr>
                              <tr>
                                <td class="td1"> Nomor Handphone</td>
                                <td class="nomor_handphone_dosen_pembimbing" colspan="2"> </td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <hr>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <h5>Data Perguruan Tinggi</h5>
                                </td>
                              </tr>
                              <tr>
                                <td class="td1">Nama Perguruan Tinggi</td>
                                <td class="nama_perguruan_tinggi" colspan="2"></td>
                              </tr>
                              <tr>
                                <td class="td1">Alamat</td>
                                <td class="alamat_perguruan_tinggi" colspan="2"></td>
                              </tr>
                              <tr>
                                <td class="td1"> Fakultas </td>
                                <td class="fakultas" colspan="2"></td>
                              </tr>
                              <tr>
                                <td class="td1"> Program Studi</td>
                                <td class="program_studi" colspan="2"></td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <hr>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3">
                                  <h5>Berkas</h5>
                                </td>
                              </tr>
                              <tr>
                                <td class="td1">Berkas Syarat Pendaftaran Dalam 1 File</td>
                                <td colspan="2">
                                  <button type="button" dataurl class="btn btn-sm btn-outline-new lihat_berkas" disabled>
                                    <span class="btn-label"><i class="fa fa-eye"></i></span>
                                  </button>
                                </td>
                              </tr>
                              <tr>
                                <td class="td1">Pas Foto 3x4 </td>
                                <td colspan="2">
                                  <button type="button" dataurl class="btn btn-sm btn-outline-new lihat_pas_foto" disabled>
                                    <span class="btn-label"><i class="fa fa-eye"></i></span>
                                  </button>
                                </td>
                              </tr>
                            </table>
                            <hr>
                            
                          </div>
                        </div>
      
                      </div>
                    </div>

            </div>
        </div>
    </div>
 
  
</div>
 
 
</div> 
 


<script>
     
    $(document).ready(function() {
      
  
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 

    $.get( `/admin/api/profil-member/{{$request->id}}`).done(function( data ) {
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
  $.get( `/admin/api/get-pendaftaran/${id}`).done(function( data ) {  
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
 
@endsection