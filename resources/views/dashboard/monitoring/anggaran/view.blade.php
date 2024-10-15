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
                <div class="breadcrumb-item"><a href="/dashboard/anggaran">Monitoring Anggaran</a></div>
                <div class="breadcrumb-item">Per Kelompok </div>
              </div>
            </div>
        </section>
        
        <!-- Content Row -->
        
        <div class="row">
            
            <!-- Area Chart -->
            <div class="col-xl-12">
                <div class="card card-primary shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="m-0 font-weight-bold text-primary">Data Monitoring Anggaran</h6>
                            </div>
                            <div class="col-12">
                                @foreach ( $data_kelompok as $data_kelompok)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-4">Provinsi</div>
                                                <div class="col-1">:</div>
                                                <div class="col-7">{{ $data_kelompok->provinsi_name }}</div>
                                                
                                                <div class="col-4">Nama Kelompok</div>
                                                <div class="col-1">:</div>
                                                <div class="col-7">{{ $data_kelompok->nama }}</div>
                                                
                                                <div class="col-4">Komoditi</div>
                                                <div class="col-1">:</div>
                                                <div class="col-7">{{ $data_kelompok->komoditi }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-4">Tahun</div>
                                                <div class="col-1">:</div>
                                                <div class="col-7">{{ $data_kelompok->tahun_bantuan }}</div>
                                      
                                                <div class="col-4">Total Laporan</div>
                                                <div class="col-1">:</div>
                                                <div class="col-7"><span class="badge badge-pill badge-success"><b>{{ $data_kelompok->total }}</b></span> <a href="/dashboard/anggaran/{{ $data_kelompok->id }}/create" class="text-dark"> <i class="fas fa-plus"></i> Tambah Laporan</a></div>

                                                                                       
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <a href="/dashboard/uph/create" type="button" class="btn btn-icon icon-left btn-primary"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Tambah Data Kelompok</button></a> --}}
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-stripped table-bordered display" id="anggaran">
                                <thead class="table-success">
                                <tr>
                                    <th class="text-center" scope="row">No.</th>
                                    <th class="text-center" scope="row">Kegiatan</th>
                                    <th class="text-center" scope="row">Volume</th>
                                    <th class="text-center" scope="row">Pagu</th>
                                    <th class="text-center" scope="row">Realisasi Keuangan</th>
                                    <th class="text-center" scope="row">Realisasi Keuangan</th>
                                    <th class="text-center" scope="row">Realisasi Fisik</th>
                                    <th class="text-center" scope="row">Progress / Keterangan</th>
                                    <th class="text-center" scope="row">Kendala</th>
                                    <th class="text-center" scope="row">Tindakan</th>
                                    <th class="text-center" scope="row">Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($anggaran as $anggaran)
                                <tr>
                                    <th scope="row" class="text-center">{{$loop->iteration}} </th>
                                    <td>{{ (!empty($anggaran->kegiatan)) ? $anggaran->kegiatan : '___' }}</td>
                                    <td class="text-center">{{ (!empty($anggaran->volume)) ? $anggaran->volume : '___' }} Unit</td>
                                    <td>Rp. {{ (!empty($anggaran->pagu)) ? number_format($anggaran->pagu, 0, ',', '.') : '___' }}</td>
                                    <td>Rp. {{ (!empty($anggaran->rel_keuangan)) ? number_format($anggaran->rel_keuangan, 0, ',', '.') : '___' }} </td>
                                    <td class="text-center">{{ (!empty($anggaran->rel_keuangan_persen)) ? $anggaran->rel_keuangan_persen : '___' }}%</td>
                                    <td class="text-center">{{ (!empty($anggaran->rel_fisik_persen)) ? $anggaran->rel_fisik_persen : '___' }}%</td>
                                    <td>{{ (!empty($anggaran->progres)) ? $anggaran->progres : '___' }}</td>
                                    <td>{{ (!empty($anggaran->kendala)) ? $anggaran->kendala : '___' }}</td>
                                    <td>{{ (!empty($anggaran->tindakan)) ? $anggaran->tindakan : '___' }}</td>
                                    <td class="text-center">
                                        @if(!empty($anggaran->file_upload))
                                            <button type="button" class="btn btn-outline-warning btn-icon-circle-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/storage/{{ $anggaran->file_upload }}" style="color: black" target="_blank"><i class="fa fa-fw fa-image text-success"></i> Foto</a>
                                                <a class="dropdown-item" href="/dashboard/anggaran/{{ $anggaran->anggaran_id }}/edit" style="color: black"><i class="fa fa-fw fa-edit text-warning"></i> Update</a>
                                                <a class="dropdown-item" href="/dashboard/anggaran/destroy/{{ $anggaran->anggaran_id }}'`)"><i class="fa fa-fw fa-trash text-danger"></i> Hapus</a>
                                            </div>
                                        
                                        @else     
                                            <button type="button" class="btn btn-outline-warning btn-icon-circle-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"><i class="fa fa-fw fa-image text-muted"></i><span class="text-muted">--NULL--</span></a>
                                                <a class="dropdown-item" href="/dashboard/anggaran/{{ $anggaran->anggaran_id }}/edit" style="color: black"><i class="fa fa-fw fa-edit text-warning"></i> Update</a>
                                                <a class="dropdown-item" href="/dashboard/anggaran/destroy/{{ $anggaran->anggaran_id }}'`)"><i class="fa fa-fw fa-trash text-danger"></i> Hapus</a>                            
                                            </div>    
                                        @endif
                                    </td>
                                                                        
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
    new DataTable('#anggaran', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i>',
                    titleAttr: 'Excel',
                    title: 'Data Anggaran',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
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
                                '<div class="row"><div class="col-6"><div class="row"><div class="col-4">Provinsi</div><div class="col-1">:</div><div class="col-7">{{ $data_kelompok->provinsi_name }}</div><div class="col-4">Nama Kelompok</div><div class="col-1">:</div><div class="col-7">{{ $data_kelompok->nama }}</div><div class="col-4">Komoditi</div><div class="col-1">:</div><div class="col-7">{{ $data_kelompok->komoditi }}</div></div></div><div class="col-6"><div class="row"><div class="col-4">Tahun</div><div class="col-1">:</div><div class="col-7">{{ $data_kelompok->tahun_bantuan }}</div><div class="col-4">Total Laporan</div><div class="col-1">:</div><div class="col-7"><span class="badge badge-pill badge-success"><b>{{ $data_kelompok->total }}</b></span></div></div></div></div>'   
                            )
                            .prepend(
                                '<h4 style="text-align:center; padding-top:20px ; padding-bottom:10px">Data Laporan Anggaran</h4>'
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },  
            ],
        },
    },
    columnDefs: [
        {
            targets: 9,
            visible: false,
            searchable: false
        }
    ]
});
</script>

@endpush