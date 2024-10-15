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
                    <div class="media-title"><h1><i class="fa fa-file"></i> {{ $title }}</h1></div>
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

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card card-primary shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Monitoring Anggaran</h6>
                        {{-- <a href="/dashboard/uph/create" type="button" class="btn btn-icon icon-left btn-primary"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Tambah Data Kelompok</button></a> --}}
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
                                    <th class="text-center" scope="row">Jumlah Laporan</th>
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
                                    @if( $data_kelompok->total != null )
                                        <td><h4><span class="badge badge-pill badge-success"><b>{{ $data_kelompok->total }}</b></span></h4></td>
                                        <td style="font-size: 22px;">
                                            <div class="btn-group mb-1" role="group" aria-label="Basic example">
                                                <a href="/dashboard/anggaran/{{ $data_kelompok->id }}/create" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-plus"></i></a>&nbsp;
                                                <a href="/dashboard/anggaran/{{ $data_kelompok->id }}/show" class="btn btn-icon btn-sm btn-success"><i class="far fa-eye"></i></a>&nbsp;
                                            </div>
                                        </td>
                                    @else    
                                        <td><h4><span class="badge badge-pill badge-danger"><b>{{ $data_kelompok->total }}</b></span></h4></td>
                                        <td style="font-size: 22px;">
                                            <a href="/dashboard/anggaran/{{ $data_kelompok->id }}/create" class="btn btn-icon btn-sm btn-warning"><i class="fas fa-plus"></i></a>&nbsp;
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