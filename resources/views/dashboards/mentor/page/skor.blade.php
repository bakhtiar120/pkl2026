@extends('dashboards.mentor.index')
  
@section('content') 
     <!-- Begin Page Content -->
     <div class="container-fluid">

          <!-- breadcrumb -->
          <nav aria-label="breadcrumb">
                  <ol class="breadcrumb pl-0">
                      <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
                  </ol>
              </nav>

        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Penilaian</h1>
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
                                <th>Integritas</th> 
                                <th>Pengembagan<br>Diri</th> 
                                <th>Kreatifitas</th> 
                                <th>Komunikasi</th> 
                                <th>Analisis</th> 
                                <th>Kerjasama</th> 
                                <th>Pemahaman</th> 
                                <th>Presentasi</th> 
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

      <!-- Modal -->
      <div class="modal fade"  id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nilai Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-4 col-md-4 mb-4"><img src="" id="berkas_pas_foto" class="img-thumbnail rounded float-left" alt="..."></div>
                            <div class="col-xl-8 col-md-8 mb-4">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 mb-3">
                                        <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                            Nomor Pendaftaran</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800" id="nomor_pendaftaran"></div>
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
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                            <form id="formUpdateDataScore">

                                  <!-- Form -->
                                    <input type="hidden" name="id">
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Integritas</label>
                                    <input type="number" class="form-control" name="skor_integritas" placeholder="Integritas">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Pengembangan Diri</label>
                                    <input type="number" class="form-control" name="skor_pengembagan_diri" placeholder="Pengembangan Diri">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Kreatifitas</label>
                                    <input type="number" class="form-control" name="skor_kreatifitas" placeholder="Kreatifitas">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Komunikasi</label>
                                    <input type="number" class="form-control" name="skor_komunikasi" placeholder="Komunikasi">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Analisis</label>
                                    <input type="number" class="form-control" name="skor_analisis" placeholder="Analisis">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Kerja Sama</label>
                                    <input type="number" class="form-control" name="skor_kerja_sama" placeholder="Kerja Sama">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Pemahaman</label>
                                    <input type="number" class="form-control" name="skor_pemahaman" placeholder="Pemahaman">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Presentasi</label>
                                    <input type="number" class="form-control" name="skor_presentasi" placeholder="Presentasi">
                                  </div>

                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <a type="button" class="text-danger mr-3" data-dismiss="modal">Batal</a>
                    <button type="button" class="btn btn-new save">Simpan Penilaian</button>
                    </div>
                </div>
                </div>
            </div>

<script>

$(document).ready(function() {
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    //var table = $('#example').DataTable();
    $('#example tbody').on( 'click', '.update-scor', function () {
            $('#exampleModalCenter').modal('show');
            var data =$(this).data('member'); 
            $('[name="id"]').val(data.id);
            $('#nomor_pendaftaran').html(moment(data.created_at).locale('id').format('YYYYMM')+data.id);
            $('#berkas_pas_foto').attr('src',data.berkas_pas_foto);
            $('#nama_lengkap').html(data.nama_lengkap);
            $('#nama_perguruan_tinggi').html(data.nama_perguruan_tinggi);
            $('[name="skor_integritas"]').val(data.skor_integritas);
            $('[name="skor_pengembagan_diri"]').val(data.skor_pengembagan_diri);
            $('[name="skor_kreatifitas"]').val(data.skor_kreatifitas);
            $('[name="skor_komunikasi"]').val(data.skor_komunikasi);
            $('[name="skor_analisis"]').val(data.skor_analisis);
            $('[name="skor_kerja_sama"]').val(data.skor_kerja_sama);
            $('[name="skor_pemahaman"]').val(data.skor_pemahaman);
            $('[name="skor_presentasi"]').val(data.skor_presentasi);

        console.log($(this).data('member') );
    });


    $('.save').on( 'click',function () {
        $.post( "/mentor/api/update-skor",$("#formUpdateDataScore").serializeObject()).done(function(data){
            $('#exampleModalCenter').modal('hide');
            table.ajax.reload();
        });
    });  


  
    var table = $('#example').DataTable( {
        "ajax": "/mentor/api/get-skor",
        "columns": [
            { "data": "id", render : function ( data, type, row, meta ) { 
              return moment(row.created_at).locale('id').format('YYYYMM')+data;
            }},
            { "data": "nama_lengkap" },
            { "data": "skor_integritas" },
            { "data": "skor_pengembagan_diri" },
            { "data": "skor_kreatifitas" },
            { "data": "skor_komunikasi" },
            { "data": "skor_analisis" },
            { "data": "skor_kerja_sama" },
            { "data": "skor_pemahaman" },
            { "data": "skor_presentasi" },
            {"data": "id" , render : function ( data, type, row, meta ) { 
              return `<button data-member='${ JSON.stringify(row)}' type="button" class="btn btn-sm btn-outline-new update-scor">Nilai</button>`;
            }},
        ]
    } );
});
    

    
</script>


@endsection