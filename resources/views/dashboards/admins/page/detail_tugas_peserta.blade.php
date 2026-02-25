@extends('dashboards.admins.index')
  
@section('content') 
<div class="container-fluid">

                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb pl-0">
                          <li class="breadcrumb-item"><a href="/admin/tugas-peserta">Tugas Peserta</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Bidang</li>
                        </ol>
                      </nav>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h5 mb-0 text-gray-800">Bidang</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Card Detail -->
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-new shadow-new h-100 py-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-md-3 mb-2">
                                            <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                                Periode Pendaftaran</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">{{date('d F Y', strtotime($periodes[0]->tgl_mulai_pendaftaran))}}<br>{{date('d F Y', strtotime($periodes[0]->tgl_selesai_pendaftaran))}}</div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 mb-2">
                                            <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                                Periode Pelaksanaan</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">{{date('d F Y', strtotime($periodes[0]->tgl_mulai_pelaksanaan))}}<br>{{date('d F Y', strtotime($periodes[0]->tgl_selesai_pelaksanaan))}}</div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 mb-2">
                                            <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                                Total Kuota</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">{{$periodes[0]->jumlah_kuota}}</div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 mb-2">
                                            <div class="text-xs font-weight-bold text-new text-uppercase mb-1">
                                                Total Peserta Lolos</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">{{count($lolos1)}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow-new mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Bidang</th>
                                                    <th>Kuota / Peserta Lulus</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @foreach ($bidangs as $bidang)
                                                <?php
                                                
                                                    if($bidang->jumlah_kuota>0) { ?>
                                                    <tr>
                                                        <td>{{$bidang->nama_bidang}}</td>
                                                        <td>{{$bidang->jumlah_kuota}} / {{$bidang->jumlah_lolos}}</td>
                                                        <td>
                                                            @if($bidang->jumlah_kuota==$bidang->jumlah_lolos)
                                                            <span class="badge badge-pill badge-new">Tuntas</span>
                                                            @endif
                                                            @if($bidang->jumlah_kuota>$bidang->jumlah_lolos)
                                                            <span class="badge badge-pill badge-new">Belum Tuntas</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('/admin/detail-tugas-peserta-bidang-pendaftaran/') }}/{{$bidang->id}}"> <button type="button" class="btn btn-sm btn-outline-new">Detail</button></a>
                                                         </td>
                                                      </tr>

<?php                                               
}
                                                ?>
                                              
                                             @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
@endsection