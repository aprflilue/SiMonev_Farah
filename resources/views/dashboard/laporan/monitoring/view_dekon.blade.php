@extends('dashboard.layouts.main')

@section('container')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">
    {{-- Search Select  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    {{-- Gantt Chart    --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="/dashboard-asset/css/style_gantt.css">
@endpush

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
                <div class="breadcrumb-item"><a href="/dashboard/laporan_monitoring">Laporan Monitoring</a></div>
                <div class="breadcrumb-item">View Dekon</div>
            </div>
        </div>
    </section>

    <!-- row -->
    <div class="card card-primary shadow mb-4">
        <div class="col-lg-10">
            
            <div class="card-body mt-3">
                
                <h3 style="color: #C59100; font-size: 20px">Data Kelompok</h3><br>
    
                <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5"><label><b>Provinsi</b></label></div>
                                <div class="col-1">:</div>
                                <div class="col-6">{{ $dekon->provinsi_name }}</div>
                                
                                <div class="col-5"><label><b>Nama Kelompok</b></label></div>
                                <div class="col-1">:</div>
                                <div class="col-6">{{ $dekon->nama }}</div>
                                
                                <div class="col-5"><label><b>Komoditi</b></label></div>
                                <div class="col-1">:</div>
                                <div class="col-6">{{ $dekon->komoditi }}</div>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5"><label><b>Tahun</b></label></div>
                                <div class="col-1">:</div>
                                <div class="col-6">{{ $dekon->tahun_bantuan }}</div>

                                <div class="col-5"><label><b>Jenis Bantuan</b></label></div>
                                <div class="col-1">:</div>
                                <div class="col-6" style="color: #003cbd"><b>Dekon</b></div>
                      
                            </div>
                        </div>
                    </div>
                
                <br><hr>

                <h3 style="color: #C59100; font-size: 20px">Timeline Kegiatan</h3><br>
                
                    <div class="wrapper mb-5">
                        <div class="gantt">
                            <div class="gantt__row gantt__row--months">
                                <div class="gantt__row-first"></div>
                                <span>Jan</span><span>Feb</span><span>Mar</span>
                                <span>Apr</span><span>May</span><span>Jun</span>
                                <span>Jul</span><span>Aug</span><span>Sep</span>
                                <span>Oct</span><span>Nov</span><span>Dec</span>
                            </div>
                            <div class="gantt__row gantt__row--lines">
                                <span></span><span></span><span></span>
                                <span></span><span></span><span></span>
                                <span></span><span></span><span></span>
                                <span></span><span></span><span></span>
                            </div>
                            
                            {{-- persiapan_pelaksanaan_a --}}
                            <div class="gantt__row {{(!empty($dekon->persiapan_pelaksanaan_a && $dekon->persiapan_pelaksanaan_b)) ?  : 'gantt__row--empty'  }}">
                                <div class="gantt__row-first">
                                    <div class="keterangan" style="text-align: left; padding-left:15px">
                                        Persiapan Pelaksanaan: <br>
                                        a. Persiapan <br>
                                        b. Penyusunan Juklak
                                    </div>
                                </div>
                                <ul class="gantt__row-bars">
                                    @if (!empty($dekon->persiapan_pelaksanaan_a && $dekon->persiapan_pelaksanaan_b))
                                        <li data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->persiapan_pelaksanaan_a)->format('j M Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->persiapan_pelaksanaan_b)->format('j M Y') }}" style="grid-column: 
                                            {{ (!empty($dekon->persiapan_pelaksanaan_a )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->persiapan_pelaksanaan_a)->format('m')) : null }}  /
                                            {{ (!empty($dekon->persiapan_pelaksanaan_b )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->persiapan_pelaksanaan_b)->format('m')) : null }}">
                                        </li>
                                    @endif
                                    @if (!empty($dekon->persiapan_pelaksanaan_a && $dekon->persiapan_pelaksanaan_b))
                                        <li data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->persiapan_pelaksanaan_a)->format('j M Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->persiapan_pelaksanaan_b)->format('j M Y') }}" style="grid-column: 
                                            {{ (!empty($dekon->persiapan_pelaksanaan_a )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->persiapan_pelaksanaan_a)->format('m')) : null }}  /
                                            {{ (!empty($dekon->persiapan_pelaksanaan_b )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->persiapan_pelaksanaan_b)->format('m')) : null }}">
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            {{-- sosialisasi_juknis_a --}}
                            <div class="gantt__row {{(!empty($dekon->sosialisasi_juknis_a && $dekon->sosialisasi_juknis_b)) ?  : 'gantt__row--empty'  }}">
                                <div class="gantt__row-first">
                                    <div class="keterangan" style="text-align: left; padding-left:15px">
                                        Sosialisasi Juknis dan Juklak
                                    </div>
                                </div>
                                <ul class="gantt__row-bars">
                                    @if (!empty($dekon->sosialisasi_juknis_a && $dekon->sosialisasi_juknis_b))
                                        <li data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->sosialisasi_juknis_a)->format('j M Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->sosialisasi_juknis_b)->format('j M Y') }}" style="grid-column: 
                                            {{ (!empty($dekon->sosialisasi_juknis_a )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->sosialisasi_juknis_a)->format('m')) : null }}  /
                                            {{ (!empty($dekon->sosialisasi_juknis_b )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->sosialisasi_juknis_b)->format('m')) : null }}">
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            {{-- koordinasi_a --}}
                            <div class="gantt__row {{(!empty($dekon->koordinasi_a && $dekon->koordinasi_b)) ?  : 'gantt__row--empty'  }}">
                                <div class="gantt__row-first">
                                    <div class="keterangan" style="text-align: left; padding-left:15px">
                                        Koordinasi
                                    </div>
                                </div>
                                <ul class="gantt__row-bars">
                                    @if (!empty($dekon->koordinasi_a && $dekon->koordinasi_b))
                                        <li data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->koordinasi_a)->format('j M Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->koordinasi_b)->format('j M Y') }}" style="grid-column: 
                                            {{ (!empty($dekon->koordinasi_a )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->koordinasi_a)->format('m')) : null }}  /
                                            {{ (!empty($dekon->koordinasi_b )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->koordinasi_b)->format('m')) : null }}">
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            
                            {{-- pelaksanaan_kegiatan_a --}}
                            <div class="gantt__row {{(!empty($dekon->pelaksanaan_kegiatan_a && $dekon->pelaksanaan_kegiatan_b)) ?  : 'gantt__row--empty'  }}">
                                <div class="gantt__row-first">
                                    <div class="keterangan" style="text-align: left; padding-left:15px">
                                        Pelaksanaan Kegiatan
                                    </div>
                                </div>
                                <ul class="gantt__row-bars">
                                    @if (!empty($dekon->pelaksanaan_kegiatan_a && $dekon->pelaksanaan_kegiatan_b))
                                        <li data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pelaksanaan_kegiatan_a)->format('j M Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pelaksanaan_kegiatan_b)->format('j M Y') }}" style="grid-column: 
                                            {{ (!empty($dekon->pelaksanaan_kegiatan_a )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pelaksanaan_kegiatan_a)->format('m')) : null }}  /
                                            {{ (!empty($dekon->pelaksanaan_kegiatan_b )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pelaksanaan_kegiatan_b)->format('m')) : null }}">
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            
                            {{-- pembinaan_monitoring_a --}}
                            <div class="gantt__row {{(!empty($dekon->pembinaan_monitoring_a && $dekon->pembinaan_monitoring_b)) ?  : 'gantt__row--empty'  }}">
                                <div class="gantt__row-first">
                                    <div class="keterangan" style="text-align: left; padding-left:15px">
                                        Pembinaan dan Monitoring
                                    </div>
                                </div>
                                <ul class="gantt__row-bars">
                                    @if (!empty($dekon->pembinaan_monitoring_a && $dekon->pembinaan_monitoring_b))
                                        <li data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pembinaan_monitoring_a)->format('j M Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pembinaan_monitoring_b)->format('j M Y') }}" style="grid-column: 
                                            {{ (!empty($dekon->pembinaan_monitoring_a )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pembinaan_monitoring_a)->format('m')) : null }}  /
                                            {{ (!empty($dekon->pembinaan_monitoring_b )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pembinaan_monitoring_b)->format('m')) : null }}">
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            
                            {{-- pelaporan_a --}}
                            <div class="gantt__row {{(!empty($dekon->pelaporan_a && $dekon->pelaporan_b)) ?  : 'gantt__row--empty'  }}">
                                <div class="gantt__row-first">
                                    <div class="keterangan" style="text-align: left; padding-left:15px">
                                        Pelaporan
                                    </div>
                                </div>
                                <ul class="gantt__row-bars">
                                    @if (!empty($dekon->pelaporan_a && $dekon->pelaporan_b))
                                        <li data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pelaporan_a)->format('j M Y') }} - {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pelaporan_b)->format('j M Y') }}" style="grid-column: 
                                            {{ (!empty($dekon->pelaporan_a )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pelaporan_a)->format('m')) : null }}  /
                                            {{ (!empty($dekon->pelaporan_b )) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $dekon->pelaporan_b)->format('m')) : null }}">
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
            </div>
        </div>
    </div>

<!-- /.MultiStep Form -->
@endsection

@push('script')

    <script src="/vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="/vendor/jquery-steps/jquery.form-wizard.init.js"></script>
	
    {{-- Search Select  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
        });
    });
    </script>
@endpush