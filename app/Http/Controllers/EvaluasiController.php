<?php

namespace App\Http\Controllers;

use App\Models\Data_Kelompok;
use App\Models\EvaluasiA;
use App\Models\EvaluasiB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('pusat')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('evaluasi_a_s','evaluasi_a_s.data_kelompok_id','=','data__kelompoks.id')
            ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,evaluasi_a_s.data_kelompok_id as status'))
            ->orderBy('data__kelompoks.created_at','desc')
            ->get();
        }
        elseif(Gate::allows('provinsi')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('evaluasi_a_s','evaluasi_a_s.data_kelompok_id','=','data__kelompoks.id')
            ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,evaluasi_a_s.data_kelompok_id as status'))
            ->orderBy('data__kelompoks.created_at','desc')
            ->where('data__kelompoks.provinsi_id',Auth::user()->provinsi_id)
            ->get();
        }
        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();
        return view('dashboard.evaluasi.index', [
            'title' => 'Evaluasi',
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
        
        return view('dashboard.evaluasi.create', [
            'title' => 'Input Evaluasi',
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
            'A1' => 'required',
            'A2' => 'required',
            'A3' => 'required',
            'A4' => 'required',
            'B1' => 'required',
            'B2' => 'required',
            'B3' => 'required',
            'B4' => 'required',
            'B5' => 'required',
            'B6' => 'required',
            'B7' => 'required',
            'B8' => 'required',

            'ket_A1' => 'nullable|max:200',
            'ket_A2' => 'nullable|max:200',
            'ket_A3' => 'nullable|max:200',
            'ket_A4' => 'nullable|max:200',
            'ket_B1' => 'nullable|max:200',
            'ket_B2' => 'nullable|max:200',
            'ket_B3' => 'nullable|max:200',
            'ket_B4' => 'nullable|max:200',
            'ket_B5' => 'nullable|max:200',
            'ket_B6' => 'nullable|max:200',
            'ket_B7' => 'nullable|max:200',
            'ket_B8' => 'nullable|max:200',

            'foto_bast'      => 'nullable|file|max:2048',
            'foto_bangunan'  => 'nullable|file|max:2048',
            'foto_peralatan' => 'nullable|file|max:2048',

            'produksi'      => 'numeric|nullable',
            'harga'         => 'numeric|nullable',
            'pendapatan'    => 'numeric|nullable',
            'akses_pasar'   => 'nullable',
            'izin_edar'     => 'nullable',
            'jenis_izin'    => 'nullable',
            'sertifikat'    => 'nullable',

            'produksi_af'   => 'numeric|nullable',
            'harga_af'      => 'numeric|nullable',
            'pendapatan_af' => 'numeric|nullable',
            'akses_pasar_af'=> 'nullable',
            'izin_edar_af'  => 'nullable',
            'jenis_izin_af' => 'nullable',
            'sertifikat_af' => 'nullable',
        ]);

        $validatedData['foto_bast']      = ($request->foto_bast!=null) ? $request->file('foto_bast')->store('post-evaluasi') : null;
        $validatedData['foto_bangunan']  = ($request->foto_bangunan!=null) ? $request->file('foto_bangunan')->store('post-evaluasi') : null;
        $validatedData['foto_peralatan'] = ($request->foto_peralatan!=null) ? $request->file('foto_peralatan')->store('post-evaluasi') : null;

        $data_kelompok = Data_Kelompok::findOrFail($id);

        $pertanyaan = new EvaluasiA();
        $pertanyaan->data_kelompok_id   = $data_kelompok->id;
        $pertanyaan->A1   = $validatedData['A1'];
        $pertanyaan->A2   = $validatedData['A2'];
        $pertanyaan->A3   = $validatedData['A3'];
        $pertanyaan->A4   = $validatedData['A4'];
        $pertanyaan->B1   = $validatedData['B1'];
        $pertanyaan->B2   = $validatedData['B2'];
        $pertanyaan->B3   = $validatedData['B3'];
        $pertanyaan->B4   = $validatedData['B4'];
        $pertanyaan->B5   = $validatedData['B5'];
        $pertanyaan->B6   = $validatedData['B6'];
        $pertanyaan->B7   = $validatedData['B7'];
        $pertanyaan->B8   = $validatedData['B8'];
        
        $pertanyaan->ket_A1   = $validatedData['ket_A1'];
        $pertanyaan->ket_A2   = $validatedData['ket_A2'];
        $pertanyaan->ket_A3   = $validatedData['ket_A3'];
        $pertanyaan->ket_A4   = $validatedData['ket_A4'];
        $pertanyaan->ket_B1   = $validatedData['ket_B1'];
        $pertanyaan->ket_B2   = $validatedData['ket_B2'];
        $pertanyaan->ket_B3   = $validatedData['ket_B3'];
        $pertanyaan->ket_B4   = $validatedData['ket_B4'];
        $pertanyaan->ket_B5   = $validatedData['ket_B5'];
        $pertanyaan->ket_B6   = $validatedData['ket_B6'];
        $pertanyaan->ket_B7   = $validatedData['ket_B7'];
        $pertanyaan->ket_B8   = $validatedData['ket_B8'];
        
        $pertanyaan->foto_bast      = $validatedData['foto_bast'];
        $pertanyaan->foto_bangunan  = $validatedData['foto_bangunan'];
        $pertanyaan->foto_peralatan = $validatedData['foto_peralatan'];

        $pertanyaan->save();
       
        $pertanyaan_dua = new EvaluasiB();        
        
        $pertanyaan_dua->data_kelompok_id   = $data_kelompok->id;
        $pertanyaan_dua->produksi    = $validatedData['produksi'];
        $pertanyaan_dua->harga       = $validatedData['harga'];
        $pertanyaan_dua->pendapatan  = $validatedData['pendapatan'];
        
        $validatedData['akses_pasar'] = ($request->akses_pasar!=null) ? $request->akses_pasar : null;
        $validatedData['izin_edar'] = ($request->izin_edar!=null) ? $request->izin_edar : null;
        $validatedData['jenis_izin'] = ($request->jenis_izin!=null) ? $request->jenis_izin : null;
        $validatedData['sertifikat'] = ($request->sertifikat!=null) ? $request->sertifikat : null;
        
        $pertanyaan_dua->akses_pasar = $validatedData['akses_pasar'];
        $pertanyaan_dua->izin_edar   = $validatedData['izin_edar'];
        $pertanyaan_dua->jenis_izin  = $validatedData['jenis_izin'];
        $pertanyaan_dua->sertifikat  = $validatedData['sertifikat'];
        
        $pertanyaan_dua->produksi_af    = $validatedData['produksi_af'];
        $pertanyaan_dua->harga_af       = $validatedData['harga_af'];
        $pertanyaan_dua->pendapatan_af  = $validatedData['pendapatan_af'];

        $validatedData['akses_pasar_af'] = ($request->akses_pasar_af!=null) ? $request->akses_pasar_af : null;
        $validatedData['izin_edar_af'] = ($request->izin_edar_af!=null) ? $request->izin_edar_af : null;
        $validatedData['jenis_izin_af'] = ($request->jenis_izin_af!=null) ? $request->jenis_izin_af : null;
        $validatedData['sertifikat_af'] = ($request->sertifikat_af!=null) ? $request->sertifikat_af : null;
        
        $pertanyaan_dua->akses_pasar_af = $validatedData['akses_pasar_af'];
        $pertanyaan_dua->izin_edar_af   = $validatedData['izin_edar_af'];
        $pertanyaan_dua->jenis_izin_af  = $validatedData['jenis_izin_af'];
        $pertanyaan_dua->sertifikat_af  = $validatedData['sertifikat_af'];

        $pertanyaan_dua->save();

        Alert::success('Input Sukses!', 'Data Evaluasi Berhasil Ditambahkan');
        return redirect()->to('/dashboard/evaluasi');
        // return redirect()->to('/dashboard/evaluasi')->with('success', 'Data Evaluasi Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $evaluasi = Data_Kelompok::join('evaluasi_a_s', 'evaluasi_a_s.data_kelompok_id', '=','data__kelompoks.id')
        ->join('evaluasi_b_s', 'evaluasi_b_s.data_kelompok_id', '=','data__kelompoks.id')
        ->join('provinces', 'provinces.id', '=', 'data__kelompoks.provinsi_id')
        ->select(DB::raw('data__kelompoks.*, evaluasi_a_s.*, evaluasi_b_s.*, provinces.name as provinsi_name'))
        ->find($id);

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        return view('dashboard.evaluasi.edit', [
            'title' => 'Update Evaluasi',
            'evaluasi' => $evaluasi,
            'id' => $id,
            'provinsi_auth' => $provinsi_auth,
        ]);

        // return response()->json(
        //     $evaluasi
        // );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'A1' => 'nullable',
            'A2' => 'nullable',
            'A3' => 'nullable',
            'A4' => 'nullable',
            'B1' => 'nullable',
            'B2' => 'nullable',
            'B3' => 'nullable',
            'B4' => 'nullable',
            'B5' => 'nullable',
            'B6' => 'nullable',
            'B7' => 'nullable',
            'B8' => 'nullable',

            'ket_A1' => 'nullable|max:200',
            'ket_A2' => 'nullable|max:200',
            'ket_A3' => 'nullable|max:200',
            'ket_A4' => 'nullable|max:200',
            'ket_B1' => 'nullable|max:200',
            'ket_B2' => 'nullable|max:200',
            'ket_B3' => 'nullable|max:200',
            'ket_B4' => 'nullable|max:200',
            'ket_B5' => 'nullable|max:200',
            'ket_B6' => 'nullable|max:200',
            'ket_B7' => 'nullable|max:200',
            'ket_B8' => 'nullable|max:200',

            'foto_bast'      => 'nullable|file|max:2048',
            'foto_bangunan'  => 'nullable|file|max:2048',
            'foto_peralatan' => 'nullable|file|max:2048',
        ]);
        
        $validatedDatas = $request->validate([
            'produksi'      => 'numeric|nullable',
            'harga'         => 'numeric|nullable',
            'pendapatan'    => 'numeric|nullable',
            'akses_pasar'   => 'nullable',
            'izin_edar'     => 'nullable',
            'jenis_izin'    => 'nullable',
            'sertifikat'    => 'nullable',

            'produksi_af'   => 'numeric|nullable',
            'harga_af'      => 'numeric|nullable',
            'pendapatan_af' => 'numeric|nullable',
            'akses_pasar_af'=> 'nullable',
            'izin_edar_af'  => 'nullable',
            'jenis_izin_af' => 'nullable',
            'sertifikat_af' => 'nullable',
        ]);

        if ($request->file('foto_bast')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['foto_bast'] = $request->file('foto_bast')->store('post-evaluasi');
        }
        if ($request->file('foto_bangunan')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['foto_bangunan'] = $request->file('foto_bangunan')->store('post-evaluasi');
        }
        if ($request->file('foto_peralatan')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['foto_peralatan'] = $request->file('foto_peralatan')->store('post-evaluasi');
        }
        
        $data_kelompoks = Data_Kelompok::find($id);
        EvaluasiA::where('data_kelompok_id', $data_kelompoks->id) -> update($validatedData);
        
        $data_kelompok = Data_Kelompok::find($id);
        EvaluasiB::where('data_kelompok_id', $data_kelompok->id) -> update($validatedDatas);
        
        Alert::success('Update Data Sukses!!', 'Data Evaluasi Berhasil Diupdate');
        return redirect()->to('/dashboard/evaluasi');
        // return redirect()->to('/dashboard/evaluasi')->with('success', 'Data Evaluasi Berhasil Ditambahkan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evaluasi = Data_Kelompok::find($id);
        // $evaluasi = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
        //     ->leftjoin('evaluasi_a_s','evaluasi_a_s.data_kelompok_id','=','data__kelompoks.id')
        //     ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,evaluasi_a_s.data_kelompok_id as status'))
        //     ->orderBy('data__kelompoks.created_at','desc')
        //     ->get();
        
        // EvaluasiA::destroy($evaluasi->id);
        EvaluasiA::where('data_kelompok_id',$id)->delete();
        EvaluasiB::where('data_kelompok_id',$id)->delete();

        Alert::success('Berhasil Dihapus!', 'Data Evaluasi Berhasil Dihapus');
        return redirect()->to('/dashboard/evaluasi');
    }
}
