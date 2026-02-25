@extends('dashboards.admins.index')
  
@section('content')

     <!-- Begin Page Content -->
     <div class="container-fluid">

          <!-- breadcrumb -->
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb pl-0">
                      <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                  </ol>
              </nav>

        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Pengumuman</h1>
                <span>
                    <a href="/admin/tambah-pengumuman" class="d-none d-sm-inline-block btn btn-sm btn-new shadow-sm"><i class="fas fa-plus fa-sm pr-1"></i> Tambah Pengumuman</a>
                  </span>
            </div>

        <!-- DataTales Example -->
        @include('sweetalert::alert')
        <div class="card shadow-new mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>    
                                <th>Tanggal</th>  
                                <th>Judul</th>  
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


    <div class="modal fade bd-example-modal-lg" id="ModalLihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul"> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body" id="isi">
               
            </div>
          </div>
        </div>
      </div>

<script>

  
$(document).ready(function() {
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
    var table = $('#example').DataTable( {
        "ajax": "/admin/api/get-pengumuman",
        "columns": [
            { "data": "created_at",render : function(data){
                return  data ? moment(data).locale('id').format('DD MMMM YYYY') : '';
            }}, 
            { "data": "judul"},
            {"data": "id" , render : function ( data, type, row, meta ) { 
              return `<button onclick="lihat(${data})" class="btn btn-sm btn-outline-new">Lihat</button> <a href="/admin/edit-pengumuman/${data}" class="btn btn-sm btn-outline-success">Ubah</a> <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger delete-confirm-pengumuman" data-id="${data}" id="delete-confirm-pengumuman">Hapus</a>`;
            }},
        ]
    } );

    $("body").on("click","#delete-confirm-pengumuman",function(e){
        event.preventDefault();
    var id = $(this).data('id');
    var url="/admin/delete-pengumuman/"+id;
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        console.log("urlnya ",url)
        if (value) {
            window.location.href = url;
        }
    });

    });
   

});


function lihat(id){
    $.get(`/admin/api/get-pengumuman/${id}`).done(function( data ) {     
      if(data.data){ 
        $('#judul').html(data.data[0].judul);
        $('#isi').html(data.data[0].isi);
        $('#ModalLihat').modal('show');
      }  
    });
}


 
</script>


@endsection