@extends('dashboard.layouts.main')

@section('container')

@push('css')
    <link rel="stylesheet" href="/vendor/jquery-steps/jquery.steps.css">
    <link href="/css/app.min.css" rel="stylesheet">
    
    {{-- Dropify form input  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
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
            <div class="breadcrumb-item"><a href="/dashboard/tp">Monitoring TP</a></div>
            <div class="breadcrumb-item">Update TP</div>
        </div>
    </div>
</section>


    <!-- row -->
    <div class="card card-primary shadow mb-4">
        <div class="col-lg-10">
            
            <div class="card-body mt-3">

                    <form class="form-horizontal form-wizard-wrapper" action="/dashboard/tp/update/{{ $id }}" method="post" novalidate enctype="multipart/form-data">   
                        @csrf
                        @method('PUT')
                        
                        <h3 style="color: #C59100; font-size: 20px">1. Data Kelompok</h3>
                        <span><small class="text-danger"><< Silahkan periksa kembali, Apakah data kelompok sudah sesuai. >></small></span>
                        <fieldset>
                            <div class="mb-3">
                                <label for="data_kelompok_id" class="form-label">Nama Kelompok</label>
                                <input name="data_kelompok_id" type="text" class="form-control"  value="{{ old('nama' , $tp->nama) }}" readonly>
                            </div>                
                            <div class="mb-3">
                                <label for="data_kelompok_id" class="form-label">Provinsi</label>
                                <input name="data_kelompok_id" type="text" class="form-control"  value="{{ old('provinsi_name' , $tp->provinsi_name) }}" readonly>
                            </div>                
                            <div class="mb-3">
                                <label for="data_kelompok_id" class="form-label">Komoditi</label>
                                <input name="data_kelompok_id" type="text" class="form-control"  value="{{ old('komoditi' , $tp->komoditi) }}" readonly>
                            </div>                
                            <div class="mb-3">
                                <label for="data_kelompok_id" class="form-label">Tahun Bantuan</label>
                                <input name="data_kelompok_id" type="text" class="form-control"  value="{{ old('tahun_bantuan' , $tp->tahun_bantuan) }}" readonly>
                            </div>                
                        </fieldset>
                        
                        <div class="click-next">
                            <a href="#" id="displayText" onclick="displayText()">Next</a>
                        </div>
                        <hr>
                        
                        <div id="textField" style="display: none;">
                            <h3 style="color: #C59100; font-size: 20px">2. Dokumen dan Laporan</h3>
                            <fieldset>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch ml-2 mr-3">
                                                <input type="checkbox" class="custom-control-input" name="proposal" id="proposal" value="{{ old('proposal', isset($tp) ? 'checked' : '') }}" @if($tp->proposal==1) checked @endif>
                                                <label class="custom-control-label" for="proposal" id="label_proposal"></label>Proposal Fisik Scan
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch ml-2 mr-3">
                                                <input type="checkbox" class="custom-control-input" name="eproposal" id="eproposal" value="{{ old('eproposal', isset($tp) ? 'checked' : '') }}" @if($tp->eproposal==1) checked @endif>
                                                <label class="custom-control-label" for="eproposal" id="label_eproposal"></label>E-Proposal
                                            </div>    
                                        </div>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch ml-2 mr-3">
                                                <input type="checkbox" class="custom-control-input" name="uji_lab" id="uji_lab" value="{{ old('uji_lab', isset($tp) ? 'checked' : '') }}" @if($tp->uji_lab==1) checked @endif>
                                                <label class="custom-control-label" for="uji_lab" id="label_uji_lab"></label>Uji Laboratorium Produk
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch ml-2 mr-3">
                                                <input type="checkbox" class="custom-control-input" name="pengajuan_sertif" id="pengajuan_sertif" value="{{ old('pengajuan_sertif', isset($tp) ? 'checked' : '') }}" @if($tp->pengajuan_sertif==1) checked @endif>
                                                <label class="custom-control-label" for="pengajuan_sertif" id="label_pengajuan_sertif"></label>Pengajuan Sertifikasi ke LSO
                                            </div>    
                                        </div>
                                    </div>
                                    
                                    <div class="col-6 mt-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch ml-2 mr-3">
                                                <input type="checkbox" class="custom-control-input" name="foodgrade" id="foodgrade" value="{{ old('foodgrade', isset($tp) ? 'checked' : '') }}" @if($tp->foodgrade==1) checked @endif>
                                                <label class="custom-control-label" for="foodgrade" id="label_foodgrade"></label>Peralatan Foodgrade
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch ml-2 mr-3">
                                                <input type="checkbox" class="custom-control-input" name="test_report" id="test_report" value="{{ old('test_report', isset($tp) ? 'checked' : '') }}" @if($tp->test_report==1) checked @endif>
                                                <label class="custom-control-label" for="test_report" id="label_test_report"></label>Memiliki test report 
                                            </div>    
                                        </div>
                                    </div>
                                
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="cpcl" class="form-label">CPCL<small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input id="cpcl" name="cpcl" type="file" class="dropify @error('cpcl') is-invalid @enderror" @if($tp->cpcl!=null) data-default-file="{{ asset('storage/' . $tp->cpcl) }}" @endif>
                                            @error('cpcl')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="sk_penetapan" class="form-label">SK Penetapan Kelompok Penerima<small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="sk_penetapan" name="sk_penetapan" @error('sk_penetapan') is-invalid @enderror @if($tp->sk_penetapan!=null) data-default-file="{{ asset('storage/' . $tp->sk_penetapan) }}" @endif>
                                            @error('sk_penetapan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="workshop" class="form-label">Workshop Penyusunan RKP<small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="workshop" name="workshop" @error('workshop') is-invalid @enderror @if($tp->workshop!=null) data-default-file="{{ asset('storage/' . $tp->workshop) }}" @endif>
                                            @error('workshop') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="spk" class="form-label">SPK Lelang atau LS<small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="spk" name="spk" @error('spk') is-invalid @enderror @if($tp->spk!=null) data-default-file="{{ asset('storage/' . $tp->spk) }}" @endif>
                                            @error('spk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="status_lahan" class="form-label">Status Penggunaan Lahan<span style="font-size: 12px"> (Min. 10 tahun)</span></label><br><small class="text-danger"> (File pdf | image, Max Size 2 mb )</small>
                                            <input class="dropify" type="file" id="status_lahan" name="status_lahan" @error('status_lahan') is-invalid @enderror @if($tp->status_lahan!=null) data-default-file="{{ asset('storage/' . $tp->status_lahan) }}" @endif>
                                            @error('status_lahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="penyusunan_sop" class="form-label">Penyusunan SOP/Doksistu<small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="penyusunan_sop" name="penyusunan_sop" @error('penyusunan_sop') is-invalid @enderror @if($tp->penyusunan_sop!=null) data-default-file="{{ asset('storage/' . $tp->penyusunan_sop) }}" @endif>
                                            @error('penyusunan_sop') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="bast_sarana" class="form-label">BAST sarana nomor <small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="bast_sarana" name="bast_sarana" @error('bast_sarana') is-invalid @enderror @if($tp->bast_sarana!=null) data-default-file="{{ asset('storage/' . $tp->bast_sarana) }}" @endif>
                                            @error('bast_sarana') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="bast_prasarana" class="form-label">BAST prasarana nomor <small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="bast_prasarana" name="bast_prasarana" @error('bast_prasarana') is-invalid @enderror @if($tp->bast_prasarana!=null) data-default-file="{{ asset('storage/' . $tp->bast_prasarana) }}" @endif>
                                            @error('bast_prasarana') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="foto_pop" class="form-label">Foto Pra, Ongoing, Pasca <small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="foto_pop" name="foto_pop" @error('foto_pop') is-invalid @enderror @if($tp->foto_pop!=null) data-default-file="{{ asset('storage/' . $tp->foto_pop) }}" @endif>
                                            @error('foto_pop') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="foto_bimtek" class="form-label">Foto Bimtek <small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="foto_bimtek" name="foto_bimtek" @error('foto_bimtek') is-invalid @enderror @if($tp->foto_bimtek!=null) data-default-file="{{ asset('storage/' . $tp->foto_bimtek) }}" @endif>
                                            @error('foto_bimtek') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="laporan_bimtek" class="form-label">Laporan Bimtek <small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="laporan_bimtek" name="laporan_bimtek" @error('laporan_bimtek') is-invalid @enderror @if($tp->laporan_bimtek!=null) data-default-file="{{ asset('storage/' . $tp->laporan_bimtek) }}" @endif>
                                            @error('laporan_bimtek') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="foto_produksi" class="form-label">Foto Proses Produksi <small class="text-danger"> (File pdf | image, Max Size 2 mb )</small></label>
                                            <input class="dropify" type="file" id="foto_produksi" name="foto_produksi" @error('foto_produksi') is-invalid @enderror @if($tp->foto_produksi!=null) data-default-file="{{ asset('storage/' . $tp->foto_produksi) }}" @endif>
                                            @error('foto_produksi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="mb-3">
                                            <label for="surat_bebas_hukum" class="form-label">Surat Bebas Kasus Hukum<span style="font-size: 12px"> (Min. 10 tahun)</span></label><br><small class="text-danger"> (File pdf | image, Max Size 2 mb )</small>
                                            <input class="dropify" type="file" id="surat_bebas_hukum" name="surat_bebas_hukum" @error('surat_bebas_hukum') is-invalid @enderror @if($tp->surat_bebas_hukum!=null) data-default-file="{{ asset('storage/' . $tp->surat_bebas_hukum) }}" @endif>
                                            @error('surat_bebas_hukum') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <a href="/dashboard/tp" type="submit" class="btn mt-2" style="background-color: #bfc6cd">Cancel</a>
                                <button type="submit" class="btn btn-primary mt-2">Update Data</button>
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
	
    {{-- Dropify form input  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // $('.dropify').dropify();

        $('.dropify').dropify({
				messages: {
					default: 'Seret dan lepas file di sini atau klik',
					replace: 'Seret dan lepas file atau klik untuk mengganti',
					remove:  'Hapus',
					error:   'Maaf, file terlalu besar'
				}
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
    </script>

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