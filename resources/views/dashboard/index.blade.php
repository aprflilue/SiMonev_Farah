@extends('dashboard.layouts.main')

@section('container')

<section class="section">
    <div class="section-header">
        <div class="media-body">
            <div class="media-title"><h1>Dashboard</h1></div>
            @can('pusat')
            <span class="text-muted">Admin Pusat</span>
            @endcan
            @can('provinsi')
            <span class="text-muted">Admin Provinsi<div class="bullet"></div> <span class="text-primary">{{$provinsi_auth->name}}</span></span>
            @endcan
        </div>
    </div>

    <div class="col-md-12 col-lg-12">
        <div class="row mt-4">
            
            <div class="col-lg-4">
                <div class="card report-card">
                    <a href="/dashboard/users" class="btn-dashboard" style="text-decoration:none">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <h6 class="text-muted mb-1 font-weight-400">Admin Pusat</h6>
                            </div>
                            <div class="col">
                                <h4 class="text-dark font-weight-700">{{ $admin }} Admin</h4>
                                <small class="text-muted">Last Update: {{ (!empty($admin_update)) ? \Carbon\Carbon::parse($admin_update->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j M Y, H:i') : 'No update' }}</small>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon ">
                                    <i class="fa fa-user-secret fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card report-card">
                    <a href="/dashboard/admin" class="btn-dashboard" style="text-decoration:none">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <h6 class="text-muted mb-1 font-weight-400">Admin Provinsi</h6>
                            </div>
                            <div class="col">
                                <h4 class="text-dark font-weight-700">{{ $admins }} Admin</h4>
                                <small class="text-muted">Last Update: {{ (!empty($admins_update)) ? \Carbon\Carbon::parse($admins_update->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j M Y, H:i') : 'No update' }}</small>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon ">
                                    <i class="fa fa-users fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card report-card">
                    <a href="/dashboard/uph" class="btn-dashboard" style="text-decoration:none"> 
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <h6 class="text-muted mb-1 font-weight-400">Unit Pengolahan Hasil</h6>
                            </div>
                            <div class="col">
                                <h4 class="text-dark font-weight-700">{{ $uph }} UPH</h4>
                                <small class="text-muted">Last Update: {{ (!empty($uph_update)) ? \Carbon\Carbon::parse($uph_update->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j M Y, H:i') : 'No update' }}</small>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon ">
                                    <i class="fa fa-cog fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="card report-card">
                    <a href="/dashboard/tp" class="btn-dashboard" style="text-decoration:none"> 
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <h7 class="text-muted mb-1 font-weight-400">Monitoring TP</h7>
                            </div>
                            <div class="col">
                                <h4 class="text-dark font-weight-700">{{ count($tp) }} <span style="font-size: 13px">of {{ $tp_all }}</span> Data</h5>
                                <small class="text-muted"><i class="far fa-clock"></i> {{ (!empty($tp_update)) ? \Carbon\Carbon::parse($tp_update->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j M Y, H:i') : 'No update' }}</small>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon ">
                                    <i class="far fa-file" style='font-size:25px'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="card report-card">
                    <a href="/dashboard/dekon" class="btn-dashboard" style="text-decoration:none"> 
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <h7 class="text-muted mb-1 font-weight-400">Monitoring Dekon</h7>
                            </div>
                            <div class="col">
                                <h4 class="text-dark font-weight-700">{{ count($dekon) }} <span style="font-size: 13px">of {{ $dekon_all }}</span> Data</h5>
                                <small class="text-muted"><i class="far fa-clock"></i> {{ (!empty($dekon_update)) ? \Carbon\Carbon::parse($dekon_update->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j M Y, H:i') : 'No update' }}</small>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon ">
                                    <i class="far fa-calendar" style='font-size:25px'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="card report-card">
                    <a href="/dashboard/anggaran" class="btn-dashboard" style="text-decoration:none">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <h7 class="text-muted mb-1 font-weight-400">Monitoring Anggaran</h7>
                            </div>
                            <div class="col">
                                @foreach ($anggaran as $anggaran)
                                @if ($loop->first)
                                <h4 class="text-dark font-weight-700">{{ $loop->count }} <span style="font-size: 13px">of {{ $anggaran_all }}</span> Data</h5>
                                @endif
                                @endforeach
                                <small class="text-muted"><i class="far fa-clock"></i> {{ (!empty($anggaran_update)) ? \Carbon\Carbon::parse($anggaran_update->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j M Y, H:i') : 'No update' }}</small>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon ">
                                    <i class="fab fa-gg" style='font-size:25px'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="card report-card">
                    <a href="/dashboard/evaluasi" class="btn-dashboard" style="text-decoration:none">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <h7 class="text-muted mb-1 font-weight-400">Evaluasi</h7>
                            </div>
                            <div class="col">
                                <h4 class="text-dark font-weight-700">{{ count($evaluasi) }} <span style="font-size: 13px">of {{ $uph }}</span> Data</h5>
                                <small class="text-muted"><i class="far fa-clock"></i> {{ (!empty($evaluasi_update)) ? \Carbon\Carbon::parse($evaluasi_update->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j M Y, H:i') : 'No update' }}</small>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="report-main-icon ">
                                    <i class="fa fa-list-ul" style='font-size:23px'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Data UPH Per Provinsi</h6>
                    </div>
                    <div class="card-body">
                        <div id="container_uph"></div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
                        <a href="/dashboard/users" class="btn btn-primary btn-lg btn-round">
                            View More  <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <ul class="list-unstyled list-unstyled-border">
                        <div class="card-body">             
                            @foreach ($users as $users)
                                
                            <li class="media">
                                @if ($users->provinsi_id == null)
                                    <img class="mr-3 rounded-circle" width="50" src="/img/avatar/avatar-2.png" alt="avatar">
                                    <div class="media-body">
                                        <div class="media-title">{{ $users->name }}</div>
                                        <span class="text-small text-muted">Admin Pusat</span>
                                    </div>
                                @else    
                                    <img class="mr-3 rounded-circle" width="50" src="/img/avatar/avatar-4.png" alt="avatar">
                                    <div class="media-body">
                                        <div class="media-title">{{ $users->name }}</div>
                                        <span class="text-small text-muted">Admin Provinsi <div class="bullet"></div> <span class="text-primary">{{$users->provinsi_name}}</span></span>
                                    </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        <div>
                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="card shadow mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Monitoring TP <span style="font-size:13px">--Belum Diisi</span></h6>
                        <a href="/dashboard/tp" class="btn btn-primary btn-lg btn-round">
                            Fill More <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-stripped table-bordered" id="">
                                <thead class="table-success">
                                <tr>
                                    <th class="text-center" scope="row">Provinsi</th>
                                    <th class="text-center" scope="row">Kelompok</th>
                                    <th class="text-center" scope="row">Komoditi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tp_tabel as $tp_tabel)
                                    <tr>
                                        <td>{{ $tp_tabel->provinsi_name }}</td>
                                        <td>{{ $tp_tabel->nama }}</td>
                                        <td>{{ $tp_tabel->komoditi }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Monitoring Dekon <span style="font-size:13px">--Belum Diisi</span></h6>
                        <a href="/dashboard/dekon" class="btn btn-primary btn-lg btn-round">
                            Fill More <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="">
                                <thead class="table-success">
                                <tr>
                                    <th class="text-center" scope="row">Provinsi</th>
                                    <th class="text-center" scope="row">Kelompok</th>
                                    <th class="text-center" scope="row">Jenis Komoditi</th>
                                    <th class="text-center" scope="row">Tahun</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dekon_tabel as $dekon_tabel)
                                <tr>
                                    <td>{{$dekon_tabel->provinsi_name}}</td>
                                    <td>{{$dekon_tabel->nama}}</td>
                                    <td>{{$dekon_tabel->komoditi}}</td>
                                    <td>{{$dekon_tabel->tahun_bantuan}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Monitoring Anggaran <span style="font-size:13px">--Belum Diisi</span></h6>
                        <a href="/dashboard/anggaran" class="btn btn-primary btn-lg btn-round">
                            Fill More <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="">
                                <thead class="table-success">
                                <tr>
                                    <th class="text-center" scope="row">Provinsi</th>
                                    <th class="text-center" scope="row">Kelompok</th>
                                    <th class="text-center" scope="row">Jenis Komoditi</th>
                                    <th class="text-center" scope="row">Tahun</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($anggaran_tabel as $anggaran_tabel)
                                <tr>
                                    <td>{{$anggaran_tabel->provinsi_name}}</td>
                                    <td>{{$anggaran_tabel->nama}}</td>
                                    <td>{{$anggaran_tabel->komoditi}}</td>
                                    <td>{{$anggaran_tabel->tahun_bantuan}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Evaluasi <span style="font-size:13px">--Belum Diisi</span></h6>
                        <a href="/dashboard/evaluasi" class="btn btn-primary btn-lg btn-round">
                            Fill More <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="dataTable">
                                <thead class="table-success">
                                <tr>
                                    <th class="text-center" scope="row">Provinsi</th>
                                    <th class="text-center" scope="row">Kelompok</th>
                                    <th class="text-center" scope="row">Komoditi</th>
                                    <th class="text-center" scope="row">Tahun</th>
                                    <th class="text-center" scope="row">Jenis</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($evaluasi_tabel as $evaluasi_tabel)
                                <tr>
                                    <td>{{$evaluasi_tabel->provinsi_name}}</td>
                                    <td>{{$evaluasi_tabel->nama}} </td>
                                    <td>{{$evaluasi_tabel->komoditi}} </td>
                                    <td>{{$evaluasi_tabel->tahun_bantuan}} </td>
                                    <td>{{$evaluasi_tabel->jenis_bantuan}} </td>
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
</section>

@endsection

@push('script')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    $('table').dataTable({searching: false, paging: false});

</script>

<script>
	var provinsi = <?= $provinsi ?>;

    Highcharts.chart('container_uph', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: ''
    },
    credits: {
        enabled: false
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Data per Provinsi'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:13px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> data<br/>'
    },

    series: [
        {
            name: 'Data Provinsi UPH',
            colorByPoint: true,
            data: provinsi,
                
        }
    ],
});


</script>

@endpush