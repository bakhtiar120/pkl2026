@extends('dashboards.admins.index')
  
@section('content') 
     <!-- Begin Page Content -->
     <div class="container-fluid">

          <!-- breadcrumb -->
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb pl-0">
                      <li class="breadcrumb-item active" aria-current="page">Penugasan</li>
                  </ol>
              </nav>

        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Penugasan</h1>
            </div>

        <!-- DataTales Example -->
        <div class="card shadow-new mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr> 
                                <th>No Pendaftaran</th>
                                <th>Nama</th> 
                                <th>Laporan Akhir</th> 
                                <th>Paper</th> 
                                <th>Poster</th> 
                                <th>Ringkasan<br>Bidang Mentor</th> 
                                <th>Video<br>Budaya Perusahaan</th>
                                <th>Aksi</th> 
                            </tr>
                        </thead> 
                        <tbody> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

<script>

  
$(document).ready(function() {
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
    var table = $('#example').DataTable( {
        "ajax": "/admin/api/get-skor",
        "columns": [
            { "data": "id", render : function ( data, type, row, meta ) { 
              return moment(row.created_at).locale('id').format('YYYYMM')+data;
            }},
            { "data": "nama_lengkap" },
            {"data": "penugasan_laporan_akhir" , render : function ( data, type, row, meta ) { 
              return (data) ? `<a href="${data}" target="_blank" class="btn btn-sm btn-link">Lihat</a>`: '';
            }},
            {"data": "penugasan_paper" , render : function ( data, type, row, meta ) { 
              return (data) ?`<a href="${data}" target="_blank" class="btn btn-sm btn-link">Lihat</a>`: '';
            }},
            {"data": "penugasan_poster" , render : function ( data, type, row, meta ) { 
              return (data) ?`<a href="${data}" target="_blank" class="btn btn-sm btn-link">Lihat</a>`: '';
            }},
            {"data": "penugasan_ringkasan_bidang_mentor" , render : function ( data, type, row, meta ) { 
              return (data) ?`<a href="${data}" target="_blank" class="btn btn-sm btn-link">Lihat</a>`: '';
            }},
            {"data": "penugasan_vidio_budaya_perusahaan" , render : function ( data, type, row, meta ) { 
              return (data) ?`<a href="${data}" target="_blank" class="btn btn-sm btn-link">Lihat</a>`: '';
            }},
            {"data": "id" , render : function ( data, type, row, meta ) { 
              return `<a href="/admin/penugasan-tambahan/${data}" class="btn btn-sm btn-outline-new">Penugasan Tambahan</a>`;
            }},
        ]
    } );
});
 
</script>


@endsection