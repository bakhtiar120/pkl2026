@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0">
          <li class="breadcrumb-item"><a href="/admin/show-bidang">Bidang</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tambah Bidang</li>
        </ol>
      </nav>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> Tambah Bidang</h1>

    <!-- Content Row -->
    <div class="row">
        <!-- Data Table -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new">
                <div class="card-body">
                    <!-- form  -->
                    <form>
                    <div class="row">
                        <div class="col-xl-3 col-md-3 col-sm-12">
                            <label class="h6 font-weight-bold text-gray-500">Tambah Bidang</label>
                        </div>
                        <div class="col-xl-9 col-md-9 col-sm-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Icon Bidang</label>
                                    <div class="input-group d-flex align-items-center">
                                        <input type="file" class="form-control-file" id="upload" name="upload" onchange="readURL(this);" style="display: none;">
                                        <div class="input-group-append">
                                            <label for="upload" class="btn btn-outline-new" style="border-radius: 6px;">Pilih file</label>
                                        </div>
                                        <label id="upload-label" for="upload" class="ml-2">Pilih File</label>
                                    </div>
                                    
                                    <script>
                                        /*  ==========================================
                                            SHOW UPLOADED IMAGE
                                        * ========================================== */
                                        function readURL(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();

                                                reader.onload = function (e) {
                                                    $('#imageResult')
                                                        .attr('src', e.target.result);
                                                };
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }

                                        $(function () {
                                            $('#upload').on('change', function () {
                                                readURL(input);
                                            });
                                        });

                                        /*  ==========================================
                                            SHOW UPLOADED IMAGE NAME
                                        * ========================================== */
                                        var input = document.getElementById( 'upload' );
                                        var infoArea = document.getElementById( 'upload-label' );

                                        input.addEventListener( 'change', showFileName );
                                        function showFileName( event ) {
                                        var input = event.srcElement;
                                        var fileName = input.files[0].name;
                                        infoArea.textContent = ' ' + fileName;
                                        }
                                    </script>
                                    <p class="font-italic">Tampilan icon akan muncul dibawah</p>
                                    <div class="mt-2"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                </div>
                                <div class="col-md-6"></div>
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group col-md-6">
                                    <label for="namabidang">Nama Bidang</label>
                                    <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" placeholder="Nama Bidang">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="deskripsibidang">Deskripsi Bidang</label>
                                    <textarea class="form-control" id="deskripsi_bidang" name="deskripsi_bidang" rows="3" placeholder="Isi Deskripsi Bidang"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="jurusanbidang">Jurusan</label>
                                  <input type="text" class="form-control" id="jurusan_bidang" name="jurusan_bidang" placeholder="contoh : Teknik Mesin, Teknik Konversi">
                                </div>
                                <div class="col-md-12">
                                    <label>Status</label>
                                    <!-- Default checked -->
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                        <label class="custom-control-label" for="customSwitch1">Aktifkan Bidang</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12"><hr></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <span class="float-right">
                                <a rel="nofollow" href="javascript:history.back()"  class="text-danger mr-3">Batal</a>
                                <button type="submit" class="btn btn-new" id="btn-save" disabled>Simpan Perubahan</button>
                            </span>
                        </div>
                    </div>
                    
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection