@extends('dashboards.mentor.index')

@section('content')
<div class="container-fluid">

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-0"> 
            <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> Ubah Password</h1>

    <!-- Content Row -->
    <div class="row">
        <!-- Data Table -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow-new">
                <div class="card-body">
                    <!-- form  -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" method="POST" action="{{url('/mentor/change-password-user')}}">
                        <div class="row">
                            <div class="col-xl-3 col-md-3 col-sm-12">
                                <label class="h6 font-weight-bold text-gray-500">Ubah Password</label>
                            </div>
                            <div class="col-xl-9 col-md-6 col-sm-12">
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <div class="form-row">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }} col-md-12">
                                        <label for="namabidang">Password Lama</label>
                                        <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password Lama" required>
                                        @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }} col-md-12">
                                        <label for="namabidang">Password Baru</label>
                                        <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Password Baru" required>
                                        @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="namabidang">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" id="new-password-confirm" name="new-password-confirm" placeholder="Konfirmasi Password Baru" required>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <span class="float-right">
                                    <a rel="nofollow" href="javascript:history.back()" class="text-danger mr-3">Batal</a>
                                    <button type="submit" class="btn btn-new" id="btn-change-password">Ubah Password</button>
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