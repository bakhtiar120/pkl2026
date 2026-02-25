@extends('dashboards.admins.index')
  
@section('content') 
<style>
    .avatar {
      vertical-align: middle;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }
    
    </style>
     <!-- Begin Page Content -->
     <div class="container-fluid">

        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Daftar Peserta</h1>
            </div>

        <!-- DataTales Example -->
        <div class="card shadow-new mb-4">
            <div class="card-body">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-contact-tab2" data-toggle="tab" href="#nav-contact2" role="tab" aria-controls="nav-contact2" aria-selected="true">Belum Verifikasi</a> 
                  <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Lolos </a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Tidak lolos</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="table-responsive pt-5">
                  <table class="table table-hover" id="example" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th>Foto</th>
                              <th>No Pendaftaran</th>
                              <th>Nama Peserta</th> 
                              <th>Nama Perguruan Tinggi</th> 
                              <th>Program Studi</th>   
                              <th>Detail</th>
                          </tr>
                      </thead> 
                      <tbody>
                      </tbody>
                  </table>
              </div>
            </div>
                <div class="tab-pane fade  show active" id="nav-contact2" role="tabpanel" aria-labelledby="nav-contact-tab2">
                  {{-- table --}}
                  <div class="table-responsive pt-5">
                    <table class="table table-hover" id="BelumVerifikasi" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>No Pendaftaran</th>
                                <th>Nama Peserta</th> 
                                <th>Nama Perguruan Tinggi</th> 
                                <th>Program Studi</th>   
                                <th>Detail</th>
                            </tr>
                        </thead> 
                        <tbody>
                        </tbody>
                    </table>
                </div>
                  {{-- table --}}
                </div>
                
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                   {{-- table --}}
                   <div class="table-responsive pt-5">
                    <table class="table table-hover" id="TidakLolos" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>No Pendaftaran</th>
                                <th>Nama Peserta</th> 
                                <th>Nama Perguruan Tinggi</th> 
                                <th>Program Studi</th>   
                                <th>Detail</th>  
                            </tr>
                        </thead> 
                        <tbody>
                        </tbody>
                    </table>
                </div>
                  {{-- table --}}
                </div>
              </div>
          
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

<script>

$(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
  
    var table = $('#example').DataTable( {
        "ajax": `/admin/api/get-list-user?status_pendaftaran=${'Lolos'}`,
        "columns": [
            { "data": "berkas_pas_foto", render : function ( data, type, row, meta ) { 
              return `<img src="${data}" alt="Avatar" class="avatar">`;
            }},
            { "data": "id", render : function ( data, type, row, meta ) { 
              return moment(row.created_at).locale('id').format('YYYYMM')+data;
            }},
            { "data": "nama_lengkap" },
            { "data": "nama_perguruan_tinggi" },
            { "data": "program_studi" }, 
            { "data": "id", render : function ( data, type, row, meta ) { 
              return `<a data-toggle="tooltip" data-placement="top" title="Detail list member" href="/admin/detail-profile/${data}" class="btn btn-sm btn-outline-new">Detail</a>`;
            }},
        ]
    } );


    var BelumVerifikasi = $('#BelumVerifikasi').DataTable( {
        "ajax": `/admin/api/get-list-user?status_pendaftaran=${'Belum Verifikasi'}`,
        "columns": [
            { "data": "berkas_pas_foto", render : function ( data, type, row, meta ) { 
              return `<img src="${data}" alt="Avatar" class="avatar">`;
            }},
            { "data": "id", render : function ( data, type, row, meta ) {  
              return moment(row.created_at).locale('id').format('YYYYMM')+data;
            }},
            { "data": "nama_lengkap" },
            { "data": "nama_perguruan_tinggi" },
            { "data": "program_studi" }, 
            { "data": "id", render : function ( data, type, row, meta ) { 
              return `<a data-toggle="tooltip" data-placement="top" title="Detail list member" href="/admin/detail-profile/${data}" class="btn btn-sm btn-outline-new">Detail</a>`;
            }},
        ]
    } );


    var TidakLolos = $('#TidakLolos').DataTable( {
        "ajax": `/admin/api/get-list-user?status_pendaftaran=${'Tidak Lolos'}`,
        "columns": [
            { "data": "berkas_pas_foto", render : function ( data, type, row, meta ) { 
              return `<img src="${data}" alt="Avatar" class="avatar">`;
            }},
            { "data": "id", render : function ( data, type, row, meta ) {  
              return moment(row.created_at).locale('id').format('YYYYMM')+data;
            }},
            { "data": "nama_lengkap" },
            { "data": "nama_perguruan_tinggi" },
            { "data": "program_studi" }, 
            { "data": "id", render : function ( data, type, row, meta ) { 
              return `<a data-toggle="tooltip" data-placement="top" title="Detail list member" href="/admin/detail-profile/${data}" class="btn btn-sm btn-outline-new">Detail</a>`;
            }},
        ]
    } );
}); 
</script>


@endsection