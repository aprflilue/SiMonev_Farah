@extends('dashboard.layouts.main')

@section('container')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">

    {{-- Search Select  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

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
        <div class="breadcrumb-item"><a href="/dashboard/evaluasi">Evaluasi</a></div>
        <div class="breadcrumb-item">{{ $title }}</div>
      </div>
    </div>
</section>

    <!-- row -->
    <div class="card card-primary shadow mb-4">
        <div class="col-lg-10">
            
            <div class="card-body mt-3">

                    <form class="form-horizontal form-wizard-wrapper" action="/dashboard/evaluasi/store/{{ $id }}" method="post" novalidate enctype="multipart/form-data">   
                        @csrf
                        @method('PUT')
                        
                        <h3 style="color: #C59100; font-size: 20px">1. Data Penerima</h3>
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

                        <div class="click-next">
                            <a href="#" id="displayText" onclick="displayText()">Next</a>
                        </div>
                        <hr>
                        
                        
                        <div id="textField" style="display: none;">
                            <h3 style="color: #C59100; font-size: 20px">2. Penilaian Bangunan dan Peralatan</h3>
                            <fieldset>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <small class="text-danger">*) Wajib Diisi</small>
                                        <div class="row">
                                            <div class="col-7">
                                                <b>Parameter Penilaian BANGUNAN</b>
                                            </div>
                                            <div class="col-2">
                                                <div class="row">
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="inlineradio1"><b>Ya<small class="text-danger"> *</small></b></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="inlineradio2"><b>Tidak<small class="text-danger"> *</small></b></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <b>Keterangan</b>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                1. Apakah bangunan sesuai spesifikasi awal yang diajukan?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="A1" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="A1" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_A1" name="ket_A1" type="text" class="form-control form-control-sm @error('ket_A1') is-invalid @enderror"  value="{{ old('ket_A1') }}" autofocus>
                                            </div>
                                        </div>    
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                2. Apakah bangunan bisa dimanfaatkan?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="A2" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="A2" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_A2" name="ket_A2" type="text" class="form-control form-control-sm @error('ket_A2') is-invalid @enderror"  value="{{ old('ket_A2') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                3. Apakah bangunan bisa dimanfaatkan berkelanjutan (digunakan untuk tahun depan dst)?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="A3" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="A3" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_A3" name="ket_A3" type="text" class="form-control form-control-sm @error('ket_A3') is-invalid @enderror"  value="{{ old('ket_A3') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                4. Apakah membutuhkan bangunan yang diperlukan ke depannya (apabila bangunan yang diperlukan masih belum ada)?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="A4" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="A4" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_A4" name="ket_A4" type="text" class="form-control form-control-sm @error('ket_A4') is-invalid @enderror"  value="{{ old('ket_A4') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                                <ul class="list-group list-group-flush">
                                
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                <b>Parameter Penilaian PERLENGKAPAN </b>
                                            </div>
                                            <div class="col-2">
                                                <div class="row">
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="inlineradio1"><b>Ya <small class="text-danger">*</small></b></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="inlineradio2"><b>Tidak <small class="text-danger">*</small></b></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <b>Keterangan</b> 
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                1. Apakah bangunan sesuai spesifikasi awal yang diajukan?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B1" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B1" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_B1" name="ket_B1" type="text" class="form-control form-control-sm @error('ket_B1') is-invalid @enderror"  value="{{ old('ket_B1') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                2. Apakah bangunan bisa dimanfaatkan?
                                            </div>
                                            <div class="col-2">
                                                <div class="row  mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B2" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B2" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_B2" name="ket_B2" type="text" class="form-control form-control-sm @error('ket_B2') is-invalid @enderror"  value="{{ old('ket_B2') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                3. Apakah bangunan bisa dimanfaatkan berkelanjutan (digunakan untuk tahun depan dst)?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B3" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B3" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_B3" name="ket_B3" type="text" class="form-control form-control-sm @error('ket_B3') is-invalid @enderror"  value="{{ old('ket_B3') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                4. Apakah membutuhkan bangunan yang diperlukan ke depannya (apabila bangunan yang diperlukan masih belum ada)?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B4" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B4" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_B4" name="ket_B4" type="text" class="form-control form-control-sm @error('ket_B4') is-invalid @enderror"  value="{{ old('ket_B4') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                5. Apakah bangunan sesuai spesifikasi awal yang diajukan?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B5" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B5" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_B5" name="ket_B5" type="text" class="form-control form-control-sm @error('ket_B5') is-invalid @enderror"  value="{{ old('ket_B5') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                6. Apakah bangunan bisa dimanfaatkan?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B6" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B6" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_B6" name="ket_B6" type="text" class="form-control form-control-sm @error('ket_B6') is-invalid @enderror"  value="{{ old('ket_B6') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                7. Apakah bangunan bisa dimanfaatkan berkelanjutan (digunakan untuk tahun depan dst)?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B7" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B7" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_B7" name="ket_B7" type="text" class="form-control form-control-sm @error('ket_B7') is-invalid @enderror"  value="{{ old('ket_B7') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-7">
                                                8. Apakah membutuhkan bangunan yang diperlukan ke depannya (apabila bangunan yang diperlukan masih belum ada)?
                                            </div>
                                            <div class="col-2">
                                                <div class="row mt-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B8" value="1">
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="B8" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input id="ket_B8" name="ket_B8" type="text" class="form-control form-control-sm @error('ket_B8') is-invalid @enderror"  value="{{ old('ket_B8') }}" autofocus>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="foto_bast" class="form-label">Fotocopy BAST</label>
                                            <input id="foto_bast" name="foto_bast" type="file" class="dropify @error('foto_bast') is-invalid @enderror">
                                            @error('foto_bast')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="foto_bangunan" class="form-label">Foto Bangunan</label>
                                            <input id="foto_bangunan" name="foto_bangunan" type="file" class="dropify @error('foto_bangunan') is-invalid @enderror">
                                            @error('foto_bangunan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="foto_peralatan" class="form-label">Foto Peralatan</label>
                                            <input id="foto_peralatan" name="foto_peralatan" type="file" class="dropify @error('foto_peralatan') is-invalid @enderror">
                                            @error('foto_peralatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="click-next">
                                <a href="#" id="display2Text" onclick="display2Text()">Next</a>
                            </div>
                            <hr>
                        </div>
                        
                        <div id="text2Field" style="display: none;">
                            <h3 style="color: #C59100; font-size: 20px">3. Indikator Keberhasilan</h3>
                            <fieldset>
                                <div class="row">
                                    <div class="col-6">

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item" style="font-size: 18px"><b>-- Sebelum Difasilitasi --</b></li>
                                        </ul><br>
        
                                        <div class="form-group">
                                            <label for="inputPassword5">Produksi per bulan</label>
                                            <div class="input-group mb-3">                                    
                                                <input id="produksi" name="produksi" type="text" class="form-control @error('produksi') is-invalid @enderror" value="{{ old('produksi') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">/ton atau /liter</span>
                                                </div>
                                                @error('produksi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="inputPassword5">Pendapatan per buah/kemasan</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input id="harga" name="harga" type="text" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
                                                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="inputPassword5">Pendapatan per bulan</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input id="pendapatan" name="pendapatan" type="text" class="form-control @error('pendapatan') is-invalid @enderror" value="{{ old('pendapatan') }}">
                                                    @error('pendapatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Akses Pasar</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="akses_pasar" value="Antar Kec">
                                                        <label class="form-check-label">Antar Kec</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="akses_pasar" value="Antar Kab">
                                                        <label class="form-check-label">Antar Kab</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="akses_pasar" value="Antar Prov">
                                                        <label class="form-check-label">Antar Prov</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="akses_pasar" value="Ekspor">
                                                        <label class="form-check-label">Ekspor</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Sertifikat</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sertifikat" value="NKV">
                                                        <label class="form-check-label">NKV</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sertifikat" value="Halal">
                                                        <label class="form-check-label">Halal</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sertifikat" value="Organik">
                                                        <label class="form-check-label">Organik</label>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Izin Edar</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="izin_edar" value="Belum Ada">
                                                        <label class="form-check-label">Belum Ada</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="izin_edar" value="Ada">
                                                        <label class="form-check-label">Ada</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Jenis Izin</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jenis_izin" value="PIRT">
                                                        <label class="form-check-label">PIRT</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jenis_izin" value="MD">
                                                        <label class="form-check-label">MD</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jenis_izin" value="NA">
                                                        <label class="form-check-label">NA</label>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item" style="font-size: 18px"><b>-- Sesudah Difasilitasi --</b></li>
                                        </ul><br>
        
                                        <div class="form-group">
                                            <label for="inputPassword5">Produksi per bulan</label>
                                            <div class="input-group mb-3">                                    
                                                <input id="produksi_af" name="produksi_af" type="text" class="form-control @error('produksi_af') is-invalid @enderror" value="{{ old('produksi_af') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">/ton atau /liter</span>
                                                </div>
                                                @error('produksi_af') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="inputPassword5">Pendapatan per buah/kemasan</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input id="harga_af" name="harga_af" type="text" class="form-control @error('harga_af') is-invalid @enderror" value="{{ old('harga_af') }}">
                                                    @error('harga_af') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="inputPassword5">Pendapatan per bulan</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                    </div>
                                                    <input id="pendapatan_af" name="pendapatan_af" type="text" class="form-control @error('pendapatan_af') is-invalid @enderror" value="{{ old('pendapatan_af') }}">
                                                    @error('pendapatan_af') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Akses Pasar</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="akses_pasar_af" value="Antar Kec">
                                                        <label class="form-check-label">Antar Kec</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="akses_pasar_af" value="Antar Kab">
                                                        <label class="form-check-label">Antar Kab</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="akses_pasar_af" value="Antar Prov">
                                                        <label class="form-check-label">Antar Prov</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="akses_pasar_af" value="Ekspor">
                                                        <label class="form-check-label">Ekspor</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Sertifikat</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sertifikat_af" value="NKV">
                                                        <label class="form-check-label">NKV</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sertifikat_af" value="Halal">
                                                        <label class="form-check-label">Halal</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sertifikat_af" value="Organik">
                                                        <label class="form-check-label">Organik</label>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Izin Edar</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="izin_edar_af" value="Belum Ada">
                                                        <label class="form-check-label">Belum Ada</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="izin_edar_af" value="Ada">
                                                        <label class="form-check-label">Ada</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Jenis Izin</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jenis_izin_af" value="PIRT">
                                                        <label class="form-check-label">PIRT</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jenis_izin_af" value="MD">
                                                        <label class="form-check-label">MD</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jenis_izin_af" value="NA">
                                                        <label class="form-check-label">NA</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/dashboard/evaluasi" type="submit" class="btn mt-2" style="background-color: #bfc6cd">Cancel</a>
                                <button type="submit" class="btn btn-primary mt-2">Input Data</button>
                            </fieldset>
                        </div>
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

    {{-- Display Text  --}}
    <script>
        $(document).ready(function(){
            $("#displayText").click(function(){      
                $("#textField").show();
                $("#displayText").hide();
            });
        });
        
        $(document).ready(function(){
            $("#display2Text").click(function(){      
                $("#text2Field").show();
                $("#display2Text").hide();
            });
        });
    </script>

     {{-- Dropify form input  --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script>
         $('.dropify').dropify();
     </script>

@endpush