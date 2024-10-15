
    @extends('dashboard.layouts.main')

    @section('container')
        <div class="card p-4 mt-4">
            <form action="">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Provinsi</label>
                    <select class="form-control" id="provinsi">
                        <option>Pilih Provinsi.....</option>
                        @foreach ($provinces as $provinsi)
                            <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Kabupaten</label>
                    <select class="form-control" id="kabupaten">
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Kecamatan</label>
                    <select class="form-control" id="kecamatan">
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Kelurahan</label>
                    <select class="form-control" id="desa">
                        
                    </select>
                </div>
            </form>
        </div>
@endsection
