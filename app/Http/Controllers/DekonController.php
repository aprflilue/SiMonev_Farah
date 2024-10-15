<?php

namespace App\Http\Controllers;

use App\Models\Data_Kelompok;
use App\Models\Dekon;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DekonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('pusat')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('dekons','dekons.data_kelompok_id','=','data__kelompoks.id')
            ->select(DB::raw('data__kelompoks.*, dekons.id as dekon_id, provinces.name as provinsi_name,dekons.data_kelompok_id as status'))
            ->where('data__kelompoks.jenis_bantuan','dekon')
            ->orderBy('data__kelompoks.created_at','desc')
            ->get();
        }elseif(Gate::allows('provinsi')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('dekons','dekons.data_kelompok_id','=','data__kelompoks.id')
            ->select(DB::raw('data__kelompoks.*, dekons.id as dekon_id, provinces.name as provinsi_name,dekons.data_kelompok_id as status'))
            ->where('data__kelompoks.jenis_bantuan','dekon')
            ->where('data__kelompoks.provinsi_id', Auth::user()->provinsi_id)
            ->orderBy('data__kelompoks.created_at','desc')
            ->get();
            
        }

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        return view('dashboard.monitoring.dekon.index', [
            'title' => 'Monitoring Dekonsentrasi',
            'data_kelompok' => $data_kelompok,
            'provinsi_auth' => $provinsi_auth,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $data_kelompok = Data_Kelompok::select('data__kelompoks.*','provinces.name as provinsi_name')
        ->join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
        ->where('data__kelompoks.id', $id)->get();

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        return view('dashboard.monitoring.dekon.create', [
            'title' => 'Input Monitoring Dekon',
            'data_kelompok' => $data_kelompok,
            'id' => $id,
            'provinsi_auth' => $provinsi_auth,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id, Request $request)
    {
        $validatedData = $request->validate([
            'persiapan_pelaksanaan_a'=> 'nullable',
            'sosialisasi_juknis_a'   => 'nullable',
            'koordinasi_a'           => 'nullable',
            'pelaksanaan_kegiatan_a' => 'nullable',
            'pembinaan_monitoring_a' => 'nullable',
            'pelaporan_a'            => 'nullable',
            
            'persiapan_pelaksanaan_b'=> 'nullable',
            'sosialisasi_juknis_b'   => 'nullable',
            'koordinasi_b'           => 'nullable',
            'pelaksanaan_kegiatan_b' => 'nullable',
            'pembinaan_monitoring_b' => 'nullable',
            'pelaporan_b'            => 'nullable',

        ]);
        $data_kelompok = Data_Kelompok::findOrFail($id);

        $dekon = new Dekon();
        $dekon->data_kelompok_id          = $data_kelompok->id;
        $dekon->persiapan_pelaksanaan_a   = $validatedData['persiapan_pelaksanaan_a'];
        $dekon->sosialisasi_juknis_a      = $validatedData['sosialisasi_juknis_a'];
        $dekon->koordinasi_a              = $validatedData['koordinasi_a'];
        $dekon->pelaksanaan_kegiatan_a    = $validatedData['pelaksanaan_kegiatan_a'];
        $dekon->pembinaan_monitoring_a    = $validatedData['pembinaan_monitoring_a'];
        $dekon->pelaporan_a               = $validatedData['pelaporan_a'];
        
        $dekon->persiapan_pelaksanaan_b   = $validatedData['persiapan_pelaksanaan_b'];
        $dekon->sosialisasi_juknis_b      = $validatedData['sosialisasi_juknis_b'];
        $dekon->koordinasi_b              = $validatedData['koordinasi_b'];
        $dekon->pelaksanaan_kegiatan_b    = $validatedData['pelaksanaan_kegiatan_b'];
        $dekon->pembinaan_monitoring_b    = $validatedData['pembinaan_monitoring_b'];
        $dekon->pelaporan_b               = $validatedData['pelaporan_b'];

        $dekon->save();

        Alert::success('Input Sukses!', 'Data Monitoring Dekon Berhasil Ditambahkan');
        return redirect()->to('/dashboard/dekon');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dekon = Data_Kelompok::join('dekons', 'dekons.data_kelompok_id', '=','data__kelompoks.id')
            ->join('provinces', 'provinces.id', '=', 'data__kelompoks.provinsi_id')
            ->select(DB::raw('data__kelompoks.*, dekons.*, provinces.name as provinsi_name'))
            ->find($id);

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        return view('dashboard.monitoring.dekon.edit', [
            'title' => 'Update Monitoring Dekon',
            'id' => $id,
            'dekon' => $dekon,
            'provinsi_auth' => $provinsi_auth,
        ]);
        // return response()->json(
        //     $dekon
        // );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'persiapan_pelaksanaan_a'=> 'nullable',
            'sosialisasi_juknis_a'   => 'nullable',
            'koordinasi_a'           => 'nullable',
            'pelaksanaan_kegiatan_a' => 'nullable',
            'pembinaan_monitoring_a' => 'nullable',
            'pelaporan_a'            => 'nullable',
            
            'persiapan_pelaksanaan_b'=> 'nullable',
            'sosialisasi_juknis_b'   => 'nullable',
            'koordinasi_b'           => 'nullable',
            'pelaksanaan_kegiatan_b' => 'nullable',
            'pembinaan_monitoring_b' => 'nullable',
            'pelaporan_b'            => 'nullable',

        ]);

        $data_kelompok = Data_Kelompok::find($id);

        Dekon::where('data_kelompok_id', $data_kelompok->id) -> update($validatedData);
        
        Alert::success('Update Data Sukses!', 'Data Monitoring Dekon Berhasil Diupdate');
        return redirect()->to('/dashboard/dekon');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dekon = Dekon::find($id);
        
        Dekon::destroy($dekon->id);

        Alert::success('Berhasil Dihapus!', 'Data Monitoring Dekon Berhasil Dihapus');
        return redirect()->to('/dashboard/dekon');
    }
}