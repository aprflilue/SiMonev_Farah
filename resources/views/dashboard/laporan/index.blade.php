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
                <div class="media-title"><h1><i class="fa fa-chart-bar"></i> {{ $title }}</h1></div>
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
    
    <div class="container-fluid">
        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6">
                <div class="card card-primary shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">--Monitoring</h6>
                        <a href="/dashboard/laporan_monitoring" class="btn btn-icon icon-left btn-primary"><span class="icon text-white-50"><i class="fas fa-eye"></i></span><span class="text">Lihat Lebih</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        
                        <span class="text-muted">View 5 of <b>{{ count($data_kelompoks) }}</b> Data</span>
                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="">
                                <thead class="table-success">
                                <tr>
                                    <th class="text-center" scope="row">Provinsi</th>
                                    <th class="text-center" scope="row">Kelompok</th>
                                    <th class="text-center" scope="row">Bantuan</th>
                                    <th class="text-center" scope="row">Progres</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data_kelompok as $data_kelompok)
                                <tr>
                                    <td>{{ucfirst(Str::lower($data_kelompok->provinsi_name))}}</td>
                                    <td>{{$data_kelompok->nama}} </td>
                                    
                                    @if( $data_kelompok->jenis_bantuan == "TP")
                                        <td><span style="color: #009b24"><b>TP</b></span></td>
                                        
                                        
                                        @if( $data_kelompok->status_tp != null )
                                            @foreach ($tp->where('data_kelompok_id', $data_kelompok->id) as $data)
                                        
                                            <td>
                                                <?php $percents = (13-($data->total_null))/13 * 100;
                                                    $percent = round($percents)
                                                ?>
                                                @if($percent <= 30)
                                                <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                    <div class="progress-bar bg-danger" data-width="{{ $percent }}%"></div>
                                                </div>
                                                @elseif($percent <= 70)
                                                    <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                        <div class="progress-bar bg-warning" data-width="{{ $percent }}%"></div>
                                                    </div>
                                                @elseif($percent <= 100)
                                                    <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                        <div class="progress-bar bg-success" data-width="{{ $percent }}%"></div>
                                                    </div>
                                                @endif
                                            </td>

                                            @endforeach
                                        @else
                                            <td><div class="text-small font-weight-600 text-muted"><i class="fas fa-circle" style="font-size: 9px"></i> Belum Diisi </div></td>
                                        @endif

                                    @elseif( $data_kelompok->jenis_bantuan == "Dekon")
                                        <td><span style="color: #003cbd"><b>Dekon</b></span></td>
                                        
                                        @if( $data_kelompok->status_dekon != null )

                                            @foreach ($dekon->where('data_kelompok_id', $data_kelompok->id) as $data)
                                            <td>
                                                <?php $percents = (12-($data->total_null))/12 * 100;
                                                    $percent = round($percents)
                                                ?>
                                                @if($percent <= 30)
                                                <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                    <div class="progress-bar bg-danger" data-width="{{ $percent }}%"></div>
                                                </div>
                                                @elseif($percent <= 70)
                                                    <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                        <div class="progress-bar bg-warning" data-width="{{ $percent }}%"></div>
                                                    </div>
                                                @elseif($percent <= 100)
                                                    <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                        <div class="progress-bar bg-success" data-width="{{ $percent }}%"></div>
                                                    </div>
                                                @endif
                                            </td>
                                            @endforeach
                                        @else
                                            <td><div class="text-small font-weight-600 text-muted"><i class="fas fa-circle" style="font-size: 9px"></i> Belum Diisi </div></td>
                                        @endif

                                    @elseif( $data_kelompok->jenis_bantuan == "Anggaran")
                                        <td><span style="color: #ee9b00"><b>Anggaran</b></span></td>

                                        @if( $data_kelompok->total_anggaran != 0 )

                                            @foreach ($anggaran->where('data_kelompok_id', $data_kelompok->id) as $data)
                                            @if ($loop->first)
                                            <td>
                                                <?php $percents = (10-($data->total_null))/10 * 100;
                                                    $percent = round($percents)
                                                ?>
                                                @if($percent <= 30)
                                                <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                    <div class="progress-bar bg-danger" data-width="{{ $percent }}%"></div>
                                                </div>
                                                @elseif($percent <= 70)
                                                    <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                        <div class="progress-bar bg-warning" data-width="{{ $percent }}%"></div>
                                                    </div>
                                                @elseif($percent <= 100)
                                                    <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                        <div class="progress-bar bg-success" data-width="{{ $percent }}%"></div>
                                                    </div>
                                                @endif
                                            </td>
                                            
                                            @endif
                                            @endforeach
                                        @else    
                                            <td><div class="text-small font-weight-600 text-muted"><i class="fas fa-circle" style="font-size: 9px"></i> Belum Diisi </div></td>
                                        @endif
                                    @endif
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-6">
                <div class="card card-primary shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">--Evaluasi</h6>
                        <a href="/dashboard/laporan_evaluasi" class="btn btn-icon icon-left btn-primary"><span class="icon text-white-50"><i class="fas fa-eye"></i></span><span class="text">Lihat Lebih</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <span class="text-muted">View 5 of <b>{{ count($data_kels) }}</b> Data</span>
                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="">
                                <thead class="table-success">
                                <tr>
                                    <th class="text-center" scope="row">Provinsi</th>
                                    <th class="text-center" scope="row">Kelompok</th>
                                    <th class="text-center" scope="row">Jenis</th>
                                    <th class="text-center" scope="row">Tingkat Kemanfaatan</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data_kel as $data_kelompok)
                                <tr>
                                    <td>{{ucfirst(Str::lower($data_kelompok->provinsi_name))}}</td>
                                    <td>{{$data_kelompok->nama}} </td>
                                    
                                    @if( $data_kelompok->jenis_bantuan == "TP")
                                        <td><span style="color: #009b24"><b>TP</b></span></td>
                                    @elseif( $data_kelompok->jenis_bantuan == "Dekon")
                                        <td><span style="color: #003cbd"><b>Dekon</b></span></td> 
                                    @elseif( $data_kelompok->jenis_bantuan == "Anggaran")
                                        <td><span style="color: #ee9b00"><b>Anggaran</b></span></td>
                                    @endif

                                    @if($data_kelompok->status != null)
                                    
                                    <td>
                                        @foreach ($evaluasi->where('data_kelompok_id', $data_kelompok->kelompok_id) as $eval)
                                            <?php $percents = ($eval->total_yes)/12 * 100;
                                                $percent = round($percents)
                                            ?>
                                            @if($percent <= 30)
                                            <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                <div class="progress-bar bg-danger" data-width="{{ $percent }}%"></div>
                                            </div>
                                            @elseif($percent <= 70)
                                            <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                <div class="progress-bar bg-warning" data-width="{{ $percent }}%"></div>
                                            </div>
                                            @elseif($percent <= 100)
                                            <div class="progress" data-height="10" data-toggle="tooltip" title="{{ $percent }}%">
                                                <div class="progress-bar bg-success" data-width="{{ $percent }}%"></div>
                                            </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    @else
                                        <td><div class="text-small font-weight-600 text-muted"><i class="fas fa-circle" style="font-size: 9px"></i> Belum Diisi </div></td>
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