@extends('dashboard.layouts.main')

@section('container')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">
@endpush

<!-- MultiStep Form -->

<section class="section">
    <div class="section-header">
        <div class="media-body">
            <div class="media-title"><h1><i class="fa fa-cog"></i> {{ $title }}</h1></div>
            @can('pusat')
            <span class="text-muted"></span>
            @endcan
            @can('provinsi')
            <span class="text-muted">Provinsi<div class="bullet"></div> <span class="text-primary">{{$provinsi_auth->name}}</span></span>
            @endcan
        </div>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="/dashboard">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="/dashboard/uph">UPH</a></div>
        <div class="breadcrumb-item">{{ $title }}</div>
      </div>
    </div>
  </section>


    <!-- row -->
    <div class="card card-primary shadow mb-4">
        <div class="col-lg-10">
            
            <div class="card-body mt-3">

                    <form id="form-vertical" class="form-horizontal form-wizard-wrapper" action="/dashboard/uph" method="post" novalidate enctype="multipart/form-data">   
                        @csrf
                        
                        <h3>Data Penerima</h3>
                        <fieldset>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Kelompok</label>
                                <input id="nama" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"  value="{{ old('nama') }}" autofocus>
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input id="alamat" name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"  value="{{ old('alamat') }}" autofocus>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <select class="form-control" id="provinsi" name="provinsi_id" value="{{ old('provinsi_id') }}" required>
                                    <option>Pilih Provinsi.....</option>
                                    @foreach ($provinces as $provinsi)
                                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                    @endforeach
                                </select>
                                @error('provinsi_id')<div class="small-text">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="kabupaten">Kabupaten/Kota</label>
                                <select class="form-control" id="kabupaten" name="kabupaten_id" value="{{ old('kabupaten_id') }}" required>
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan_id" value="{{ old('kecamatan_id') }}" required>
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="desa">Kelurahan/Desa</label>
                                <select class="form-control" id="desa" name="desa_id" value="{{ old('desa_id') }}" required>
                                    
                                </select>
                            </div>
                            
                            
                        </fieldset>

                        <h3>Data Bantuan</h3>
                        <fieldset>
                            <div class="mb-3">
                                <label for="komoditi" class="form-label">Jenis Komoditi dan Produk Olahan</label>
                                <select class="form-control" id="komoditi" name="komoditi" value="{{ old('komoditi') }}" required>
                                    <option>Pilih Komoditi & Produk Olahan.....</option>
                                    <option value="Pengolahan Daging">Pengolahan Daging</option>
                                    <option value="Pengolahan Telur">Pengolahan Telur</option>
                                    <option value="Pengolahan Susu">Pengolahan Susu</option>
                                    <option value="Pengolahan Hasil Ikutan Ternak (Pangan)">Pengolahan Hasil Ikutan Ternak (Pangan)</option>
                                    <option value="Pascapanen Hasil Ternak (Madu)">Pascapanen Hasil Ternak (Madu)</option>
                                    <option value="SBW (Sarang Burung Wallet)">SBW (Sarang Burung Wallet)</option>
                                    <option value="Pupuk Organik">Pupuk Organik</option>
                                    <option value="Pasar Ternak">Pasar Ternak</option>
                                    <option value="Tata Niaga">Tata Niaga</option>
                                    <option value="Penguatan Pemasaran Hasil Ternak">Penguatan Pemasaran Hasil Ternak</option>
                                </select>
                                @error('komoditi')<div class="small-text">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="banper" class="form-label">Bantuan Pemerintah</label>
                                <input id="banper" name="banper" type="text" class="form-control @error('banper') is-invalid @enderror"  value="{{ old('banper') }}" autofocus>
                                @error('banper') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tahun_bantuan" class="form-label">Tahun Bantuan</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input id="tahun_bantuan" name="tahun_bantuan" type="text" class="form-control @error('tahun_bantuan') is-invalid @enderror"  value="{{ old('tahun_bantuan') }}" autofocus>
                                </div>
                                @error('tahun_bantuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            {{-- <div class="mb-3">
                                <label for="tahun_bantuan" class="form-label">Tahun Bantuan</label>
                                <input type="month" id="tahun_bantuan" name="tahun_bantuan" class="form-control @error('tahun_bantuan') is-invalid @enderror" value="{{ old('tahun_bantuan') }}">
                                @error('tahun_bantuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div> --}}
                            {{-- <div class="mb-3">
                                <label for="jenis_bantuan" class="form-label">Jenis Bantuan</label>
                                <input id="jenis_bantuan" name="jenis_bantuan" type="text" class="form-control @error('jenis_bantuan') is-invalid @enderror"  value="{{ old('jenis_bantuan') }}" autofocus>
                                @error('jenis_bantuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div> --}}
                            <label for="jenis_bantuan" class="form-label">Jenis Bantuan</label>
                                <select class="form-control" id="jenis_bantuan" name="jenis_bantuan" value="{{ old('jenis_bantuan') }}" required>
                                    <option>Pilih Jenis Bantuan.....</option>
                                    <option value="TP">TP</option>
                                    <option value="Dekon">Dekon</option>
                                    <option value="Anggaran">Anggaran</option>
                                </select>
                                @error('jenis_bantuan')<div class="small-text">{{ $message }}</div>@enderror

                            <a href="/dashboard/uph" type="submit" class="btn mt-5" style="background-color: #bfc6cd">Cancel</a>
                            <button type="submit" class="btn btn-primary mt-5">Input Data</button>
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

    {{-- <script src="/js/indoregional.js"></script> --}}
    <script>
        //MENAMPILKAN KABUPATEN
        $(function() {
            $('#provinsi').on('change',function(){
                let id_provinsi = $('#provinsi').val();
        
                // console.log(id_provinsi);
                $.ajax({
                    type : 'POST',
                    url : "{{ route('getkabupaten') }}",
                    data : {id_provinsi:id_provinsi},
                    cache : false,

                    success: function(msg){
                        $('#kabupaten').html(msg);
                        $('#kecamatan').html('');
                        $('#desa').html('');
                    },
                    error: function(data){
                        console.log('error:', data)
                    },
                })
                
            })
        })

        //MENAMPILKAN KECAMATAN
        $(function() {
            $('#kabupaten').on('change',function(){
                let id_kabupaten = $('#kabupaten').val();
        
                $.ajax({
                    type : 'POST',
                    url : "{{ route('getkecamatan') }}",
                    data : {id_kabupaten:id_kabupaten},
                    cache : false,

                    success: function(msg){
                        $('#kecamatan').html(msg);
                        $('#desa').html('');
                    },
                    error: function(data){
                        console.log('error:', data)
                    },
                })
                
            })
        })
        
        //MENAMPILKAN DESA
        $(function() {
            $('#kecamatan').on('change',function(){
                let id_kecamatan = $('#kecamatan').val();
        
                $.ajax({
                    type : 'POST',
                    url : "{{ route('getdesa') }}",
                    data : {id_kecamatan:id_kecamatan},
                    cache : false,

                    success: function(msg){
                        $('#desa').html(msg);
                    },
                    error: function(data){
                        console.log('error:', data)
                    },
                })
                
            })
        })
    </script>

@endpush