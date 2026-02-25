
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <br>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon my-2">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <img src="/asset/img/Frame 31.png" style="width:85%;height:auto;">
        </div>
        <div class="sidebar-brand-text my-2 mx-0">
            <img src="/asset/img/Frame 32.png" style="width:85%;height:auto;float:left;">
        </div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-2">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Dashboard</span></a>
    </li>
    
    
    
    <!-- Divider -->
    <hr class="sidebar-divider"> 
    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ (request()->is('admin/pendaftaran_berjalan')) || (request()->is('admin/pendaftaran_selesai')) || (request()->segment(2)=='detail-periode') || (request()->segment(2)=='detail-periode-selesai')   || (request()->segment(2)=='detail-bidang-pendaftaran')  || (request()->segment(2)=='detail-bidang-pendaftaran-selesai')   ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-address-card"></i>
            <span>Pendaftaran</span>
        </a>
        <div id="collapsePages" class="collapse {{ (request()->is('admin/pendaftaran_selesai')) || (request()->is('admin/pendaftaran_berjalan')) || (request()->segment(2)=='detail-periode') || (request()->segment(2)=='detail-periode-selesai') || (request()->segment(2)=='detail-bidang-pendaftaran') || (request()->segment(2)=='detail-bidang-pendaftaran-selesai') || (request()->segment(2)=='edit-kuota-pendaftaran')      ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Login Screens:</h6> --}}
                <a class="collapse-item {{ (request()->is('admin/pendaftaran_berjalan')) || (request()->segment(2)=='detail-periode')  || (request()->segment(2)=='detail-bidang-pendaftaran') || (request()->segment(2)=='edit-kuota-pendaftaran')  ? 'active' : '' }}" href="{{url('/admin/pendaftaran_berjalan')}}">Berjalan</a>
                <a class="collapse-item {{ (request()->is('admin/pendaftaran_selesai')) || (request()->segment(2)=='detail-periode-selesai')  || (request()->segment(2)=='detail-bidang-pendaftaran-selesai')  ? 'active' : '' }}" href="{{url('/admin/pendaftaran_selesai')}}">Selesai</a>
        </div>    
    </li>
    <li class="nav-item {{ (request()->is('admin/mentor-pilih')) || (request()->is('admin/mentor-selesai-pilih'))  ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
            aria-expanded="true" aria-controls="collapsePages2">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Mentor</span>
        </a>
        <div id="collapsePages2" class="collapse {{ (request()->is('admin/mentor-pilih')) || (request()->is('admin/mentor-selesai-pilih')) ? 'show'  : '' }}" aria-labelledby="headingPages2" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Login Screens:</h6> --}}
                <a class="collapse-item {{ (request()->is('admin/mentor-pilih')) ? 'active' : '' }}" href="{{url('admin/mentor-pilih')}}">Belum</a>
                <a class="collapse-item {{ (request()->is('admin/mentor-selesai-pilih')) ? 'active' : '' }}" href="{{url('admin/mentor-selesai-pilih')}}">Selesai</a>
        </div>
    </li>
    
    <li class="nav-item {{ (request()->is('admin/tugas-peserta')) || (request()->is('admin/pendaftaran_selesai')) || (request()->segment(2)=='detail-periode') || (request()->segment(2)=='detail-periode-selesai')   || (request()->segment(2)=='detail-bidang-pendaftaran')  || (request()->segment(2)=='detail-bidang-pendaftaran-selesai')   ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3"
            aria-expanded="true" aria-controls="collapsePages3">
            <i class="fas fa-fw fa-address-card"></i>
            <span>Tugas & Nilai Peserta</span>
        </a>
        <div id="collapsePages3" class="collapse {{ (request()->is('admin/nilai-peserta')) || (request()->is('admin/tugas-peserta')) || (request()->segment(2)=='detail-tugas-peserta') || (request()->segment(2)=='detail-nilai-peserta') ||  (request()->segment(2)=='detail-tugas-peserta-bidang-pendaftaran')  || (request()->segment(2)=='detail-nilai-peserta-bidang-pendaftaran') || (request()->segment(2)=='penugasan-tambahan') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Login Screens:</h6> --}}
                <a class="collapse-item {{ (request()->is('admin/tugas-peserta')) || (request()->segment(2)=='detail-tugas-peserta')  || (request()->segment(2)=='detail-tugas-peserta-bidang-pendaftaran')  ? 'active' : '' }}" href="{{url('/admin/tugas-peserta')}}">Tugas Peserta</a>
                <a class="collapse-item {{ (request()->is('admin/nilai-peserta')) || (request()->segment(2)=='detail-nilai-peserta')  || (request()->segment(2)=='detail-nilai-peserta-bidang-pendaftaran')  ? 'active' : '' }}" href="{{url('/admin/nilai-peserta')}}">Nilai Peserta</a>
        </div>    
    </li>
    
    {{-- <li class="nav-item {{ (request()->is('admin/penugasan')) ? 'active' : '' }}" >
        <a class="nav-link" href="{{ url('/admin/penugasan') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Tugas Peserta</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/skor')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/skor') }}">
            <i class="fas fa-fw fa-star"></i>
            <span>Nilai Peserta</span></a>
    </li> --}}
    <li class="nav-item {{ (request()->is('admin/sertifikat')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/sertifikat') }}">
            <i class="fas fa-fw fa-scroll"></i>
            <span>Sertifikat</span></a>
    </li>
    
    
    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/show-fakultas') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Fakultas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/show-prodi') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Program Studi</span></a>
    </li> -->
    
    
    
    
    
    
    <!-- Divider -->
    <hr class="sidebar-divider"> 
    <!-- Heading -->
    <div class="sidebar-heading">
        master
    </div>
    <li class="nav-item {{ (request()->is('admin/show-bidang')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/show-bidang') }}">
            <i class="fas fa-fw fa-bolt"></i>
            <span>Bidang</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/pengumuman')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/pengumuman') }}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Pengumuman</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/upload-dokumen')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/upload-dokumen') }}">
            <i class="fas fa-fw fa-upload"></i>
            <span>Surat Edaran</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/show-data-admin')) ? 'active' : '' }}" >
        <a class="nav-link" href="{{ url('/admin/show-data-admin') }}">
            <i class="fas fa-fw fa-robot"></i>
            <span>Data Admin</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/show-data-mentor')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/show-data-mentor') }}">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Data Mentor</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/list-member')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/list-member') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Daftar Peserta</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider"> 
    
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
    <!-- Divider -->
    
    
    </ul>  