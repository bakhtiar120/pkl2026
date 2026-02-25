@extends('dashboards.admins.index')
  
@section('content')
 
@inject('request', 'Illuminate\Http\Request')
 
     <!-- Begin Page Content -->
     <div class="container-fluid">

        
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item"><a href="/admin/tugas-peserta">Tugas Peserta</a></li>
          <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Lihat Tugas</a></li>
          <li class="breadcrumb-item active" aria-current="page">Penugasan Tambahan</li>
        </ol>
      </nav>

        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Penugasan Tambahan</h1>
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
                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <h5 class="font-weight-bold text-new">Data Penugasan</h5>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <button class="btn btn-sm btn-new tambah-penugasan float-right">Tambah Penugasan</button>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-md-12"><hr></div>

                <div class="col-xl-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>  
                                <th>Nama Penugasan</th> 
                                <th>Deskripsi Penugasan</th> 
                                <th>File</th> 
                                <th>Aksi</th>  
                            </tr>
                        </thead> 
                        <tbody> 
                        </tbody>
                    </table>
                </div>
                </div>
            </div> <!-- Card Body -->
        </div> <!-- Card Shadow -->



    </div>
    <!-- /.container-fluid -->
    <div class="modal fade"  id="tambah_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form id="FormAdd">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Tambah Penugasan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
            <div class="modal-body"> 
                    <!-- Form -->
                      <input type="hidden" name="id_profil" value="{{$request->id}}" required>
                    <div class="form-group">
                      <label for="nama">Nama Penugasan</label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama Penugasan" required>
                    </div>
                    <div class="form-group">
                      <label for="deskripsi">Deskripsi Penugasan</label>
                      <textarea class="form-control"  name="deskripsi"  id="deskripsi" rows="3" placeholder="Deskripsi Penugasan"></textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="text-danger mr-3" data-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-new" value="Save changes">Simpan Perubahan</button> 
                    </div>
                </div>
            </div>
        </form>
      </div>

        <!-- /.Modal Edit -->
    <div class="modal fade"  id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form id="FormEdit">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Edit Penugasan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> 
            <div class="modal-body"> 
                    <!-- Form --> 
                      <input type="hidden" name="id" >
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                      <label for="deskripsi">Deskripsi</label>
                      {{-- <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required> --}}
                      <textarea class="form-control"  name="deskripsi"  id="deskripsi" rows="3"></textarea>
                    </div> 
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="text-danger mr-3" data-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-new" value="Save changes">Simpan Perubahan</button> 
                    </div>
                </div>
            </div>
        </form>
      </div> 
     


<script>
 
function showModalhapus(id) {
    window.dataId = id;
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-new m-2',
        cancelButton: 'btn btn-link text-danger m-2'
    },
    buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
    title: 'Hapus tugas tambahan?',
    text: "Menghapus tugas tambahan akan menghapus file peserta. Lanjutkan?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus Tugas',
    cancelButtonText: 'Batal',
    reverseButtons: true
    }).then((result) => {
    if (result.isConfirmed) {
       
        $.post( "/admin/api/hapus-penugasan",{id: window.dataId}).done(function(data){
             swalWithBootstrapButtons.fire(
            'Dihapus!',
            'Tugas tambahan dihapus.',
            'success'
            );
            $('#example').DataTable().ajax.reload();
        });


    } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
    ) {

    }
    })
}

function showModalEdit(id) { 
   var data = $('#edit'+id).data('penugasan'); 
    $('#Edit').modal('show'); 
    $('#FormEdit [name="deskripsi"]').val(data.deskripsi);
    $('#FormEdit [name="nama"]').val(data.nama);
    $('#FormEdit [name="id"]').val(data.id);
}

  
$(document).ready(function() {
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 

    $('.tambah-penugasan').click(function(){
        $('#tambah_modal').modal('show');
    });


   
    $('#FormAdd').submit( function (event) { 
        event.preventDefault();
        var formData = new FormData(); 
        // formData.append('file', $('[name="file"]')[0].files[0]); 
        formData.append('id_profil', $('#FormAdd [name="id_profil"]').val()); 
        formData.append('deskripsi', $('#FormAdd [name="deskripsi"]').val()); 
        formData.append('nama', $('#FormAdd [name="nama"]').val());  
        $.ajax({
            type: "post",
            url: '/admin/api/tambah-penugasan',
            data: formData,
            contentType: false,
            processData: false,
            success: function(x){
                $('#tambah_modal').modal('hide');
                $('#FormAdd [name="id_profil"]').val("");
                $('#FormAdd [name="deskripsi"]').val("");
                table.ajax.reload();
                Swal.fire({
                    icon: 'success',
                    title: 'Tugas ditambahkan',
                    showConfirmButton: false,
                    timer: 1500
                })

            }
        })        
    });  

    $('#FormEdit').submit( function (event) { 
        event.preventDefault();
        var formData = new FormData(); 
        // formData.append('file', $('[name="file"]')[0].files[0]); 
        formData.append('id', $('#FormEdit [name="id"]').val()); 
        formData.append('deskripsi', $('#FormEdit [name="deskripsi"]').val()); 
        formData.append('nama', $('#FormEdit [name="nama"]').val());  
        $.ajax({
            type: "post",
            url: '/admin/api/edit-penugasan',
            data: formData,
            contentType: false,
            processData: false,
            success: function(x){
                $('#Edit').modal('hide');
                table.ajax.reload();
                Swal.fire({
                    icon: 'success',
                    title: 'Perubahan disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })        
    });  

    
  $.get(`/admin/api/get-profile-member/{{$request->id}}`).done(function( data ) {
        $('#nomor_pendaftaran').html(moment(data.created_at).locale('id').format('YYYYMM')+data.data.id);
        $('#nama_lengkap').html(data.data.nama_lengkap);
        $('#nama_perguruan_tinggi').html(data.data.nama_perguruan_tinggi);
        $('#nomor_handphone').html(data.data.nomor_handphone); 
        $('#berkas_pas_foto').attr('src',data.data.berkas_pas_foto); 
      });


    var table = $('#example').DataTable( {
        "ajax": "/admin/api/get-penugasan-tambahan/{{$request->id}}",
        "columns": [
            { "data": "nama" },
            { "data": "deskripsi" }, 
            {"data": "file" , render : function ( data, type, row, meta ) { 
              return (data) ? `<a href="${data}" target="_blank" class="btn btn-sm btn-link">Lihat</a>`: '';
            }},
            {"data": "id" , render : function ( data, type, row, meta ) { 
                return `<button data-penugasan='${JSON.stringify(row)}' id="edit${data}"  onclick="showModalEdit(${data})" class="btn btn-sm btn-outline-success">Edit</button>&nbsp;<button data-id="${data}" onclick="showModalhapus(${data})" class="btn btn-sm btn-outline-danger">Hapus</button>`;
            }},
        ]
    } );
});
 
</script> 
@endsection








