@extends('dashboard.layouts.main')

@section('container')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css" rel="stylesheet">
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
                <div class="breadcrumb-item"><a href="/dashboard/laporan">Laporan</a></div>
                <div class="breadcrumb-item">Laporan Monitoring</div>
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
                        <h6 class="m-0 font-weight-bold text-primary">Data Laporan Monitoring</h6>
                        {{-- <a href="/dashboard/uph/create" class="btn btn-icon icon-left btn-primary"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Input Data</span></a> --}}
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-stripped table-bordered display" id="monitoring">
                                <thead class="table-success text-center">
                                <tr>
                                    <th class="text-center" scope="row">No.</th>
                                    <th class="text-center" scope="row">Provinsi</th>
                                    <th class="text-center" scope="row">Kelompok</th>
                                    <th class="text-center" scope="row">Jenis Pengolahan</th>
                                    <th class="text-center" scope="row">Tahun</th>
                                    <th class="text-center" scope="row">Jenis</th>
                                    <th class="text-center" scope="row">Progres</th>
                                    <th class="text-center" scope="row">Progres</th>
                                    <th class="text-center" scope="row">Detail</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data_kelompok as $data_kelompok)
                                <tr>
                                    <th scope="row">{{$loop->iteration}} </th>
                                    <td>{{$data_kelompok->provinsi_name}}</td>
                                    <td>{{$data_kelompok->nama}} </td>
                                    <td>{{$data_kelompok->komoditi}} </td>
                                    <td class="text-center">{{$data_kelompok->tahun_bantuan}} </td>
                                    
                                    @if( $data_kelompok->jenis_bantuan == "TP")
                                        <td class="text-center"><span style="color: #009b24"><b>TP</b></span></td>
                                        
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
                                            <td class="column_color">{{$percent}}%</td>
                                            @endforeach
                                            <td class="text-center">
                                                <a href="/dashboard/laporan_tp/{{ $data_kelompok->id }}/show" class="btn btn-icon btn-sm btn-secondary"><i class="far fa-eye"></i></a>&nbsp;
                                            </td>
                                        @else
                                            <td><div class="text-small font-weight-600 text-muted"><i class="fas fa-circle" style="font-size: 9px"></i> Belum Diisi </div></td>
                                            <td>--Belum Diisi</td>
                                            <td></td>
                                        @endif
                                    @elseif( $data_kelompok->jenis_bantuan == "Dekon")
                                        <td class="text-center"><span style="color: #003cbd"><b>Dekon</b></span></td>
                                        
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

                                            <td>{{$percent}}%</td>
                                            @endforeach
                                            <td class="text-center">
                                                <a href="/dashboard/laporan_dekon/{{ $data_kelompok->id }}/show" class="btn btn-icon btn-sm btn-secondary"><i class="far fa-eye"></i></a>&nbsp;
                                            </td>
                                        @else
                                            <td><div class="text-small font-weight-600 text-muted"><i class="fas fa-circle" style="font-size: 9px"></i> Belum Diisi </div></td>
                                            <td>--Belum Diisi--</td>
                                            <td></td>
                                        @endif
                                    @elseif( $data_kelompok->jenis_bantuan == "Anggaran")
                                        <td class="text-center"><span style="color: #ee9b00"><b>Anggaran</b></span></td>
                                        
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

                                            <td>{{$percent}}%</td>

                                            <td class="text-center">
                                                <a href="/dashboard/laporan_anggaran/{{ $data->anggaran_id }}/show" class="btn btn-icon btn-sm btn-secondary"><i class="far fa-eye"></i></a>&nbsp;
                                            </td>
                                            @endif
                                            @endforeach
                                        @else
                                            <td><div class="text-small font-weight-600 text-muted"><i class="fas fa-circle" style="font-size: 9px"></i> Belum Diisi </div></td>
                                            <td>--Belum Diisi</td>
                                            <td></td>
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

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

@endsection

@push('script')

{{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>


<script>
    new DataTable('#monitoring', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'Excel',
                    title: 'Laporan Monitoring',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7]
                    }
                },

                {
                    extend: 'print',
                    text: '<i class="fa fa-print" aria-hidden="true"></i>',
                    titleAttr: 'Pdf',
                    title: '',
                    customize: function (win) {
                        $(win.document.body)
                            // .css('text-align', 'center')
                            .prepend(
                                '<h4 style="text-align:center; padding-top:20px ; padding-bottom:10px">Data Laporan Monitoring</h4>'
                            )
                            .prepend(
                                '<img src="/img/kementan/logo.png" style="margin:auto ; display:block; width:8% ; padding-top:10px ; padding-bottom:10px " />'
                            )
                            .prepend(
                                '<img src="/img/kementan/logo-fade.png" style="position:absolute; width:50% ; padding-top:50%; margin:auto; left:0; right:0" />'    
                            );
                            
                        $(win.document.body)
                            .find('thead')
                            .css('background-color', '#AAD6B4');
 
                        $(win.document.body)
                            .find('table')
                            .css('font-size', 'inherit');

                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 7]
                    }
                },  
            ],
        },
    },
    columnDefs: [
        {
            targets: 7,
            visible: false,
            searchable: false
        }
    ]
});
</script>
@endpush