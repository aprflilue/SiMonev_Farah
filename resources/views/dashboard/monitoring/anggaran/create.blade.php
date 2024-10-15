@extends('dashboard.layouts.main')

@section('container')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">
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
                <div class="breadcrumb-item"><a href="/dashboard/anggaran">Monitoring Anggaran</a></div>
                <div class="breadcrumb-item">Input Anggaran</div>
            </div>
        </div>
    </section>

    <!-- row -->
    <div class="card card-primary shadow mb-4">
        <div class="col-lg-10">
            
            <div class="card-body mt-3">

                    <form id="form-vertical" class="form-horizontal form-wizard-wrapper" action="/dashboard/anggaran/store/{{ $id }}" method="post" novalidate enctype="multipart/form-data">   
                        @csrf
                        @method('PUT')

                        <h3>Data Lokasi</h3>
                        <fieldset>
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

                        <h3>Laporan Realisasi</h3>
                        <fieldset>
                            
                            <div class="form-group">
                                <label for="kegiatan">Kegiatan</label>
                                <input id="kegiatan" name="kegiatan" type="text" class="form-control @error('kegiatan') is-invalid @enderror"  value="{{ old('kegiatan') }}" autofocus>
                                @error('kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="volume">Volume</label>
                                <div class="input-group mb-3">                                    
                                    <input id="volume" name="volume" type="text" class="form-control @error('volume') is-invalid @enderror" value="{{ old('volume') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Unit</span>
                                    </div>
                                    @error('volume') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pagu">Pagu</label>
                                <div class="input-group mb-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Rp</span>
                                        </div>
                                        <input id="pagu" name="pagu" type="text" class="form-control @error('pagu') is-invalid @enderror" value="{{ old('pagu') }}">
                                        @error('pagu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rel_keuangan">Realisasi Keuangan</label>
                                <div class="input-group mb-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Rp</span>
                                        </div>
                                        <input id="rel_keuangan" name="rel_keuangan" type="text" class="form-control @error('rel_keuangan') is-invalid @enderror" value="{{ old('rel_keuangan') }}">
                                        @error('rel_keuangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="rel_keuangan_persen">Realisasi Keuangan</label>
                                <div class="input-group mb-3">                                    
                                    <input id="rel_keuangan_persen" name="rel_keuangan_persen" type="text" class="form-control @error('rel_keuangan_persen') is-invalid @enderror" value="{{ old('rel_keuangan_persen') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('rel_keuangan_persen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rel_fisik_persen">Realisasi Fisik</label>
                                <div class="input-group mb-3">                                    
                                    <input id="rel_fisik_persen" name="rel_fisik_persen" type="text" class="form-control @error('rel_fisik_persen') is-invalid @enderror" value="{{ old('rel_fisik_persen') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('rel_fisik_persen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="progres" class="form-label">Progress/Keterangan</label>
                                <input id="progres" name="progres" type="text" class="form-control @error('progres') is-invalid @enderror"  value="{{ old('progres') }}" autofocus>
                                @error('progres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="kendala" class="form-label">Kendala</label>
                                <input id="kendala" name="kendala" type="text" class="form-control @error('kendala') is-invalid @enderror"  value="{{ old('kendala') }}" autofocus>
                                @error('kendala') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="tindakan" class="form-label">Tindakan</label>
                                <input id="tindakan" name="tindakan" type="text" class="form-control @error('tindakan') is-invalid @enderror"  value="{{ old('tindakan') }}" autofocus>
                                @error('tindakan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="file_upload" class="form-label">Upload Foto/Video</label>
                                <input id="file_upload" name="file_upload" type="file" class="form-control @error('file_upload') is-invalid @enderror">
                                @error('file_upload')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <a href="/dashboard/anggaran" type="submit" class="btn mt-2" style="background-color: #bfc6cd">Cancel</a>
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
	
@endpush