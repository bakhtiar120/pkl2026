@extends('dashboards.admins.index')
  
@section('content')

@inject('request', 'Illuminate\Http\Request')
@inject('artikel', 'App\Models\Artikel')
@if ($request->id)
  @php 
  $data = $artikel::where('id', $request->id)->first();
  @endphp
@else
  @php  
  $data  = new  $artikel;
  @endphp
@endif

     <!-- Begin Page Content -->
     <div class="container-fluid">

          <!-- breadcrumb -->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                  <li class="breadcrumb-item"><a href="/admin/pengumuman">Pengumuman</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah Pengumuman</li>
                </ol>
              </nav>

        <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Pengumuman</h1>
            </div>
            <!-- DataTales Example -->
            <div class="card shadow-new mb-4">
                <div class="card-body">
                    {{-- ====================================================--}}
                    <form id="pengumuman">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Judul Pengumuman</label>
                        <input type="text" value="{{$data->judul}}" name="judul" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Judul" required> 
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> 
                        <input type="hidden" name="id" value="{{$data->id}}"> 
                      </div> 
                      <textarea name="isi" id="myTextarea">{{$data->isi}}</textarea>
                      <span class="float-right">
                      <input type="submit" class="btn btn-new mt-3"  value="Simpan dan Terbitkan"> 
                      </span>
                    </form>
                  {{--====================================================--}}
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <div id="myModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Simpan Pegumuman</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary save">Simpan</button>
          </div>
         
        </div>
      </div>
    </div>
    
<script>

  
$(document).ready(function() {
    $.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 
      $( "#pengumuman" ).submit(function( event ) { 
        event.preventDefault();
        $('#myModal').modal('show')
      }); 
    $('.save').on( 'click',function () {
        $.post( "/admin/api/simpan-pengumuman",$("#pengumuman").serializeObject()).done(function(data){ 
          window.location.href = "/admin/pengumuman";
        });
    });     

      tinymce.init({
      selector: 'textarea#myTextarea',
      plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
      imagetools_cors_hosts: ['picsum.photos'],
      menubar: 'file edit view insert format tools table help',
      toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
      toolbar_sticky: true,
      autosave_ask_before_unload: true,
      autosave_interval: "30s",
      autosave_prefix: "{path}{query}-{id}-",
      autosave_restore_when_empty: false,
      autosave_retention: "2m",
      image_advtab: true,
      /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
      link_list: [
          { title: 'My page 1', value: 'https://www.codexworld.com' },
          { title: 'My page 2', value: 'https://www.xwebtools.com' }
      ],
      image_list: [
          { title: 'My page 1', value: 'https://www.codexworld.com' },
          { title: 'My page 2', value: 'https://www.xwebtools.com' }
      ],
      image_class_list: [
          { title: 'None', value: '' },
          { title: 'Some class', value: 'class-name' }
      ],
      importcss_append: true,
      // file_picker_callback: function (callback, value, meta) {
      //     /* Provide file and text for the link dialog */
      //     if (meta.filetype === 'file') {
      //         callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
      //     }
      
      //     /* Provide image and alt text for the image dialog */
      //     if (meta.filetype === 'image') {
      //         callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
      //     }
      
      //     /* Provide alternative source and posted for the media dialog */
      //     if (meta.filetype === 'media') {
      //         callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
      //     }
      // },
      templates: [
          { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
          { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
          { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
      ],
      template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
      template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
      height: 600,
      image_caption: true,
      quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
      noneditable_noneditable_class: "mceNonEditable",
      toolbar_mode: 'sliding',
      contextmenu: "link image imagetools table",
      // ------------------------------------------
      image_title: true,
      automatic_uploads: true,
      images_upload_url: '/upload-file?_token={{ csrf_token() }}',
      file_picker_types: 'image',
      file_picker_callback: function(cb, value, meta) {
          var input = document.createElement('input');
          input.setAttribute('type', 'file');
          input.setAttribute('accept', 'image/*');  
          input.onchange = function() {
              var file = this.files[0];

              var reader = new FileReader();
              reader.readAsDataURL(file);
              reader.onload = function () {
                  var id = 'blobid' + (new Date()).getTime();
                  var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                  var base64 = reader.result.split(',')[1];
                  var blobInfo = blobCache.create(id, file, base64);
                  blobCache.add(blobInfo);
                  cb(blobInfo.blobUri(), { title: file.name });
              };
          };
          input.click();
      }
      //-------------------------------------------
  });
});
 
</script>

<style>
  .file {
  visibility: hidden;
  position: absolute;
}
</style>


@endsection