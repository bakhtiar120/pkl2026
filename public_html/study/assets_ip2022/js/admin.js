$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



//----- [ button click function ] ----------
$("#btn-pendaftaran").click(function (e) {

    e.preventDefault();


    let units = [];

    $(".unit-tab").each(function () {

        let unitId = $(this).find(".unit-id-input").val();

        if (!unitId) {
            return;
        }

        let bidangData = [];
        let totalKuota = 0;

        $(this).find(".bidang-wrapper .col-md-6").each(function () {

            let id_bidang = $(this).find('input[name*="[id_bidang]"]').val();
            let kuota = parseInt($(this).find(".kuota-input").val()) || 0;
            totalKuota += kuota;

            bidangData.push({
                id_bidang: id_bidang,
                kuota_bidang: kuota
            });

        });
        console.log('total kuota ', totalKuota)
        if (totalKuota === 0) {
            return;
        }

        units.push({
            id_unit_bidang: unitId,
            bidang: bidangData
        });

    });

    let tgl_pendaftaran = $("#tgl_pendaftaran").val().split("-");
    let tgl_pelaksanaan = $("#tgl_pelaksanaan").val().split("-");
    console.log('units ', units)
    // kalau semua unit kuota 0
    if (units.length === 0) {
        alert("Minimal satu unit harus memiliki kuota.");
        return;
    }

    let formData = {
        _token: $('input[name="_token"]').val(),
        tgl_mulai_pendaftaran: moment(tgl_pendaftaran[0]).format('YYYY-MM-DD'),
        tgl_selesai_pendaftaran: moment(tgl_pendaftaran[1]).format('YYYY-MM-DD'),
        tgl_mulai_pelaksanaan: moment(tgl_pelaksanaan[0]).format('YYYY-MM-DD'),
        tgl_selesai_pelaksanaan: moment(tgl_pelaksanaan[1]).format('YYYY-MM-DD'),
        data_unit: units
    };

    createPost(formData);

});

$("#update-kuota-pendaftaran").click(function (event) {

    event.preventDefault();

    let inputPeriode = $("#inputperiode").val();

    let data_unit = [];

    $("#unit-tab-content .tab-pane").each(function () {

        let unitId = $(this).find(".unit-id-input").val();

        let bidang = [];

        $(this).find(".bidang-wrapper .col-md-6").each(function () {

            let idBidang = $(this).find(".id-bidang").val();
            let kuota = parseInt($(this).find(".kuota-input").val()) || 0;

            bidang.push({
                id_bidang: idBidang,
                kuota_bidang: kuota
            });

        });

        data_unit.push({
            id_unit_bidang: unitId,
            bidang: bidang
        });

    });
    console.log('data unit ', data_unit)

    let form_data = {
        _token: $('[name="_token"]').val(),
        id_periode: inputPeriode,
        data_unit: data_unit
    };

    updateKuotaPost(form_data);

});

$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $("#url_delete").val();
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function (value) {
        if (value) {
            window.location.href = url;
        }
    });
});

$('.delete-confirm-bidang').on('click', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var url = "/admin/delete-bidang/" + id;
    // console.log("urlnya ", url)
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function (value) {
        if (value) {
            window.location.href = url;
        }
    });
});

// klik tombol edit
$('body').on('click', '.editUnitKerja', function () {

    let id = $(this).data('id');

    $.get("edit-unit-kerja/" + id, function (data) {
        // console.log('isi data ', data)
        $('#ajaxUnitKerjaModel').html("Edit Unit Kerja");
        $('#ajax-unit-kerja-model').modal('show');

        $('#id').val(data.id);
        $('input[name="name"]').val(data.name);
    });
});

$('.delete-confirm-unit-kerja').on('click', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var url = "/admin/delete-unit-kerja/" + id;
    // console.log("urlnya ", url)
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function (value) {
        if (value) {
            window.location.href = url;
        }
    });
});

$('.reset-password').on('click', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var url = "/admin/reset-password/" + id;
    swal({
        title: 'Are you sure?',
        text: 'Password of this user will be reset!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function (value) {
        if (value) {
            window.location.href = url;
        }
    });
});

$('.terima-magang').on('click', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var url = "/admin/terima-magang/" + id;
    swal({
        title: 'Apakah kamu yakin?',
        text: 'Peserta ini akan diterima magang!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function (value) {
        if (value) {
            window.location.href = url;
        }
    });
});

$('.tolak-magang').on('click', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var url = "/admin/tolak-magang/" + id;
    swal({
        title: 'Apakah kamu yakin?',
        text: 'Peserta ini akan ditolak magang!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function (value) {
        if (value) {
            window.location.href = url;
        }
    });
});

$('.delete-confirm-pendaftaran').on('click', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var url = "/admin/delete-pendaftaran/" + id;
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function (value) {
        if (value) {
            window.location.href = url;
        }
    });
});

$('.delete-confirm-mentor').on('click', function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var url = "/admin/delete-mentor/" + id;
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function (value) {
        if (value) {
            window.location.href = url;
        }
    });
});

$('.delete-confirm-fakultas').on('click', function (event) {
    event.preventDefault();

    const url = $(this).attr("href");
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function (value) {
        delete_fakultas(url);
    });
});
$('input[name="tgl_pelaksanaan"]').daterangepicker({
    startDate: moment(),
    endDate: moment(),
    locale: {
        format: 'DD MMMM YYYY'
    }
});
$('input[name="tgl_pendaftaran"]').daterangepicker({
    startDate: moment(),
    endDate: moment(),
    locale: {
        format: 'DD MMMM YYYY'
    }
});

$('#createnewadmin').click(function () {
    $('#saveBtn').val("create-Customer");
    $('#Customer_id').val('');
    $('#CustomerForm').trigger("reset");
    $('#modelHeading').html("Tambah Data Admin");
    $('#ajaxModel').modal('show');
});


$('#addNewBidang').on('click', function (event) {
    $('#addEditBidang').trigger("reset");
    $('#ajaxBidangModel').html("Tambah Bidang");
    $('#ajax-bidang-model').modal('show');
});
$('body').on('click', '#pilihMentor', function (event) {

    event.preventDefault();

    var id = $(this).data('id');
    var nomor_peserta = $(this).data('nomor-peserta');
    var picture = $(this).data('picture');
    $('.img-profil').attr('src', picture);
    $("#nomor_peserta").text('');
    $("#nama_peserta").text('');
    var nama = $(this).data('nama');
    $("#nomor_peserta").append(nomor_peserta);
    $("#nama_peserta").append(nama);
    $('#id_profil').val(id)

});

$('#btn-save-mentor').on('click', function (event) {
    var id = $("#id_profil").val();
    var id_mentor = $("#nama_mentor").val();
    // ajax
    $.ajax({
        type: "POST",
        url: "simpan-mentor",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id: id, id_mentor: id_mentor },
        dataType: 'json',
        success: function (res) {
            window.location.assign('mentor-selesai-pilih')
            //   $('#code').val(res.code);
            //   $('#author').val(res.author);
        }
    });
});
//upload-sertifikat
$('#btn-upload-sertifikat').on('click', function (event) {
    var id = $("#id_profil").val();
    var file = $('#upload')[0].files;
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    $("#btn-upload-sertifikat").html('Please Wait...');
    $("#btn-upload-sertifikat").attr("disabled", true);
    var fd = new FormData();
    fd.append('file', file[0]);
    fd.append('_token', CSRF_TOKEN);
    fd.append('id', id);
    // ajax
    $.ajax({
        type: "POST",
        url: '/admin/upload-sertifikat',
        // "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: fd,

        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (res) {
            window.location.assign('/admin/sertifikat')
            $("#btn-upload-sertifikat").attr("disabled", false);
        }
    });
});

$('#btn-save-data-mentor').on('click', function (event) {
    var id = $("#id").val();
    var nama_mentor = $("#nama_mentor").val();
    var email = $("#email").val();
    var nip = $("#nip").val();
    var jabatan = $("#jabatan").val();
    var nama_bidang = $("#nama_bidang").val();
    $("#btn-save-data-mentor").html('Sedang Proses...');
    $("#btn-save-data-mentor").attr("disabled", true);
    // ajax
    $.ajax({
        type: "POST",
        url: "register-mentor",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id: id, nama_mentor: nama_mentor, email: email, nip: nip, jabatan: jabatan, nama_bidang: nama_bidang },
        dataType: 'json',
        success: function (res) {
            $("#btn-save-data-mentor").html('Simpan Perubahan');
            $("#btn-save-data-mentor").attr("disabled", false);
            if (res.status == 'success') {
                window.location.assign('show-data-mentor')
            }
            else {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $(".print-error-msg").find("ul").append('<li>' + res.message + '</li>');
                // printErrorMsg(res.message);
            }

            //   $('#code').val(res.code);
            //   $('#author').val(res.author);
        }
    });
});
$('#savebtnadmin').on('click', function (event) {
    var email = $("#email").val();
    $("#savebtnadmin").html('Sedang Proses...');
    $("#savebtnadmin").attr("disabled", true);
    // ajax
    $.ajax({
        type: "POST",
        url: "register-admin",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { email: email },
        dataType: 'json',
        success: function (res) {
            $("#savebtnadmin").html('Simpan Data');
            $("#savebtnadmin").attr("disabled", false);
            if (res.status == 'success') {
                window.location.assign('show-data-admin')
            }
            else {
                printErrorMsg(res.error);
            }

            //   $('#code').val(res.code);
            //   $('#author').val(res.author);
        }
    });
});
// console.log('valuenya image ',$('#imageResult').attr('src') )
if ($('#imageResult').attr('src') == '/upload/null' || $('#imageResult').attr('src') == '#') {
    $('#btn-update-bidang').attr('disabled', true);
    $('#btn-save').attr('disabled', true)
}
else {
    $('#btn-update-bidang').attr('disabled', false);
    $('#btn-save').attr('disabled', false)
}
$('input[type=file]').change(function () {
    if ($('input[type=file]').val() == '') {
        $('#btn-update-bidang').attr('disabled', true)
        $('#btn-save').attr('disabled', true)

    }
    else {
        $('#btn-update-bidang').attr('disabled', false);
        $('#btn-save').attr('disabled', false)
    }
})
$('#dataTable').DataTable();
$('#dataTable2').DataTable({ ordering: false });

$('#btn-update-bidang').on('click', function (event) {
    var id = $("#id").val();
    var nama_bidang = $("#nama_bidang").val();
    var deskripsi = $("#deskripsi_bidang").val();
    var jurusan = $("#jurusan_bidang").val();
    var status = $("#customSwitch1").is(":checked");

    var file = $('#upload')[0].files;
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    $("#btn-update-bidang").html('Please Wait...');
    $("#btn-update-bidang").attr("disabled", true);
    var fd = new FormData();
    if (status == true) {
        fd.append('status', 'Aktif');
    }
    else {
        fd.append('status', 'Tidak Aktif');
    }
    fd.append('file', file[0]);
    fd.append('_token', CSRF_TOKEN);
    fd.append('id', id);
    fd.append('nama_bidang', nama_bidang);
    fd.append('deskripsi', deskripsi);
    fd.append('jurusan', jurusan);

    //   console.log("isi data ",fd);
    // ajax
    $.ajax({
        type: "POST",
        url: '/admin/update-bidang',
        // "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: fd,

        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (res) {
            window.location.assign('/admin/show-bidang')
            $("#btn-update-bidang").attr("disabled", false);
        }
    });
});
$('#btn-update-mentor').on('click', function (event) {
    var id_mentor = $("#id_mentor").val();
    var id_user = $("#id_user").val();
    var nama_mentor = $("#nama_mentor").val();
    var email = $("#email").val();
    var nip = $("#nip").val();
    var jabatan = $("#jabatan").val();
    $("#btn-update-mentor").html('Sedang Proses...');
    $("#btn-update-mentor").attr("disabled", true);
    // ajax
    $.ajax({
        type: "POST",
        url: "/admin/update-mentor",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id_mentor: id_mentor, id_user: id_user, nama_mentor: nama_mentor, email: email, nip: nip, jabatan: jabatan },
        dataType: 'json',
        success: function (res) {
            $("#btn-update-mentor").html('Update');
            $("#btn-update-mentor").attr("disabled", false);
            if (res.status == 'success') {
                window.location.assign('/admin/show-data-mentor')
            }
            else {
                printErrorMsg(res.error);
            }

            //   $('#code').val(res.code);
            //   $('#author').val(res.author);
        }
    });
});
function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $.each(msg, function (key, value) {
        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
    });
}
$('.edit-bidang').on('click', function (event) {
    var id = $(this).data('id');
    // ajax
    $.ajax({
        type: "POST",
        url: "edit-bidang",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id: id },
        dataType: 'json',
        success: function (res) {
            $('#ajaxBidangModel').html("Edit Bidang");
            $('#ajax-bidang-model').modal('show');
            $('#id').val(res.id);
            $('#nama_bidang').val(res.nama_bidang);
            //   $('#code').val(res.code);
            //   $('#author').val(res.author);
        }
    });
});
$('.edit-mentor').on('click', function (event) {
    var id = $(this).data('id');
    // ajax
    $.ajax({
        type: "POST",
        url: "edit-mentor",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id: id },
        dataType: 'json',
        success: function (res) {
            //   if(res.status=='success')
            //   {
            window.location.href = "get-data-mentor/" + id;
            //   }
            //   else {
            //     swal("Oops!", "Data ini tidak bisa diedit", "error");
            //   }
            //   $('#code').val(res.code);
            //   $('#author').val(res.author);
        }
    });
});
$('#btn-save').on('click', function (event) {
    var id = $("#id").val();
    var nama_bidang = $("#nama_bidang").val();
    var deskripsi = $("#deskripsi_bidang").val();
    var jurusan = $("#jurusan_bidang").val();
    var file = $('#upload')[0].files;
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    $("#btn-save").html('Please Wait...');
    $("#btn-save").attr("disabled", true);
    var fd = new FormData();
    var status = $("#customSwitch1").is(":checked");

    if (status == true) {
        fd.append('status', "Aktif");
    }
    else {
        fd.append('status', "Tidak Aktif");
    }
    fd.append('file', file[0]);
    fd.append('_token', CSRF_TOKEN);
    fd.append('id', id);
    fd.append('nama_bidang', nama_bidang);
    fd.append('deskripsi', deskripsi);
    fd.append('jurusan', jurusan);
    // ajax
    $.ajax({
        type: "POST",
        url: 'create-bidang',
        // "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: fd,

        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (res) {
            window.location.assign('show-bidang')
            $("#btn-save").attr("disabled", false);
        }
    });
});
function delete_fakultas(url) {
    $.ajax(
        {
            url: url, //or you can use url: "company/"+id,
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                // $("#success").html(response.message)
                if (response.result == 'success') {
                    swal("Selamat!", response.message, "success");
                }
                else {
                    swal("Oops!", response.message, "error");
                }

            }
        });
}
// create new post
function createPost(form_data) {
    $.ajax({
        url: 'post_pendaftaran',
        method: 'post',
        data: form_data,
        dataType: 'json',

        // beforeSend:function() {
        //     $("#createBtn").addClass("disabled");
        //     $("#createBtn").text("Processing..");
        // },

        success: function (res) {
            window.location = "/admin/pendaftaran_berjalan";
        }
    });
}

function updateKuotaPost(form_data) {
    $.ajax({
        url: '/admin/update_kuota_pendaftaran',
        method: 'post',
        data: form_data,
        dataType: 'json',

        // beforeSend:function() {
        //     $("#createBtn").addClass("disabled");
        //     $("#createBtn").text("Processing..");
        // },

        success: function (res) {
            window.location = "/admin/pendaftaran_berjalan";
        }
    });
}

function hideErrorUploadDokumen() {
    $('#namadokumencheck').hide();
    $('#uploaddokumencheck').hide();
}

hideErrorUploadDokumen();

$('#upload_dokumen').on('change', function () {
    var $input = $(this);

    /* collect list of files choosen */
    var files = $input[0].files;

    var filename = files[0].name;

    /* getting file extenstion eg- .jpg,.png, etc */
    var extension = filename.substr(filename.lastIndexOf("."));

    /* define allowed file types */
    var allowedExtensionsRegx = /(\.pdf)$/i;

    /* testing extension with regular expression */
    var isAllowed = allowedExtensionsRegx.test(extension);

    if (isAllowed) {
        $('#uploaddokumencheck').hide();
        var namadokumen = $('#nama_dokumen').val();
        if (namadokumen != "") {
            $('#btn-upload-dokumen').attr('disabled', false)
        }
        else {
            $('#btn-upload-dokumen').attr('disabled', true)
        }
        /* file upload logic goes here... */
    } else {
        $('#uploaddokumencheck').show();
        $('#uploaddokumencheck').html('File yang diupload harus pdf');
        $('#btn-upload-dokumen').attr('disabled', true)
        return false;
    }
});

function validateFileUpload() {
    var input = $("#upload_dokumen").val();
    var $input2 = $("#upload_dokumen");
    if (input != "") {
        var files = $input2[0].files;

        var filename = files[0].name;

        /* getting file extenstion eg- .jpg,.png, etc */
        var extension = filename.substr(filename.lastIndexOf("."));

        /* define allowed file types */
        var allowedExtensionsRegx = /(\.pdf)$/i;

        /* testing extension with regular expression */
        var isAllowed = allowedExtensionsRegx.test(extension);

        if (isAllowed) {
            $('#uploaddokumencheck').hide();
            var namadokumen = $('#nama_dokumen').val();
            if (namadokumen != "") {
                $('#btn-upload-dokumen').attr('disabled', false)
            }
            else {
                $('#btn-upload-dokumen').attr('disabled', true)
            }
            /* file upload logic goes here... */
        } else {
            $('#uploaddokumencheck').show();
            $('#uploaddokumencheck').html('File yang diupload harus pdf');
            $('#btn-upload-dokumen').attr('disabled', true)
            return false;
        }
    }
}

let namaDokumenError = true;
$("#nama_dokumen").keyup(function () {
    validateNamaUnit();
});

function validateNamaUnit() {
    var input = $("#upload_dokumen").val();
    let nama_dokumen = $("#nama_dokumen").val();
    if (nama_dokumen.length == "") {
        $("#namadokumencheck").show();
        $('#btn-upload-dokumen').attr('disabled', true)
        namaDokumenError = false;
        return false;
    } else {
        validateFileUpload();
        $("#namadokumencheck").hide();
    }
}

$('#btn-upload-dokumen').on('click', function (event) {
    var id = $("#id").val();
    var nama_dokumen = $("#nama_dokumen").val();
    var file = $('#upload_dokumen')[0].files;
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    $("#btn-upload-dokumen").html('Please Wait...');
    $("#btn-upload-dokumen").attr("disabled", true);
    var fd = new FormData();
    fd.append('file', file[0]);
    fd.append('_token', CSRF_TOKEN);
    fd.append('id', id);
    fd.append('nama_dokumen', nama_dokumen);
    fd.append('jenis_file', 'Surat Edaran Senior Manager');
    // ajax
    $.ajax({
        type: "POST",
        url: 'upload-dokumen',
        // "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: fd,

        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (res) {
            window.location.assign('upload-dokumen')
        }
    });
});
$('#createNewUnitKerja').click(function () {
    $('#id').val('');
    $('#addEditUnitKerjaForm').trigger("reset");
    $('#ajaxUnitKerjaModel').html("Tambah Unit Kerja");
    $('#ajax-unit-kerja-model').modal('show');
});

// submit form
$('#addEditUnitKerjaForm').submit(function (e) {
    e.preventDefault();

    let id = $('#id').val();
    let url = '';

    if (id == '') {
        url = "create-unit-kerja";
    } else {
        url = "update-unit-kerja/" + id;
    }
    let formData = $(this).serialize();

    $.ajax({

        type: "POST",
        url: url,
        data: formData,
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                $('#ajax-unit-kerja-model').modal('hide');
                location.reload();
            }
        },
        error: function (error) {
            alert('Terjadi kesalahan');
        }
    });
});

// update post
function updatePost(form_data) {
    $.ajax({
        url: 'post',
        method: 'put',
        data: form_data,
        dataType: 'json',

        beforeSend: function () {
            $("#createBtn").addClass("disabled");
            $("#createBtn").text("Processing..");
        },

        success: function (res) {
            $("#createBtn").removeClass("disabled");
            $("#createBtn").text("Update");

            if (res.status == "success") {
                $(".result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
            }

            else if (res.status == "failed") {
                $(".result").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
            }
        }
    });
}

// ---------- [ Delete post ] ----------------
function deletePost(post_id) {
    var status = confirm("Do you want to delete this post?");
    if (status == true) {
        $.ajax({
            url: "post/" + post_id,
            method: 'delete',
            dataType: 'json',

            success: function (res) {
                if (res.status == "success") {
                    $("#result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                }
                else if (res.status == "failed") {
                    $("#result").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>×</button>" + res.message + "</div>");
                }
            }
        });
    }
}


let unitIndex = $('#unit-list li').length;

$('#select-unit').change(function () {

    let unitId = $(this).val();
    let unitName = $("#select-unit option:selected").text();

    if (unitId == '') return;

    unitIndex++;

    let tabId = "unit_" + unitIndex;


    // NAV
    let nav = `
<li class="nav-item">

<a class="nav-link p-2 d-flex justify-content-between align-items-center"
data-toggle="pill"
href="#${tabId}">
<div>
${unitName}
(<span class="nav-total">0</span>)
</div>
<button type="button"
class="btn btn-sm btn-outline-danger remove-unit ml-2">
<i class="fas fa-trash"></i>
</button>
</a>



</li>
`;

    $("#unit-list").append(nav);


    // TAB
    let template = $("#unit-template .unit-tab").clone();

    template.attr("id", tabId);

    template.find(".unit-id-input").val(unitId);

    template.find(".kuota-input").val(0);

    $("#unit-tab-content").append(template);


    // aktifkan tab
    $('#unit-list a[href="#' + tabId + '"]').tab('show');


    // disable option
    $('#select-unit option[value="' + unitId + '"]').prop('disabled', true);

    $('#select-unit').val('');

});


// REMOVE UNIT

$(document).on('click', '.remove-unit', function () {


    let navItem = $(this).closest('li');

    let tabId = navItem.find('a').attr('href');

    let tabPane = $(tabId);

    let unitId = tabPane.find('.unit-id-input').val();

    $('#select-unit option[value="' + unitId + '"]').prop('disabled', false);

    tabPane.remove();
    navItem.remove();

    $('#unit-list a.nav-link').first().tab('show');

});


// HITUNG TOTAL KUOTA

$(document).on('input', '.kuota-input', function () {

    let tab = $(this).closest('.tab-pane');

    let total = 0;

    tab.find('.kuota-input').each(function () {

        let val = parseInt($(this).val()) || 0;

        total += val;

    });

    tab.find('.total-kuota').text(total);

    let tabId = tab.attr('id');

    $('#unit-list a[href="#' + tabId + '"]')
        .find('.nav-total')
        .text(total);

});


// HITUNG TOTAL KUOTA
$(document).on('input', '.kuota-input', function () {

    let tab = $(this).closest('.tab-pane');

    let total = 0;

    tab.find('.kuota-input').each(function () {

        total += parseInt($(this).val()) || 0;

    });

    tab.find('.total-kuota').text(total);


    let tabId = tab.attr('id');

    let nav = $('#unit-list a[href="#' + tabId + '"]');

    nav.find('.nav-total').text(total);

});

