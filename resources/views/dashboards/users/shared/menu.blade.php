
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<br>
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
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
<li class="nav-item {{ (request()->is('user/home')) || (request()->is('admin/mentor-selesai-pilih'))  ? 'active' : '' }}">
    <a class="nav-link" href="home">
        {{-- <i class="fas fa-fw fa-tachometer-alt"></i> --}}
        <i class="fas fa-fw fa-solid fa-user"></i>
        <span>Profil</span></a>
</li>

<!-- Divider -->
{{-- <hr class="sidebar-divider"> --}}

 
 

<!-- Heading -->
{{-- <div class="sidebar-heading">
    Addons
</div> --}}

 
<!-- Nav Item - Charts -->
<li class="nav-item {{ (request()->is('user/penugasan')) || (request()->is('admin/mentor-selesai-pilih'))  ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/user/penugasan') }}">
        <i class="fas fa-fw fa-solid fa-file"></i>
        <span>Penugasan</span></a>
</li> 
<li class="nav-item {{ (request()->is('user/skor')) || (request()->is('admin/mentor-selesai-pilih'))  ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/user/skor') }}">
        <i class="fas fa-fw fa-solid fa-star"></i>
        <span>Penilaian</span></a>
</li>
<li class="nav-item {{ (request()->is('user/sertifikat')) || (request()->is('admin/mentor-selesai-pilih'))  ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('/user/sertifikat') }}">
        <i class="fas fa-fw fa-scroll"></i>
        <span>Sertifikat</span></a>
</li>


 
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

 

</ul>  