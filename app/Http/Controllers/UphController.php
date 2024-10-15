<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Data_Kelompok;
use App\Models\Dekon;
use App\Models\District;
use App\Models\EvaluasiA;
use App\Models\EvaluasiB;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Tp;
use App\Models\Uph;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class UphController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('pusat')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('tps','tps.data_kelompok_id','=','data__kelompoks.id')
            ->leftjoin('dekons','dekons.data_kelompok_id','=','data__kelompoks.id')
            // ->leftjoin('anggarans','anggarans.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,tps.data_kelompok_id as status_tp, dekons.data_kelompok_id as status_dekon'))
                ->orderBy('data__kelompoks.created_at','desc')
                ->get();
        }elseif(Gate::allows('provinsi')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('tps','tps.data_kelompok_id','=','data__kelompoks.id')
            ->leftjoin('dekons','dekons.data_kelompok_id','=','data__kelompoks.id')
            // ->leftjoin('anggarans','anggarans.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,tps.data_kelompok_id as status_tp, dekons.data_kelompok_id as status_dekon'))
                ->orderBy('data__kelompoks.created_at','desc')
                ->where('data__kelompoks.provinsi_id', Auth::user()->provinsi_id)
                ->get();
        }

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
        ->select('provinces.name')
        ->where('users.provinsi_id', Auth::user()->provinsi_id)
        ->first();

        return view('dashboard.uph.index', [
            'title' => 'Unit Pengolahan Hasil (UPH)',
            'data_kelompok' => $data_kelompok,
            'provinsi_auth' => $provinsi_auth,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::allows('pusat')){
            $provinces = Province::all();
        }
        elseif(Gate::allows('provinsi')){
            $provinces = Province::where('provinces.id', Auth::user()->provinsi_id)->get();
        }   
        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        return view('dashboard.uph.create', [
            'title' => 'Input UPH',
            'provinces' => $provinces,
            'provinsi_auth' => $provinsi_auth,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'          => 'required|max:100',
            'alamat'        => 'required|max:100',
            'provinsi_id'   => 'required',
            'kabupaten_id'  => 'required',
            'kecamatan_id'  => 'required',
            'desa_id'       => 'required',
            'komoditi'      => 'required',

            'banper'        => 'required',
            'tahun_bantuan' => 'required|numeric',
            'jenis_bantuan' => 'required',

        ]);

        Data_Kelompok::create($validatedData);

        Alert::success('Input Sukses!', 'Data UPH Berhasil Ditambahkan');
        return redirect()->to('/dashboard/uph');
        // return redirect()->to('/dashboard/uph')->with('success', 'Data UPH Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Gate::allows('pusat')){
            $provinces = Province::all();
        }
        elseif(Gate::allows('provinsi')){
            $provinces = Province::where('provinces.id', Auth::user()->provinsi_id)->get();
        }
        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        $uph = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
        ->join('regencies', 'regencies.id' ,'=','data__kelompoks.kabupaten_id')
        ->join('districts', 'districts.id' ,'=','data__kelompoks.kecamatan_id')
        ->join('villages', 'villages.id' ,'=','data__kelompoks.desa_id')
        ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name, regencies.name as kabupaten_name, districts.name as kecamatan_name, villages.name as desa_name'))
        ->find($id);
        
        return view('dashboard.uph.edit', [
            'title' => 'Update UPH',
            'id' => $id,
            'provinces' => $provinces,
            'uph' => $uph,
            'provinsi_auth' => $provinsi_auth,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama'          => 'required|max:100',
            'alamat'        => 'required|max:100',
            'provinsi_id'   => 'required',
            'kabupaten_id'  => 'required',
            'kecamatan_id'  => 'required',
            'desa_id'       => 'required',
            'komoditi'      => 'required',

            'banper'        => 'required',
            'tahun_bantuan' => 'required|numeric',
            'jenis_bantuan' => 'required',

        ]);
        $uph = Data_Kelompok::find($id);
        // if (
        //     $request->nama == $gallery->name && $request->file('image') == null
        // ) {
        //     return redirect('/dashboard/galleries')->with('noUpdate', 'There is no update on Gallery!');
        // }

        Data_Kelompok::where('id', $uph->id) -> update($validatedData);

        Alert::success('Ubah Data Sukses!', 'Data UPH Berhasil Diubah');
        return redirect()->to('/dashboard/uph');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $uph = Data_Kelompok::find($id);
        
        Data_Kelompok::destroy($uph->id);

        Tp::where('data_kelompok_id',$id)->delete();
        Dekon::where('data_kelompok_id',$id)->delete();
        Anggaran::where('data_kelompok_id',$id)->delete();
        EvaluasiA::where('data_kelompok_id',$id)->delete();
        EvaluasiB::where('data_kelompok_id',$id)->delete();

        Alert::success('Berhasil Dihapus!', 'Data UPH Berhasil Dihapus');
        return redirect()->to('/dashboard/uph');
    }

    public function getkabupaten(request $request){
        $id_provinsi = $request->id_provinsi;

        $kabupatens = Regency::where('province_id', $id_provinsi)->get();

        $option = "<option>Pilih Kabupaten.....</option>";
        foreach($kabupatens as $kabupaten){
            $option.= "<option value='$kabupaten->id'>$kabupaten->name</option>";
        }
        echo $option;
    }
    public function getkecamatan(request $request){
        $id_kabupaten = $request->id_kabupaten;

        $kecamatans = District::where('regency_id', $id_kabupaten)->get();

        $option = "<option>Pilih Kecamatan.....</option>";
        foreach($kecamatans as $kecamatan){
            $option.= "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }
        echo $option;
    }
    
    public function getdesa(request $request){
        $id_kecamatan = $request->id_kecamatan;

        $desas = Village::where('district_id', $id_kecamatan)->get();
        
        $option = "<option>Pilih Desa.....</option>";
        foreach($desas as $desa){
            $option.= "<option value='$desa->id'>$desa->name</option>";
        }
        echo $option;
    }
}
