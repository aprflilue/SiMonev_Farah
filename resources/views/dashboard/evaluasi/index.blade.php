@extends('dashboard.layouts.main')

@section('container')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">
@endpush

<!-- Main Content -->
<div id="content">
    @include('sweetalert::alert')
    <!-- Begin Page Content -->
    
    
        <section class="section">
            <div class="section-header">
              
              <div class="media-body">
                <div class="media-title"><h1><i class="fa fa-list-ul"></i> {{ $title }}</h1></div>
                @can('pusat')
                <span class="text-muted"></span>
                @endcan
                @can('provinsi')
                <span class="text-muted">Provinsi<div class="bullet"></div> <span class="text-primary">{{$provinsi_auth->name}}</span></span>
                @endcan
            </div>
              <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item">{{ $title }}</div>
              </div>
            </div>
        </section>

        <!-- Content Row -->
    <div class="container-fluid">

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card card-primary shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Evaluasi</h6>
                        {{-- <a href="/dashboard/evaluasi/create" class="btn btn-icon icon-left btn-primary"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Input Data</span></a> --}}
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="dataTable">
                                <thead class="table-success">
                                <tr>
                                    <th class="text-center" scope="row">No.</th>
                                    <th class="text-center" scope="row">Provinsi</th>
                                    <th class="text-center" scope="row">Kelompok</th>
                                    <th class="text-center" scope="row">Jenis Komoditi</th>
                                    <th class="text-center" scope="row">Tahun</th>
                                    <th class="text-center" scope="row">Jenis</th>
                                    <th class="text-center" scope="row">Status</th>
                                    <th class="text-center" scope="row">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data_kelompok as $data_kelompok)
                                <tr>
                                    <th scope="row">{{$loop->iteration}} </th>
                                    <td>{{$data_kelompok->provinsi_name}}</td>
                                    <td>{{$data_kelompok->nama}} </td>
                                    <td>{{$data_kelompok->komoditi}} </td>
                                    <td>{{$data_kelompok->tahun_bantuan}} </td>
                                    <td>{{$data_kelompok->jenis_bantuan}} </td>
                                    @if( $data_kelompok->status != null )
                                        <td><div class="text-warning text-small font-600-bold"><i class="fas fa-circle"></i> Sudah Diisi</div> </span></td>
                                        <td>
                                            <div class="btn-group mb-1" role="group" aria-label="Basic example">
                                                <a href="/dashboard/evaluasi/{{ $data_kelompok->id }}/edit" class="btn btn-icon btn-sm btn-warning"><i class="far fa-edit"></i></a>&nbsp;
                                                <form action="/dashboard/evaluasi/{{ $data_kelompok->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-sm btn-danger " onclick="return confirm('Apakah anda yakin untuk menghapus Data Evaluasi?')"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    @else
                                        <td><div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Belum Diisi</div></td>
                                        <td>
                                            <a href="/dashboard/evaluasi/{{ $data_kelompok->id }}/create" class="btn btn-icon btn-sm btn-info"><i class="fas fa-plus"></i></a>&nbsp;
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

@endsection