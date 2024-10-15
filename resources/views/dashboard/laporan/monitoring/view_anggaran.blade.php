@extends('dashboard.layouts.main')

@section('container')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">

    {{-- Dropify form input  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
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
                <div class="breadcrumb-item">View Anggaran</div>
            </div>
        </div>
    </section>

    <!-- row -->
    <div class="card card-primary shadow mb-4">
        <div class="col-lg-10">
            
            <div class="card-body mt-3">
                
                    {{-- @foreach ( $anggaran as $anggaran) --}}
                        <h3 style="color: #C59100; font-size: 20px">Data Kelompok</h3><br>
                        <fieldset>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5"><label><b>Provinsi</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $anggaran->name }}</div>
                                        
                                        <div class="col-5"><label><b>Nama Kelompok</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $anggaran->nama }}</div>
                                        
                                        <div class="col-5"><label><b>Komoditi</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $anggaran->komoditi }}</div>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="row">
                                
                                        <div class="col-5"><label><b>Tahun</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $anggaran->tahun_bantuan }}</div>
                                    
                                        <div class="col-5"><label><b>Jenis Bantuan</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6" style="color: #ee9b00"><b>Anggaran</b></div>
                    
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    {{-- @endforeach --}}
                    
                    <br><hr>
                        <h3 style="color: #C59100; font-size: 20px">Laporan Realisasi</h3><br>
                        <fieldset>
                            
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6"><label><b>Kegiatan</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><p>{{ (!empty($anggaran->kegiatan)) ? $anggaran->kegiatan : '___' }}</p></div>

                                        <div class="col-6"><label><b>Volume</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><p>{{ (!empty($anggaran->volume)) ? $anggaran->volume : '___' }} Unit</p></div>
                                        
                                        <div class="col-6"><label><b>Pagu</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><p>Rp. {{ (!empty($anggaran->pagu)) ? number_format($anggaran->pagu, 0, ',', '.') : '___' }}</p></div>
                                        
                                        <div class="col-6"><label><b>Realisasi Keuangan</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><p>Rp. {{ (!empty($anggaran->rel_keuangan)) ? number_format($anggaran->rel_keuangan, 0, ',', '.') : '___' }}</p></div>
                                        
                                        <div class="col-6"><label><b>Persentase Realisasi Keuangan</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><p>{{ (!empty($anggaran->rel_keuangan_persen)) ? $anggaran->rel_keuangan_persen : '___' }}%</p></div>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6"><label><b>Realisasi Fisik</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><p>{{ (!empty($anggaran->rel_fisik_persen)) ? $anggaran->rel_fisik_persen : '___' }}%</p></div>

                                        <div class="col-6"><label><b>Progress/Keterangan</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><p>{{ (!empty($anggaran->progres)) ? $anggaran->progres : '___' }}</p></div>
                                        
                                        <div class="col-6"><label><b>Kendala</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><p>{{ (!empty($anggaran->kendala)) ? $anggaran->kendala : '___' }}</p></div>
                                        
                                        <div class="col-6"><label><b>Tindakan</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-5"><p>{{ (!empty($anggaran->tindakan)) ? $anggaran->tindakan : '___' }}</p></div>
                                        
                                        <div class="col-6"><label><b>Dokumentasi</b></label></div>
                                        <div class="col-1">:</div>
                                        @if(!empty($anggaran->file_upload))
                                        <div class="col-5"><a href="/storage/{{ $anggaran->file_upload }}"  target="_blank"><img src="{{ asset('storage/' . $anggaran->file_upload) }}" style="width:300px; height:200px; object-fit:cover" alt=""></a></div>
                                        @else
                                        <div class="col-5"><p class="text-danger">___No File Upload___</p></div>
                                        @endif
                                </div>
                            </div>
                        </fieldset>
            </div>
        </div>
    </div>

<!-- /.MultiStep Form -->
@endsection

@push('script')

    <script src="/vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="/vendor/jquery-steps/jquery.form-wizard.init.js"></script>
	
@endpush