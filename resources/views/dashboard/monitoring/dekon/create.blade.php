@extends('dashboard.layouts.main')

@section('container')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">
    {{-- Search Select  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
@endpush

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
                <div class="breadcrumb-item"><a href="/dashboard/dekon">Monitoring Dekon</a></div>
                <div class="breadcrumb-item">Input Dekon</div>
            </div>
        </div>
    </section>

    <!-- row -->
    <div class="card card-primary shadow mb-4">
        <div class="col-lg-10">
            
            <div class="card-body mt-3">

                <form id="form-vertical" class="form-horizontal form-wizard-wrapper" action="/dashboard/dekon/store/{{ $id }}" method="post" novalidate enctype="multipart/form-data">   
                    @csrf
                    @method('PUT')

                        <h3>Data Kelompok</h3>
                        <fieldset>
                            <span><small class="text-danger"><< Silahkan periksa kembali, Apakah data kelompok sudah sesuai. >></small></span>
                            <div class="mb-3">
                                <label for="data_kelompok_id" class="form-label">Nama Kelompok</label>
                                <input name="data_kelompok_id" type="text" class="form-control"  placeholder="@foreach($data_kelompok as $data) {{ $data->nama }} @endforeach" readonly>
                            </div>                
                            <div class="mb-3">
                                <label for="data_kelompok_id" class="form-label">Provinsi</label>
                                <input name="data_kelompok_id" type="text" class="form-control"  placeholder="@foreach($data_kelompok as $data) {{ $data->provinsi_name }} @endforeach" readonly>
                            </div>                
                            <div class="mb-3">
                                <label for="data_kelompok_id" class="form-label">Komoditi</label>
                                <input name="data_kelompok_id" type="text" class="form-control"  placeholder="@foreach($data_kelompok as $data) {{ $data->komoditi }} @endforeach" readonly>
                            </div>                
                            <div class="mb-3">
                                <label for="data_kelompok_id" class="form-label">Tahun Bantuan</label>
                                <input name="data_kelompok_id" type="text" class="form-control"  placeholder="@foreach($data_kelompok as $data) {{ $data->tahun_bantuan }} @endforeach" readonly>
                            </div>                
                        </fieldset>

                        <h3>Timeline Kegiatan</h3>
                        <fieldset>
                            <label><b>1. Persiapan Pelaksanaan</b></label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="persiapan_pelaksanaan_a" class="form-label">--Mulai--</label>
                                        <input type="date" id="persiapan_pelaksanaan_a" name="persiapan_pelaksanaan_a" class="form-control @error('persiapan_pelaksanaan_a') is-invalid @enderror" value="{{ old('persiapan_pelaksanaan_a') }}">
                                        @error('persiapan_pelaksanaan_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="persiapan_pelaksanaan_b" class="form-label">--Berakhir--</label>
                                        <input type="date" id="persiapan_pelaksanaan_b" name="persiapan_pelaksanaan_b" class="form-control @error('persiapan_pelaksanaan_b') is-invalid @enderror" value="{{ old('persiapan_pelaksanaan_b') }}">
                                        @error('persiapan_pelaksanaan_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                            </div><hr>
                            
                            <label><b>2. Sosialisasi Juknis dan Juklak</b></label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="sosialisasi_juknis_a" class="form-label">--Mulai--</label>
                                        <input type="date" id="sosialisasi_juknis_a" name="sosialisasi_juknis_a" class="form-control @error('sosialisasi_juknis_a') is-invalid @enderror" value="{{ old('sosialisasi_juknis_a') }}">
                                        @error('sosialisasi_juknis_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="sosialisasi_juknis_b" class="form-label">--Berakhir--</label>
                                        <input type="date" id="sosialisasi_juknis_b" name="sosialisasi_juknis_b" class="form-control @error('sosialisasi_juknis_b') is-invalid @enderror" value="{{ old('sosialisasi_juknis_b') }}">
                                        @error('sosialisasi_juknis_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                            </div><hr>
                           
                            <label><b>3. Koordinasi</b></label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="koordinasi_a" class="form-label">--Mulai--</label>
                                        <input type="date" id="koordinasi_a" name="koordinasi_a" class="form-control @error('koordinasi_a') is-invalid @enderror" value="{{ old('koordinasi_a') }}">
                                        @error('koordinasi_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="koordinasi_b" class="form-label">--Berakhir--</label>
                                        <input type="date" id="koordinasi_b" name="koordinasi_b" class="form-control @error('koordinasi_b') is-invalid @enderror" value="{{ old('koordinasi_b') }}">
                                        @error('koordinasi_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                            </div><hr>
                            
                            <label><b>4. Pelaksanaan Kegiatan</b></label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="pelaksanaan_kegiatan_a" class="form-label">--Mulai--</label>
                                        <input type="date" id="pelaksanaan_kegiatan_a" name="pelaksanaan_kegiatan_a" class="form-control @error('pelaksanaan_kegiatan_a') is-invalid @enderror" value="{{ old('pelaksanaan_kegiatan_a') }}">
                                        @error('pelaksanaan_kegiatan_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="pelaksanaan_kegiatan_b" class="form-label">--Berakhir--</label>
                                        <input type="date" id="pelaksanaan_kegiatan_b" name="pelaksanaan_kegiatan_b" class="form-control @error('pelaksanaan_kegiatan_b') is-invalid @enderror" value="{{ old('pelaksanaan_kegiatan_b') }}">
                                        @error('pelaksanaan_kegiatan_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                            </div><hr>
                            
                            <label><b>5. Pembinaan dan Monitoring</b></label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="pembinaan_monitoring_a" class="form-label">--Mulai--</label>
                                        <input type="date" id="pembinaan_monitoring_a" name="pembinaan_monitoring_a" class="form-control @error('pembinaan_monitoring_a') is-invalid @enderror" value="{{ old('pembinaan_monitoring_a') }}">
                                        @error('pembinaan_monitoring_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="pembinaan_monitoring_b" class="form-label">--Berakhir--</label>
                                        <input type="date" id="pembinaan_monitoring_b" name="pembinaan_monitoring_b" class="form-control @error('pembinaan_monitoring_b') is-invalid @enderror" value="{{ old('pembinaan_monitoring_b') }}">
                                        @error('pembinaan_monitoring_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                            </div><hr>
                            
                            <label><b>6. Pelaporan</b></label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="pelaporan_a" class="form-label">--Mulai--</label>
                                        <input type="date" id="pelaporan_a" name="pelaporan_a" class="form-control @error('pelaporan_a') is-invalid @enderror" value="{{ old('pelaporan_a') }}">
                                        @error('pelaporan_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="pelaporan_b" class="form-label">--Berakhir--</label>
                                        <input type="date" id="pelaporan_b" name="pelaporan_b" class="form-control @error('pelaporan_b') is-invalid @enderror" value="{{ old('pelaporan_b') }}">
                                        @error('pelaporan_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>    
                            </div><hr>

                            <a href="/dashboard/dekon" type="submit" class="btn mt-2" style="background-color: #bfc6cd">Cancel</a>
                            <button type="submit" class="btn btn-primary mt-2">Input Data</button>
                        </fieldset>
                    </form>
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