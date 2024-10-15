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
                <div class="breadcrumb-item">View TP</div>
            </div>
        </div>
    </section>

    <!-- row -->
    <div class="card card-primary shadow mb-4">
        <div class="col-lg-10">
            
            <div class="card-body mt-3">
                
                    @foreach ( $data_kelompok as $data_kelompok)
                        <h3 style="color: #C59100; font-size: 20px">Data Kelompok</h3><br>
                        <fieldset>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5"><label><b>Provinsi</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $data_kelompok->provinsi_name }}</div>
                                        
                                        <div class="col-5"><label><b>Nama Kelompok</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $data_kelompok->nama }}</div>
                                        
                                        <div class="col-5"><label><b>Komoditi</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $data_kelompok->komoditi }}</div>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="row">
                                        
                                        <div class="col-5"><label><b>Tahun</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $data_kelompok->tahun_bantuan }}</div>
                                        
                                        <div class="col-5"><label><b>Jenis Bantuan</b></label></div>
                                        <div class="col-1">:</div>
                                        <div class="col-6" style="color: #009b24"><b>TP</b></div>        
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    @endforeach
                    
                    <br><hr>
                        <h3 style="color: #C59100; font-size: 20px">Dokumen dan Laporan</h3><br>
                        <fieldset>
                            
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch ml-2 mr-3">
                                            <input type="checkbox" class="custom-control-input" name="proposal" id="proposal" value="{{ old('proposal', isset($tp) ? 'checked' : '') }}" @if($tp->proposal==1) checked @endif disabled>
                                            <label class="custom-control-label" for="proposal" id="label_proposal"><b>Proposal Fisik Scan</b></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch ml-2 mr-3">
                                            <input type="checkbox" class="custom-control-input" name="eproposal" id="eproposal" value="{{ old('eproposal', isset($tp) ? 'checked' : '') }}" @if($tp->eproposal==1) checked @endif disabled>
                                            <label class="custom-control-label" for="eproposal" id="label_eproposal"><b>E-proposal</b></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch ml-2 mr-3">
                                            <input type="checkbox" class="custom-control-input" name="uji_lab" id="uji_lab" value="{{ old('uji_lab', isset($tp) ? 'checked' : '') }}" @if($tp->uji_lab==1) checked @endif disabled>
                                            <label class="custom-control-label" for="uji_lab" id="label_uji_lab"><b>Uji Laboratorium Produk</b></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch ml-2 mr-3">
                                            <input type="checkbox" class="custom-control-input" name="pengajuan_sertif" id="pengajuan_sertif" value="{{ old('pengajuan_sertif', isset($tp) ? 'checked' : '') }}" @if($tp->pengajuan_sertif==1) checked @endif disabled>
                                            <label class="custom-control-label" for="pengajuan_sertif" id="label_pengajuan_sertif"><b>Pengajuan Sertifikasi ke LSO</b></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch ml-2 mr-3">
                                            <input type="checkbox" class="custom-control-input" name="foodgrade" id="foodgrade" value="{{ old('foodgrade', isset($tp) ? 'checked' : '') }}" @if($tp->foodgrade==1) checked @endif disabled>
                                            <label class="custom-control-label" for="foodgrade" id="label_foodgrade"><b>Peralatan Foodgrade</b></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch ml-2 mr-3">
                                            <input type="checkbox" class="custom-control-input" name="test_report" id="test_report" value="{{ old('test_report', isset($tp) ? 'checked' : '') }}" @if($tp->test_report==1) checked @endif disabled>
                                            <label class="custom-control-label" for="test_report" id="label_test_report"><b>Memiliki Test Report</b></label>
                                        </div>
                                    </div>
                                </div>
                                    
                                
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>CPCL</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->cpcl, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->cpcl }}"  target="_blank"><img src="{{ asset('storage/' . $tp->cpcl) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->cpcl, PATHINFO_EXTENSION), ['pdf', 'docs']))    
                                                <div class="col-7"><a href="/storage/{{ $tp->cpcl }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>SK Penetapan Kelompok Penerima</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->sk_penetapan, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->sk_penetapan }}"  target="_blank"><img src="{{ asset('storage/' . $tp->sk_penetapan) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->sk_penetapan, PATHINFO_EXTENSION), ['pdf', 'docs']))    
                                                <div class="col-7"><a href="/storage/{{ $tp->sk_penetapan }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>Workshop Penyusunan RKP</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->workshop, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->workshop }}"  target="_blank"><img src="{{ asset('storage/' . $tp->workshop) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->workshop, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->workshop }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
                                        
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>SPK Lelang atau LS</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->spk, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->spk }}"  target="_blank"><img src="{{ asset('storage/' . $tp->spk) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->spk, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->spk }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif                                
                                        
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>Status Penggunaan Lahan</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->status_lahan, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->status_lahan }}"  target="_blank"><img src="{{ asset('storage/' . $tp->status_lahan) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->status_lahan, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->status_lahan }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>Penyusunan SOP/Doksistu</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->penyusunan_sop, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->penyusunan_sop }}"  target="_blank"><img src="{{ asset('storage/' . $tp->penyusunan_sop) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->penyusunan_sop, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->penyusunan_sop }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>BAST sarana nomor</b></label></div>

                                            @if (in_array($extension = pathinfo($tp->bast_sarana, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->bast_sarana }}"  target="_blank"><img src="{{ asset('storage/' . $tp->bast_sarana) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->bast_sarana, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->bast_sarana }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>BAST prasarana nomor</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->bast_prasarana, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->bast_prasarana }}"  target="_blank"><img src="{{ asset('storage/' . $tp->bast_prasarana) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->bast_prasarana, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->bast_prasarana }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>Foto Pra, Ongoing, Pasca</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->foto_pop, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->foto_pop }}"  target="_blank"><img src="{{ asset('storage/' . $tp->foto_pop) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->foto_pop, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->foto_pop }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>Foto Bimtek</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->foto_bimtek, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->foto_bimtek }}"  target="_blank"><img src="{{ asset('storage/' . $tp->foto_bimtek) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->foto_bimtek, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->foto_bimtek }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>Laporan Bimtek </b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->laporan_bimtek, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->laporan_bimtek }}"  target="_blank"><img src="{{ asset('storage/' . $tp->laporan_bimtek) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->laporan_bimtek, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->laporan_bimtek }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>Foto Proses Produksi</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->foto_produksi, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->foto_produksi }}"  target="_blank"><img src="{{ asset('storage/' . $tp->foto_produksi) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->foto_produksi, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->foto_produksi }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
                                    </div>
                                </div>
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <div class="col-12"><label><b>Surat Bebas Kasus Hukum</b></label></div>
                                        
                                            @if (in_array($extension = pathinfo($tp->surat_bebas_hukum, PATHINFO_EXTENSION), ['jpg', 'png', "jpeg", 'bmp']))
                                                <div class="col-7"><a href="/storage/{{ $tp->surat_bebas_hukum }}"  target="_blank"><img src="{{ asset('storage/' . $tp->surat_bebas_hukum) }}" class="darker" alt=""></a></div>
                                            @elseif (in_array($extension = pathinfo($tp->surat_bebas_hukum, PATHINFO_EXTENSION), ['pdf', 'docs']))
                                                <div class="col-7"><a href="/storage/{{ $tp->surat_bebas_hukum }}"  target="_blank"><img src="{{ asset('img/kementan/file-upload.jpg') }}" class="darker" alt=""></a></div>
                                            @else
                                                <div class="col-7"><p class="text-danger">___No File Upload___</p></div>
                                            @endif 
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