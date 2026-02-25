
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
<li class="nav-item {{ (request()->is('mentor/dashboard'))  ? 'active' : '' }}">
    <a class="nav-link" href="/mentor/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

 
 
<!-- Divider -->
<hr class="sidebar-divider">

 
 
<li class="nav-item {{ (request()->is('mentor/list-user'))  ? 'active' : '' }}">
    <a class="nav-link" href="{{url('/mentor/list-user')}}">
        <i class="fas fa-fw fa-solid fa-users"></i>
        <span>Daftar Peserta</span></a>
</li>
<li class="nav-item {{ (request()->is('mentor/penugasan')) || (request()->segment(2)=='penugasan-tambahan') ? 'active' : '' }}">
    <a class="nav-link" href="{{url('/mentor/penugasan')}}">
        <i class="fas fa-fw fa-solid fa-clipboard-list"></i>
        <span>Penugasan</span></a>
</li>
<li class="nav-item {{ (request()->is('mentor/skor'))  ? 'active' : '' }}">
    <a class="nav-link" href="{{url('/mentor/skor')}}">
        <i class="fas fa-fw fa-solid fa-star"></i>
        <span>Penilaian</span></a>
</li>


 

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
 

</ul>  