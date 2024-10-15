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
                <div class="breadcrumb-item"><a href="/dashboard/laporan_evaluasi">Laporan Evaluasi</a></div>
                <div class="breadcrumb-item">View</div>
            </div>
        </div>
    </section>

    <!-- row -->
    <div class="card card-primary shadow mb-4">
        <div class="col-lg-10">
            
            <div class="card-body mt-3">
                
                        <h3 style="color: #C59100; font-size: 20px">Data Kelompok</h3><br>
                        <fieldset>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5"><label><b>Provinsi</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $evaluasi->provinsi_name }}</div>
                                        
                                        <div class="col-5"><label><b>Nama Kelompok</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $evaluasi->nama }}</div>
                                        
                                        <div class="col-5"><label><b>Komoditi</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $evaluasi->komoditi }}</div>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="row">
                                        
                                        <div class="col-5"><label><b>Tahun</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $evaluasi->tahun_bantuan }}</div>
                                        
                                        <div class="col-5"><label><b>Jenis Bantuan</b></label></div>
                                        <div class="col-1">:</div>
                                        
                                        @if ($evaluasi->jenis_bantuan == 'TP')
                                        <div class="col-6" style="color: #009b24"><b>TP</b></div>
                                        @elseif($evaluasi->jenis_bantuan == 'Dekon')
                                        <div class="col-6" style="color: #003cbd"><b>Dekon</b></div>
                                        @elseif($evaluasi->jenis_bantuan == 'Anggaran')
                                        <div class="col-6" style="color: #ee9b00"><b>Anggaran</b></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    
                    <br><hr>
                        <h3 style="color: #C59100; font-size: 20px">Penilaian Bangunan dan Peralatan</h3><br>
                        <fieldset>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-7">
                                            <b>Parameter Penilaian BANGUNAN</b>
                                        </div>
                                        <div class="col-2">
                                            <div class="row">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineradio1"><b>Ya</b></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineradio2"><b>Tidak</b></label>
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
                                                    <input class="form-check-input" type="radio" name="A1" value="1" @if($evaluasi->A1 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="A1" value="0" @if($evaluasi->A1 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_A1" name="ket_A1" type="text" class="form-control form-control-sm @error('ket_A1') is-invalid @enderror"  value="{{ old('ket_A1', $evaluasi->ket_A1) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="A2" value="1" @if($evaluasi->A2 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="A2" value="0" @if($evaluasi->A2 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_A2" name="ket_A2" type="text" class="form-control form-control-sm @error('ket_A2') is-invalid @enderror"  value="{{ old('ket_A2', $evaluasi->ket_A2) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="A3" value="1" @if($evaluasi->A3 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="A3" value="0" @if($evaluasi->A3 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_A3" name="ket_A3" type="text" class="form-control form-control-sm @error('ket_A3') is-invalid @enderror"  value="{{ old('ket_A3', $evaluasi->ket_A3) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="A4" value="1" @if($evaluasi->A4 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="A4" value="0" @if($evaluasi->A4 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_A4" name="ket_A4" type="text" class="form-control form-control-sm @error('ket_A4') is-invalid @enderror"  value="{{ old('ket_A4', $evaluasi->ket_A4) }}" readonly>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <ul class="list-group list-group-flush">
                            
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-7">
                                            <b>Parameter Penilaian PERLENGKAPAN</b>
                                        </div>
                                        <div class="col-2">
                                            <div class="row">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineradio1"><b>Ya</b></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineradio2"><b>Tidak</b></label>
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
                                                    <input class="form-check-input" type="radio" name="B1" value="1" @if($evaluasi->B1 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="B1" value="0" @if($evaluasi->B1 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_B1" name="ket_B1" type="text" class="form-control form-control-sm @error('ket_B1') is-invalid @enderror"  value="{{ old('ket_B1', $evaluasi->ket_B1) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="B2" value="1" @if($evaluasi->B2 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="B2" value="0" @if($evaluasi->B2 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_B2" name="ket_B2" type="text" class="form-control form-control-sm @error('ket_B2') is-invalid @enderror"  value="{{ old('ket_B2', $evaluasi->ket_B2) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="B3" value="1" @if($evaluasi->B3 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="B3" value="0" @if($evaluasi->B3 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_B3" name="ket_B3" type="text" class="form-control form-control-sm @error('ket_B3') is-invalid @enderror"  value="{{ old('ket_B3', $evaluasi->ket_B3) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="B4" value="1" @if($evaluasi->B4 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="B4" value="0" @if($evaluasi->B4 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_B4" name="ket_B4" type="text" class="form-control form-control-sm @error('ket_B4') is-invalid @enderror"  value="{{ old('ket_B4', $evaluasi->ket_B4) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="B5" value="1" @if($evaluasi->B5 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="B5" value="0" @if($evaluasi->B5 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_B5" name="ket_B5" type="text" class="form-control form-control-sm @error('ket_B5') is-invalid @enderror"  value="{{ old('ket_B5', $evaluasi->ket_B5) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="B6" value="1" @if($evaluasi->B6 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="B6" value="0" @if($evaluasi->B6 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_B6" name="ket_B6" type="text" class="form-control form-control-sm @error('ket_B6') is-invalid @enderror"  value="{{ old('ket_B6', $evaluasi->ket_B6) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="B7" value="1" @if($evaluasi->B7 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="B7" value="0" @if($evaluasi->B7 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_B7" name="ket_B7" type="text" class="form-control form-control-sm @error('ket_B7') is-invalid @enderror"  value="{{ old('ket_B7', $evaluasi->ket_B7) }}" readonly>
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
                                                    <input class="form-check-input" type="radio" name="B8" value="1" @if($evaluasi->B8 == 1) checked @endif disabled>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="B8" value="0" @if($evaluasi->B8 == 0) checked @endif disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <input id="ket_B8" name="ket_B8" type="text" class="form-control form-control-sm @error('ket_B8') is-invalid @enderror"  value="{{ old('ket_B8', $evaluasi->ket_B8) }}" readonly>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="row mt-2">
                                <div class="col-4">
                                    <div class="col-12"><label><b>Fotocopy BAST</b></label></div>
                                        @if (in_array($extension = pathinfo($evaluasi->foto_bast, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                            <div class="col-7"><a href="/storage/{{ $evaluasi->foto_bast }}"  target="_blank"><img src="{{ asset('storage/' . $evaluasi->foto_bast) }}" class="evaluasi" alt=""></a></div>
                                        @elseif (in_array($extension = pathinfo($evaluasi->foto_bast, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                            <div class="col-7"><a href="/storage/{{ $evaluasi->foto_bast }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="evaluasi" alt=""></a></div>
                                        @else
                                            <div class="col-7"><p class="text-danger">___No File___</p></div>
                                        @endif

                                </div>
                                <div class="col-4">
                                    <div class="col-12"><label><b>Foto Bangunan</b></label></div>
                                        @if (in_array($extension = pathinfo($evaluasi->foto_peralatan, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                            <div class="col-7"><a href="/storage/{{ $evaluasi->foto_bangunan }}"  target="_blank"><img src="{{ asset('storage/' . $evaluasi->foto_bangunan) }}" class="evaluasi" alt=""></a></div>
                                        @elseif (in_array($extension = pathinfo($evaluasi->foto_bangunan, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                            <div class="col-7"><a href="/storage/{{ $evaluasi->foto_bangunan }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="evaluasi" alt=""></a></div>
                                        @else
                                            <div class="col-7"><p class="text-danger">___No File___</p></div>
                                        @endif
                                </div>
                                <div class="col-4">
                                    <div class="col-12"><label><b>Foto Peralatan</b></label></div>
                                        @if (in_array($extension = pathinfo($evaluasi->foto_peralatan, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                            <div class="col-7"><a href="/storage/{{ $evaluasi->foto_peralatan }}"  target="_blank"><img src="{{ asset('storage/' . $evaluasi->foto_peralatan) }}" class="evaluasi" alt=""></a></div>
                                        @elseif (in_array($extension = pathinfo($evaluasi->foto_peralatan, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                            <div class="col-7"><a href="/storage/{{ $evaluasi->foto_peralatan }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="evaluasi" alt=""></a></div>
                                        @else
                                            <div class="col-7"><p class="text-danger">___No File___</p></div>
                                        @endif
                                </div>
                            </div>
                        </fieldset>

                        <br><hr>
                        <h3 style="color: #C59100; font-size: 20px">Indikator Keberhasilan</h3><br>
                        <fieldset>
                            <div class="row">
                                <div class="col-6">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item" style="font-size: 18px"><b>-- Sebelum Difasilitasi --</b></li>
                                    </ul><br>
    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-5"><label><b>Produksi per bulan</b></label></div>
                                            <div class="col-1">:</div>
                                            <div class="col-6"><p>{{ (!empty($evaluasi->produksi)) ? $evaluasi->produksi : '___' }} /ton , /liter</p></div>
                                            
                                            <div class="col-5"><label><b>Pendapatan per buah/kemasan</b></label></div>
                                            <div class="col-1">:</div>
                                            <div class="col-6"><p>Rp. {{ (!empty($evaluasi->harga)) ? number_format($evaluasi->harga, 0, ',', '.') : '___' }}</p></div>
                                            
                                            <div class="col-5"><label><b>Pendapatan per bulan</b></label></div>
                                            <div class="col-1">:</div>
                                            <div class="col-6"><p>Rp. {{ (!empty($evaluasi->pendapatan)) ? number_format($evaluasi->pendapatan, 0, ',', '.') : '___' }}</p></div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Akses Pasar</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="akses_pasar" value="Antar Kec" @if($evaluasi->akses_pasar == "Antar Kec") checked @endif disabled>
                                                    <label class="form-check-label">Antar Kec</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="akses_pasar" value="Antar Kab" @if($evaluasi->akses_pasar == "Antar Kab") checked @endif disabled>
                                                    <label class="form-check-label">Antar Kab</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="akses_pasar" value="Antar Prov" @if($evaluasi->akses_pasar == "Antar Prov") checked @endif disabled>
                                                    <label class="form-check-label">Antar Prov</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="akses_pasar" value="Ekspor" @if($evaluasi->akses_pasar == "Ekspor") checked @endif disabled>
                                                    <label class="form-check-label">Ekspor</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Sertifikat</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sertifikat" value="NKV" @if($evaluasi->sertifikat == "NKV") checked @endif disabled>
                                                    <label class="form-check-label">NKV</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sertifikat" value="Halal" @if($evaluasi->sertifikat == "Halal") checked @endif disabled>
                                                    <label class="form-check-label">Halal</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sertifikat" value="Organik" @if($evaluasi->sertifikat == "Organik") checked @endif disabled>
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
                                                    <input class="form-check-input" type="radio" name="izin_edar" value="Belum Ada" @if($evaluasi->izin_edar == "Belum Ada") checked @endif disabled>
                                                    <label class="form-check-label">Belum Ada</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="izin_edar" value="Ada" @if($evaluasi->izin_edar == "Ada") checked @endif disabled>
                                                    <label class="form-check-label">Ada</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Jenis Izin</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_izin" value="PIRT" @if($evaluasi->jenis_izin == "PIRT") checked @endif disabled>
                                                    <label class="form-check-label">PIRT</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_izin" value="MD" @if($evaluasi->jenis_izin == "MD") checked @endif disabled>
                                                    <label class="form-check-label">MD</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_izin" value="NA" @if($evaluasi->jenis_izin == "NA") checked @endif disabled>
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
                                        <div class="row">
                                            <div class="col-5"><label><b>Produksi per bulan</b></label></div>
                                            <div class="col-1">:</div>
                                            <div class="col-6"><p>{{ (!empty($evaluasi->produksi_af)) ? $evaluasi->produksi_af : '___' }} /ton , /liter</p></div>
                                            
                                            <div class="col-5"><label><b>Pendapatan per buah/kemasan</b></label></div>
                                            <div class="col-1">:</div>
                                            <div class="col-6"><p>Rp. {{ (!empty($evaluasi->harga_af)) ? number_format($evaluasi->harga_af, 0, ',', '.') : '___' }}</p></div>
                                            
                                            <div class="col-5"><label><b>Pendapatan per bulan</b></label></div>
                                            <div class="col-1">:</div>
                                            <div class="col-6"><p>Rp. {{ (!empty($evaluasi->pendapatan_af)) ? number_format($evaluasi->pendapatan_af, 0, ',', '.') : '___' }}</p></div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Akses Pasar</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="akses_pasar_af" value="Antar Kec" @if($evaluasi->akses_pasar_af == "Antar Kec") checked @endif disabled>
                                                    <label class="form-check-label">Antar Kec</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="akses_pasar_af" value="Antar Kab" @if($evaluasi->akses_pasar_af == "Antar Kab") checked @endif disabled>
                                                    <label class="form-check-label">Antar Kab</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="akses_pasar_af" value="Antar Prov" @if($evaluasi->akses_pasar_af == "Antar Prov") checked @endif disabled>
                                                    <label class="form-check-label">Antar Prov</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="akses_pasar_af" value="Ekspor" @if($evaluasi->akses_pasar_af == "Ekspor") checked @endif disabled>
                                                    <label class="form-check-label">Ekspor</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Sertifikat</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sertifikat_af" value="NKV" @if($evaluasi->sertifikat_af == "NKV") checked @endif disabled>
                                                    <label class="form-check-label">NKV</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sertifikat_af" value="Halal" @if($evaluasi->sertifikat_af == "Halal") checked @endif disabled>
                                                    <label class="form-check-label">Halal</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sertifikat_af" value="Organik" @if($evaluasi->sertifikat_af == "Organik") checked @endif disabled>
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
                                                    <input class="form-check-input" type="radio" name="izin_edar_af" value="Belum Ada" @if($evaluasi->izin_edar_af == "Belum Ada") checked @endif disabled>
                                                    <label class="form-check-label">Belum Ada</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="izin_edar_af" value="Ada" @if($evaluasi->izin_edar_af == "Ada") checked @endif disabled>
                                                    <label class="form-check-label">Ada</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Jenis Izin</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_izin_af" value="PIRT" @if($evaluasi->jenis_izin_af == "PIRT") checked @endif disabled>
                                                    <label class="form-check-label">PIRT</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_izin_af" value="MD" @if($evaluasi->jenis_izin_af == "MD") checked @endif disabled>
                                                    <label class="form-check-label">MD</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_izin_af" value="NA" @if($evaluasi->jenis_izin_af == "NA") checked @endif disabled>
                                                    <label class="form-check-label">NA</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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