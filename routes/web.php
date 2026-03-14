<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\UnitBidangController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\MentorAdminController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilMemberController;
use App\Http\Controllers\MentorSkorController;
use App\Http\Controllers\PenugasanTambahanController;
use App\Http\Controllers\UsersSkorController;
use App\Http\Controllers\UsersPenugasanController;
use App\Http\Controllers\MentorListUserController;
use App\Http\Controllers\MentorDetailMemberController;
use App\Http\Controllers\AdminsDetailMemberController;
use App\Http\Controllers\AdminListUserController;
use App\Http\Controllers\FileUploadControlle;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/auth/logout', [LogoutController::class, 'perform'])->name('logout.perform');
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
});

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
    ->middleware('guest')
    ->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('forgot-password');
Route::get('/reset-password-user/{token}', [ForgotPasswordController::class, 'ubah_password'])
     ->middleware('guest')
     ->name('reset-password-user');
Route::get('/download-se', [App\Http\Controllers\WelcomeController::class, 'download_se']);
Route::get('/test-email',[AdminController::class,'test_email']);
Route::view('/pendaftaran/hasil/{id}', 'pdf.test');
Route::view('/pdf/test/{id}', 'pdf.test');
Route::view('/post/{id}', 'post.post_detail');
Route::post('/upload-file', [FileUploadControlle::class, 'file_upload']);
Route::group(['prefix' => 'api'], function () {
    Route::get('/get-pengumuman/{id}', [PengumumanController::class, 'get_detail']);
    Route::get('/get-pengumuman/list/{id}', [PengumumanController::class, 'list']);
    Route::get('/get-pengumuman-4', [PengumumanController::class, 'get_4']);
});

Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});

 //Clear config cache
 Route::get('/config-cache', function() {
    \Artisan::call('config:cache');
    return 'Config cache cleared';
});
// Clear application cache
Route::get('/clear-cache', function() {
    \Artisan::call('cache:clear');
    return 'Application cache cleared';
});
// Clear view cache
Route::get('/view-clear', function() {
    \Artisan::call('view:clear');
    return 'View cache cleared';
});
// Clear cache using reoptimized class
Route::get('/optimize-clear', function() {
    \Artisan::call('optimize:clear');
    return 'View cache cleared';
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['auth','otp','isAdmin', 'PreventBackHistory']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/change-password', [AdminController::class, 'change_password'])->name('admin.change_password');
    Route::post('/change-password-user', [AdminController::class, 'changePasswordPost']);
    Route::get('pendaftaran_berjalan', [AdminController::class, 'pendaftaran_berjalan'])->name('dashboards.admins.page.pendaftaran');
    Route::get('pendaftaran_selesai', [AdminController::class, 'pendaftaran_selesai'])->name('dashboards.admins.page.pendaftaran_selesai');
    Route::get('buat_pendaftaran', [AdminController::class, 'buat_pendaftaran'])->name('dashboards.admins.page.buat_pendaftaran');
    Route::get('/detail-periode/{id}', [AdminController::class, 'detail_periode'])->name('dashboards.admins.page.detail_periode');
    Route::get('/detail-periode-selesai/{id}', [AdminController::class, 'detail_periode_selesai'])->name('dashboards.admins.page.detail_periode');
    Route::get('/export-pdf/{id}', [AdminController::class, 'export_pdf'])->name('dashboards.admins.page.pdf_template');
    Route::get('/detail-bidang-pendaftaran/{id}', [AdminController::class, 'detail_bidang_pendaftaran'])->name('dashboards.admins.page.detail_bidang_pendaftaran');
    Route::get('/detail-bidang-pendaftaran-selesai/{id}', [AdminController::class, 'detail_bidang_pendaftaran_selesai'])->name('dashboards.admins.page.detail_bidang_pendaftaran_selesai');
    Route::get('periode_bidang', [AdminController::class, 'periode_bidang'])->name('dashboards.admins.page.periode_bidang');
    Route::get('show-bidang', [BidangController::class, 'index'])->name('dashboards.admins.page.show_bidang');
    Route::get('show-unit-kerja', [UnitBidangController::class, 'index'])->name('dashboards.admins.page.show_unit_kerja');
    Route::get('edit-unit-kerja/{id}', [UnitBidangController::class, 'edit_ajax']);
Route::post('update-unit-kerja/{id}', [UnitBidangController::class, 'update_ajax']);
    Route::get('/delete-unit-kerja/{id}', [UnitBidangController::class, 'delete_unit_kerja']);
    Route::post('create-unit-kerja', [UnitBidangController::class, 'store_unit_kerja']);
    Route::get('create-bidang', [BidangController::class, 'create_bidang'])->name('dashboards.admins.page.create_bidang');
    Route::post('create-bidang', [BidangController::class, 'store_bidang']);
    Route::get('create-mentor', [MentorAdminController::class, 'create_mentor'])->name('dashboards.admins.page.create_mentor');
    Route::post('edit-bidang', [BidangController::class, 'edit_bidang']);
    Route::get('/edit-data-bidang/{id}', [BidangController::class, 'edit_data_bidang']);
    Route::get('/edit-kuota-pendaftaran/{id}', [AdminController::class, 'edit_kuota_pendaftaran']);
    Route::post('edit-mentor', [MentorAdminController::class, 'edit_mentor']);
    Route::post('update-mentor', [MentorAdminController::class, 'update_mentor']);
    Route::get('/get-data-mentor/{id}', [MentorAdminController::class, 'get_data_mentor']);
    Route::post('register-mentor', [MentorAdminController::class, 'register_mentor']);
    Route::post('register-admin', [AdminController::class, 'register_admin']);
    Route::get('show-data-mentor', [MentorAdminController::class, 'show_data_mentor'])->name('dashboards.admins.page.show_data_mentor');
    Route::get('show-data-admin', [AdminController::class, 'show_data_admin'])->name('dashboards.admins.page.show_data_admin');
    Route::get('/delete-mentor/{id}', [MentorAdminController::class, 'delete_mentor']);
    Route::post('simpan-mentor', [MentorAdminController::class, 'simpan_mentor']);
    Route::get('/delete-pendaftaran/{id}', [AdminController::class, 'delete_pendaftaran']);
    Route::get('/delete-bidang/{id}', [BidangController::class, 'delete_bidang']);
    Route::get('/delete-pengumuman/{id}', [PengumumanController::class, 'delete_pengumuman']);
    Route::get('mentor-pilih', [MentorAdminController::class, 'index'])->name('dashboards.admins.page.mentor_belum');
    Route::get('mentor-selesai-pilih', [MentorAdminController::class, 'mentor_selesai'])->name('dashboards.admins.page.mentor_selesai');
    Route::get('show-fakultas', [FakultasController::class, 'index'])->name('dashboards.admins.page.show_fakultas');
    Route::get('create-fakultas', [FakultasController::class, 'create_fakultas'])->name('dashboards.admins.page.create_fakultas');
    Route::post('create-fakultas', [FakultasController::class, 'store_fakultas']);
    Route::get('/delete-fakultas/{id}', [FakultasController::class, 'delete_fakultas']);
    Route::get('show-prodi', [ProgramStudiController::class, 'index'])->name('dashboards.admins.page.show_program_studi');
    Route::get('create-prodi', [ProgramStudiController::class, 'create_prodi'])->name('dashboards.admins.page.create_program_studi');
    Route::get('/delete-prodi/{id}', [ProgramStudiController::class, 'delete_prodi']);
    Route::get('/detail-profile/{id}', [AdminController::class, 'detail_profile']);
    Route::get('edit-prodi/{id}', [ProgramStudiController::class, 'edit_prodi'])->name('dashboards.admins.page.edit_program_studi');
    Route::post('create-prodi', [ProgramStudiController::class, 'store_prodi']);
    Route::post('update-prodi/{id}', [ProgramStudiController::class, 'update_prodi']);
    Route::post('update-bidang', [BidangController::class, 'update_bidang']);
    Route::get('chart', [AdminController::class, 'index'])->name('dashboards.admins.page.home');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('post_pendaftaran', [AdminController::class, 'store_pendaftaran']);
    Route::post('update_kuota_pendaftaran', [AdminController::class, 'update_kuota_pendaftaran']);
    Route::get('terima-magang/{id}', [AdminController::class, 'terima_magang']);
    Route::get('tolak-magang/{id}', [AdminController::class, 'tolak_magang']);
    Route::post('update-profile-info', [AdminController::class, 'updateInfo'])->name('adminUpdateInfo');
    Route::post('change-profile-picture', [AdminController::class, 'updatePicture'])->name('adminPictureUpdate');
    Route::post('change-password', [AdminController::class, 'changePassword'])->name('adminChangePassword');
    Route::get('sertifikat', [AdminController::class, 'sertifikat'])->name('dashboards.admins.page.list_sertifikat');
    Route::get('generate-sertifikat/{id}', [AdminController::class, 'generate_sertifikat'])->name('php.sertifikat');
    Route::post('upload-sertifikat', [AdminController::class, 'upload_sertifikat']);
    Route::get('/reset-password/{id}', [AdminController::class, 'reset_password']);
    Route::get('upload-dokumen', [AdminController::class, 'show_form_dokumen'])->name('dashboards.admins.page.upload_dokumen');
    Route::post('upload-dokumen', [AdminController::class, 'store_dokumen']);

    //--------------------------------------------syam---------------------------------------------

    Route::get('/detail-tugas-peserta-bidang-pendaftaran/{id}', [AdminController::class, 'detail_tugas_peserta_bidang_pendaftaran'])->name('dashboards.admins.page.detail_tugas_peserta_bidang_pendaftaran');
    Route::get('/detail-nilai-peserta-bidang-pendaftaran/{id}', [AdminController::class, 'detail_nilai_peserta_bidang_pendaftaran'])->name('dashboards.admins.page.detail_nilai_peserta_bidang_pendaftaran');

    Route::get('tugas-peserta', [AdminController::class, 'tugas_peserta'])->name('dashboards.admins.page.tugas_peserta');
    Route::get('nilai-peserta', [AdminController::class, 'nilai_peserta'])->name('dashboards.admins.page.nilai_peserta');

    // Route::get('/detail-periode/{id}', [AdminController::class, 'detail_periode'])->name('dashboards.admins.page.detail_periode');
    // Route::get('/detail-periode-selesai/{id}', [AdminController::class, 'detail_periode_selesai'])->name('dashboards.admins.page.detail_periode');

    Route::get('/detail-tugas-peserta/{id}', [AdminController::class, 'detail_tugas_peserta'])->name('dashboards.admins.page.detail_tugas_peserta');
    Route::get('/detail-nilai-peserta/{id}', [AdminController::class, 'detail_nilai_peserta'])->name('dashboards.admins.page.detail_nilai_peserta');

    Route::view('/list-member', 'dashboards.admins.page.list_user');
    Route::view('/detail-user/{id}', 'dashboards.admins.page.profil_detail');
    Route::view('/penugasan', 'dashboards.admins.page.penugasan');
    Route::view('/skor', 'dashboards.admins.page.skor');
    Route::view('/pengumuman', 'dashboards.admins.page.pengumuman');
    Route::view('/tambah-pengumuman', 'dashboards.admins.page.tambah_pengumuman');
    Route::view('/edit-pengumuman/{id}', 'dashboards.admins.page.tambah_pengumuman');
    Route::view('/penugasan-tambahan/{id}', 'dashboards.admins.page.penugasan_tambahan_detail');

    Route::group(['prefix' => 'api'], function () {
        Route::get('/list-priode-pendaftaran-aktif', [ProfilMemberController::class, 'list_priode_pendaftaran_aktif_admin']);
        Route::get('/list-kuota/{id_periode}/{unit}', [ProfilMemberController::class, 'list_kuota']);
        Route::get('/list-unit-kerja/{id_periode}', [ProfilMemberController::class, 'list_unit_kerja']);
        Route::post('/simpan-pendaftaran', [ProfilMemberController::class, 'simpan_pendaftaran_admin']);
        Route::post('/simpan-pengumuman ', [PengumumanController::class, 'simpan_pengumuman']);
        Route::get('/get-pengumuman ', [PengumumanController::class, 'get']);
        Route::get('/get-pengumuman/{id} ', [PengumumanController::class, 'get_detail']);
        Route::get('/get-list-user', [AdminListUserController::class, 'get_list_user']);
        Route::get('/profil-member/{id}', [AdminsDetailMemberController::class, 'profil_member']);
        Route::get('/get-pendaftaran/{id}', [AdminsDetailMemberController::class, 'get_pendaftaran']);
        Route::post('/update-skor', [MentorSkorController::class, 'update_scor']);
        Route::get('/get-skor', [MentorSkorController::class, 'get']);
        Route::get('/get-penugasan-tambahan', [PenugasanTambahanController::class, 'get']);
        Route::get('/get-penugasan-tambahan/{id}', [PenugasanTambahanController::class, 'get_penugasan_tambahan']);
        Route::get('/get-profile-member/{id}', [PenugasanTambahanController::class, 'get_profile_member']);
        Route::post('/tambah-penugasan', [PenugasanTambahanController::class, 'tambah_penugasan_tambahan']);
        Route::post('/edit-penugasan', [PenugasanTambahanController::class, 'edit_penugasan_tambahan']);
        Route::post('/hapus-penugasan', [PenugasanTambahanController::class, 'hapus_penugasan_tambahan']);
        Route::get('/chart', [HomeController::class, 'chart']);
    });
    //--------------------------------------------/syam---------------------------------------------
});

Route::group(['prefix' => 'user', 'middleware' => ['auth','otp','isUser', 'PreventBackHistory']], function () {
    Route::view('/', 'dashboards.users.page.home');
    Route::view('/home', 'dashboards.users.page.home');
    Route::view('/pendaftaran-pkl-online', 'dashboards.users.pendaftaran_pkl_online');
    Route::view('/proses', 'dashboards.users.proses');
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('settings', [UserController::class, 'settings'])->name('user.settings');
    Route::view('/skor', 'dashboards.users.page.skor');
    Route::get('/sertifikat', [UserController::class, 'download_sertifikat']);
    Route::view('/penugasan', 'dashboards.users.page.penugasan');
    Route::get('/change-password', [UserController::class, 'change_password'])->name('user.change_password');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('userChangePassword');


    Route::group(['prefix' => 'api'], function () {
        Route::post('/pendaftaran', [ProfilMemberController::class, 'insert_pendaftaran']);
        Route::get('/profil-member', [ProfilMemberController::class, 'profil_member']);
        Route::post('/upload-pasfoto', [ProfilMemberController::class, 'upload_pasfoto']);
        Route::post('/upload-berkas', [ProfilMemberController::class, 'upload_berkas']);
        Route::get('/list-priode-pendaftaran-aktif', [ProfilMemberController::class, 'list_priode_pendaftaran_aktif']);
        Route::get('/list-kuota/{id_periode}/{unit}', [ProfilMemberController::class, 'list_kuota']);
        Route::get('/list-unit-kerja/{id_periode}', [ProfilMemberController::class, 'list_unit_kerja']);
        Route::post('/simpan-pendaftaran', [ProfilMemberController::class, 'simpan_pendaftaran']);
        Route::post('/validasi-pendaftaran', [ProfilMemberController::class, 'validasi_pendaftaran']);
        Route::get('/get-pendaftaran/{id}', [ProfilMemberController::class, 'get_pendaftaran']);
        Route::get('/get-skor', [UsersSkorController::class, 'get']);
        Route::get('/get-penugasan', [UsersPenugasanController::class, 'get']);
        Route::get('/get-penugasan-tambahan', [UsersPenugasanController::class, 'get_tambahan']);
        Route::post('/upload-file-penugasan-tambahan', [UsersPenugasanController::class, 'upload_file_penugasan_tambahan']);
        Route::post('/upload-file-penugasan', [UsersPenugasanController::class, 'upload_file_penugasan']);
    });
});

Route::group(['prefix' => 'mentor', 'middleware' => ['auth', 'otp','isMentor', 'PreventBackHistory']], function () {
    Route::view('/penugasan-tambahan/{id}', 'dashboards.mentor.page.penugasan_tambahan_detail');
    Route::get('/', [MentorController::class, 'index'])->name('mentor.dashboard');
    Route::get('/home', [MentorController::class, 'index'])->name('mentor.dashboard');
    Route::get('/dashboard', [MentorController::class, 'index'])->name('mentor.dashboard');
    Route::get('/penugasan', [MentorController::class, 'penugasan'])->name('mentor.penugasan');
    Route::get('/skor', [MentorController::class, 'skor'])->name('mentor.skor');
    Route::view('/list-user', 'dashboards.mentor.page.list_user');
    Route::view('/detail-user/{id}', 'dashboards.mentor.page.profil_detail');
    Route::get('/change-password', [MentorController::class, 'change_password'])->name('mentor.change_password');
    Route::post('/change-password-user', [MentorController::class, 'changePasswordPost']);

    Route::group(['prefix' => 'api'], function () {
        Route::post('/update-skor', [MentorSkorController::class, 'update_scor']);
        Route::get('/get-skor', [MentorSkorController::class, 'get']);
        Route::get('/get-penugasan-tambahan', [PenugasanTambahanController::class, 'get']);
        Route::get('/get-penugasan-tambahan/{id}', [PenugasanTambahanController::class, 'get_penugasan_tambahan']);
        Route::get('/get-profile-member/{id}', [PenugasanTambahanController::class, 'get_profile_member']);
        Route::post('/tambah-penugasan', [PenugasanTambahanController::class, 'tambah_penugasan_tambahan']);
        Route::post('/edit-penugasan', [PenugasanTambahanController::class, 'edit_penugasan_tambahan']);
        Route::post('/hapus-penugasan', [PenugasanTambahanController::class, 'hapus_penugasan_tambahan']);
        Route::get('/get-list-user', [MentorListUserController::class, 'get_list_user']);
        Route::get('/profil-member/{id}', [MentorDetailMemberController::class, 'profil_member']);
        Route::get('/get-pendaftaran/{id}', [MentorDetailMemberController::class, 'get_pendaftaran']);
        Route::get('/chart', [HomeController::class, 'chart']);
    });
});
Route::middleware('auth')->group(function () {

    Route::get('/verify-otp', [OtpController::class,'show'])
        ->name('otp.form');

    Route::post('/verify-otp', [OtpController::class,'verify'])
        ->name('otp.verify');

    Route::post('/resend-otp', [OtpController::class,'resend'])
        ->name('otp.resend')
        ->middleware('throttle:3,1');

});