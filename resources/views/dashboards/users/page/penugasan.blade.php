@extends('dashboards.users.index')
  
@section('content') 
     <!-- Begin Page Content -->
     <div class="container-fluid"> 

        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Penugasan</h1>
            </div>
        
        <!-- DataTales Example -->
        <div class="card shadow-new mb-4">
            <div class="card-body">
                <div class="col-xl-12 col-md-12">
                  <h5 class="font-weight-bold text-new">Penugasan</h5>
                </div>

                <div class="col-xl-12 col-md-12"><hr></div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>  
                                <th>Nama Tugas</th>
                                <th>File</th>
                                <th>Aksi</th> 
                            </tr>
                        </thead> 
                        <tbody>
                          <tr>
                            <td>Laporan Akhir</td>
                            <td id="penugasan_laporan_akhir"> </td>
                            <td><button type="button" data-nama="Laporan akhir" data-col="penugasan_laporan_akhir" class="btn btn-outline-new btn-sm show-modal-upload-tugas">Upload</button></td>
                          </tr>
                          <tr>
                            <td>Penugasan Paper</td>
                            <td id="penugasan_paper"> </td>
                            <td><button type="button" data-nama="Penugasan paper" data-col="penugasan_paper" class="btn btn-outline-new btn-sm show-modal-upload-tugas">Upload</button></td>
                          </tr>
                          <tr>
                            <td>Penugasan Poster</td>
                            <td id="penugasan_poster"> </td>
                            <td><button type="button" data-nama="Penugasan poster" data-col="penugasan_poster" class="btn btn-outline-new btn-sm show-modal-upload-tugas">Upload</button></td>
                          </tr>
                          <tr>
                            <td>Ringkasan Bidang Mentor</td>
                            <td id="penugasan_ringkasan_bidang_mentor"> </td>
                            <td><button type="button" data-nama="Ringkasan bidang mentor" data-col="penugasan_ringkasan_bidang_mentor" class="btn btn-outline-new btn-sm show-modal-upload-tugas">Upload</button></td>
                          </tr>
                          <tr>
                            <td>Video Budaya Perusahaan</td>
                            <td id="penugasan_vidio_budaya_perusahaan"> </td>
                            <td><button type="button" data-nama="Vidio budaya perusahaan" data-col="penugasan_vidio_budaya_perusahaan" class="btn btn-outline-new btn-sm show-modal-upload-tugas">Upload</button></td>
                          </tr>
                          <tr>
                            <td>Presentasi Akhir Pelaksanaan</td>
                            <td id="presentasi_akhir_pelaksanaan"> </td>
                            <td><button type="button" data-nama="Presentasi Akhir Pelaksanaan" data-col="presentasi_akhir_pelaksanaan" class="btn btn-outline-new btn-sm show-modal-upload-tugas">Upload</button></td>
                          </tr> 
                        </tbody>
                      </table> 
                </div>
            </div>
        </div>
        
        <div class="card shadow-new mb-4">
          <div class="card-body">
                <div class="col-xl-12 col-md-12">
                  <h5 class="font-weight-bold text-new">Penugasan Tambahan</h5>
                </div>

                <div class="col-xl-12 col-md-12"><hr></div>
                <div class="table-responsive">
                  <table class="table table-striped"> 
                      <thead>
                            <tr>  
                                <th>Nama Tugas</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Aksi</th> 
                            </tr>
                      </thead> 
                      <tbody id="listTugasTambahan">
                        
                      </tbody>
                    </table> 
              </div>
          </div>
      </div> 
    </div>

    <div class="modal fade"  id="UserUploadTugasTambahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <form id="FormUpload"> 
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title nama" id="exampleModalLongTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> 
          <div class="modal-body">  
              <div class="form-group">
                <label for="exampleFormControlFile1" id="nama"> </label>
                <input type="file" name="file" class="form-control-file"   required>
                <input type="hidden" value="" name="id" id="id">
              </div> 
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary" value="Upload"> 
              </div>
          </div>
      </div>
    </form>
    </div>


   

    <div class="modal fade" id="UserUploadTugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <form id="FormUploadTugas"> 
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title nama" id="exampleModalLongTitle"> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleFormControlFile1" id="nama"> </label>
              <input type="file" name="file" class="form-control-file"  required>
              <input type="hidden" value="" name="col" >
              <input type="hidden" value="" name="id_profil">
            </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Upload"> 
          </div>
        </div>
      </div>
    </form>
    </div>


    <!-- /.container-fluid --> 
<script>

$(document).ready(function() {
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    $('#FormUpload').submit( function (event) { 
        event.preventDefault();
        var formData = new FormData(); 
        formData.append('file', $('#FormUpload [name="file"]')[0].files[0]); 
        formData.append('id', $('#FormUpload [name="id"]').val());   
        $.ajax({
            type: "post",
            url: '/user/api/upload-file-penugasan-tambahan',
            data: formData,
            contentType: false,
            processData: false,
            success: function(x){
                $('#UserUploadTugasTambahan').modal('hide');
                $('#FormUpload [name="file"]').val(null);
                get_penugasan_tambahan();
                Swal.fire({
                    icon: 'success',
                    title: 'File diupload',
                    showConfirmButton: false,
                    timer: 1500
                })
                
            }
        })        
    });

     $('#FormUploadTugas').submit( function (event) { 
        event.preventDefault();
        var formData = new FormData(); 
        formData.append('file', $('#FormUploadTugas [name="file"]')[0].files[0]); 
        formData.append('id_profil', $('#FormUploadTugas [name="id_profil"]').val());  
        formData.append('col', $('#FormUploadTugas [name="col"]').val());  
        $.ajax({
            type: "post",
            url: '/user/api/upload-file-penugasan',
            data: formData,
            contentType: false,
            processData: false,
            success: function(x){
                $('#UserUploadTugas').modal('hide');
                $('#FormUploadTugas [name="file"]').val(null);
                get_penugasan();
                Swal.fire({
                    icon: 'success',
                    title: 'File diupload',
                    showConfirmButton: false,
                    timer: 1500
                })
                
            }
        })        
    });    

    $(document).on('click','.show-modal-upload-tambahan',function(){
      $('#UserUploadTugasTambahan').modal('show');
      $('#FormUpload [name="id"]').val($(this).data('id'));
      $('#FormUpload .nama').html($(this).data('nama'));
    });

    $(document).on('click','.show-modal-upload-tugas',function(){
      $('#UserUploadTugas').modal('show');
      $('#FormUploadTugas [name="col"]').val($(this).data('col')); 
      $('#FormUploadTugas .nama').html($(this).data('nama')); 
    });


   

    get_penugasan_tambahan();
    get_penugasan();
  
});

function get_penugasan(){
  $.get( `/user/api/get-penugasan`).done(function( data ) {
      if(data.data){ 
        set_value(data.data);
      }  
    });
}

function get_penugasan_tambahan() {
  $.get( `/user/api/get-penugasan-tambahan`).done(function( data ) {
       console.log(data);
       var html = "";
       $.each(data.data, function( index, value ) {
         html += `<tr>
                    <th scope="row">${value.nama}</th>
                    <td>${value.deskripsi}</td>
                    <td>${value.file?`<a target="_blank" type="button" href="${value.file}" class="btn-link btn-sm">Lihat</a>`:''}</td>
                    <td><button type="button" data-nama="${value.nama}" data-id="${value.id}" class="btn btn-outline-new btn-sm show-modal-upload-tambahan">Upload</button></td>
                  </tr>`; 
      });
      $('#listTugasTambahan').html(html);
    });
}

function set_value(data){
        $(`#id`).html(moment(data.created_at).locale('id').format('YYYYMM')+data.id);
        $(`#FormUploadTugas [name="id_profil"]`).val(data.id);
        $(`#nama_lengkap`).html(data.nama_lengkap);
        $(`#penugasan_laporan_akhir`).html(data.penugasan_laporan_akhir ? `<a href="${data.penugasan_laporan_akhir}" target="_blank" class="btn-link">Lihat</a>` : '');    
        $(`#penugasan_paper`).html(data.penugasan_paper ? `<a href="${data.penugasan_paper}" target="_blank" class="btn-link">Lihat</a>` : '');      
        $(`#penugasan_poster`).html(data.penugasan_poster ? `<a href="${data.penugasan_poster}" target="_blank" class="btn-link">Lihat</a>` : '');     
        $(`#penugasan_ringkasan_bidang_mentor`).html(data.penugasan_ringkasan_bidang_mentor ? `<a href="${data.penugasan_ringkasan_bidang_mentor}" target="_blank" class="btn-link">Lihat</a>` : '');    
        $(`#penugasan_vidio_budaya_perusahaan`).html(data.penugasan_vidio_budaya_perusahaan ? `<a href="${data.penugasan_vidio_budaya_perusahaan}" target="_blank" class="btn-link">Lihat</a>` : '');     
        $(`#presentasi_akhir_pelaksanaan`).html(data.presentasi_akhir_pelaksanaan ? `<a href="${data.presentasi_akhir_pelaksanaan}" target="_blank" class="btn-link">Lihat</a>` : '');     
        
  }
</script>


@endsection