<?php

namespace App\Http\Controllers;

use App\Models\Data_Kelompok;
use App\Models\Tp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('pusat')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('tps','tps.data_kelompok_id','=','data__kelompoks.id')
            ->select(DB::raw('data__kelompoks.*, tps.id as tp_id, provinces.name as provinsi_name,tps.data_kelompok_id as status'))
            ->where('data__kelompoks.jenis_bantuan','tp')
            ->orderBy('data__kelompoks.created_at','desc')
            ->get();
        }
        elseif(Gate::allows('provinsi')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('tps','tps.data_kelompok_id','=','data__kelompoks.id')
            ->select(DB::raw('data__kelompoks.*, tps.id as tp_id, provinces.name as provinsi_name,tps.data_kelompok_id as status'))
            ->where('data__kelompoks.jenis_bantuan','tp')
            ->where('data__kelompoks.provinsi_id', Auth::user()->provinsi_id)
            ->orderBy('data__kelompoks.created_at','desc')
            ->get();

        }

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        return view('dashboard.monitoring.tp.index', [
            'title' => 'Monitoring TP',
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

        return view('dashboard.monitoring.tp.create', [
            'title' => 'Input Monitoring TP',
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
            'cpcl'             => 'nullable|file|max:2048',
            'sk_penetapan'     => 'nullable|file|max:2048',
            'workshop'         => 'nullable|file|max:2048',
            'spk'              => 'nullable|file|max:2048',
            'status_lahan'     => 'nullable|file|max:2048',
            'penyusunan_sop'   => 'nullable|file|max:2048',
            'bast_sarana'      => 'nullable|file|max:2048',
            'bast_prasarana'   => 'nullable|file|max:2048',
            'foto_pop'         => 'nullable|file|max:2048',
            'foto_bimtek'      => 'nullable|file|max:2048',
            'laporan_bimtek'   => 'nullable|file|max:2048',
            'foto_produksi'    => 'nullable|file|max:2048',
            'surat_bebas_hukum'=> 'nullable|file|max:2048',
        ]);

        $validatedData['cpcl']              = ($request->cpcl!=null) ? $request->file('cpcl')->store('post-tp') : null;
        $validatedData['sk_penetapan']      = ($request->sk_penetapan!=null) ? $request->file('sk_penetapan')->store('post-tp') : null;
        $validatedData['workshop']          = ($request->workshop!=null) ? $request->file('workshop')->store('post-tp') : null;
        $validatedData['spk']               = ($request->spk!=null) ? $request->file('spk')->store('post-tp') : null;
        $validatedData['status_lahan']      = ($request->status_lahan!=null) ? $request->file('status_lahan')->store('post-tp') : null;
        $validatedData['penyusunan_sop']    = ($request->penyusunan_sop!=null) ? $request->file('penyusunan_sop')->store('post-tp') : null;
        $validatedData['bast_sarana']       = ($request->bast_sarana!=null) ? $request->file('bast_sarana')->store('post-tp') : null;
        $validatedData['bast_prasarana']    = ($request->bast_prasarana!=null) ? $request->file('bast_prasarana')->store('post-tp') : null;
        $validatedData['foto_pop']          = ($request->foto_pop!=null) ? $request->file('foto_pop')->store('post-tp') : null;
        $validatedData['foto_bimtek']       = ($request->foto_bimtek!=null) ? $request->file('foto_bimtek')->store('post-tp') : null;
        $validatedData['laporan_bimtek']    = ($request->laporan_bimtek!=null) ? $request->file('laporan_bimtek')->store('post-tp') : null;
        $validatedData['foto_produksi']     = ($request->foto_produksi!=null) ? $request->file('foto_produksi')->store('post-tp') : null;
        $validatedData['surat_bebas_hukum'] = ($request->surat_bebas_hukum!=null) ? $request->file('surat_bebas_hukum')->store('post-tp') : null;

        $data_kelompok = Data_Kelompok::findOrFail($id);

        $tp = new Tp();
        $tp->data_kelompok_id   = $data_kelompok->id;
        $tp->proposal           = $request->has('proposal');
        $tp->eproposal          = $request->has('eproposal');
        $tp->uji_lab            = $request->has('uji_lab');
        $tp->pengajuan_sertif   = $request->has('pengajuan_sertif');
        $tp->foodgrade          = $request->has('foodgrade');
        $tp->test_report        = $request->has('test_report');
        $tp->cpcl               = $validatedData['cpcl'];
        $tp->sk_penetapan       = $validatedData['sk_penetapan'];
        $tp->workshop           = $validatedData['workshop'];
        $tp->spk                = $validatedData['spk'];
        $tp->status_lahan       = $validatedData['status_lahan'];
        $tp->penyusunan_sop     = $validatedData['penyusunan_sop'];
        $tp->bast_sarana        = $validatedData['bast_sarana'];
        $tp->bast_prasarana     = $validatedData['bast_prasarana'];
        $tp->foto_pop           = $validatedData['foto_pop'];
        $tp->foto_bimtek        = $validatedData['foto_bimtek'];
        $tp->laporan_bimtek     = $validatedData['laporan_bimtek'];
        $tp->foto_produksi      = $validatedData['foto_produksi'];
        $tp->surat_bebas_hukum  = $validatedData['surat_bebas_hukum'];

        $tp->save();

        Alert::success('Input Sukses!', 'Data Monitoring TP Berhasil Ditambahkan');
        return redirect()->to('/dashboard/tp');
        // return redirect()->to('/dashboard/tp')->with('success', 'Data Monitoring TP Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tp $tp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tp = Data_Kelompok::join('tps', 'tps.data_kelompok_id', '=','data__kelompoks.id')
            ->join('provinces', 'provinces.id', '=', 'data__kelompoks.provinsi_id')
            ->select(DB::raw('data__kelompoks.*, tps.*, provinces.name as provinsi_name'))
            ->find($id);

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        return view('dashboard.monitoring.tp.edit', [
            'title' => 'Update Monitoring TP',
            'id' => $id,
            'tp' => $tp,
            'provinsi_auth' => $provinsi_auth,
        ]);
        // return response()->json(
        //     $tp
        // );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'proposal'         => 'nullable',
            'eproposal'        => 'nullable',
            'uji_lab'          => 'nullable',
            'pengajuan_sertif' => 'nullable',
            'foodgrade'        => 'nullable',
            'test_report'      => 'nullable',
        
            'cpcl'             => 'nullable|file|max:2048',
            'sk_penetapan'     => 'nullable|file|max:2048',
            'workshop'         => 'nullable|file|max:2048',
            'spk'              => 'nullable|file|max:2048',
            'status_lahan'     => 'nullable|file|max:2048',
            'penyusunan_sop'   => 'nullable|file|max:2048',
            'bast_sarana'      => 'nullable|file|max:2048',
            'bast_prasarana'   => 'nullable|file|max:2048',
            'foto_pop'         => 'nullable|file|max:2048',
            'foto_bimtek'      => 'nullable|file|max:2048',
            'laporan_bimtek'   => 'nullable|file|max:2048',
            'foto_produksi'    => 'nullable|file|max:2048',
            'surat_bebas_hukum'=> 'nullable|file|max:2048',
        ]);

        $validatedData['proposal']          = $request->has('proposal');
        $validatedData['eproposal']         = $request->has('eproposal');
        $validatedData['uji_lab']           = $request->has('uji_lab');
        $validatedData['pengajuan_sertif']  = $request->has('pengajuan_sertif');
        $validatedData['foodgrade']         = $request->has('foodgrade');
        $validatedData['test_report']       = $request->has('test_report');

        if ($request->file('cpcl')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['cpcl'] = $request->file('cpcl')->store('post-tp');
        }
        if ($request->file('sk_penetapan')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['sk_penetapan'] = $request->file('sk_penetapan')->store('post-tp');
        }
        if ($request->file('workshop')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['workshop'] = $request->file('workshop')->store('post-tp');
        }
        if ($request->file('spk')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['spk'] = $request->file('spk')->store('post-tp');
        }
        if ($request->file('status_lahan')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['status_lahan'] = $request->file('status_lahan')->store('post-tp');
        }
        if ($request->file('penyusunan_sop')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['penyusunan_sop'] = $request->file('penyusunan_sop')->store('post-tp');
        }
        if ($request->file('bast_sarana')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['bast_sarana'] = $request->file('bast_sarana')->store('post-tp');
        }
        if ($request->file('bast_prasarana')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['bast_prasarana'] = $request->file('bast_prasarana')->store('post-tp');
        }
        if ($request->file('foto_pop')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['foto_pop'] = $request->file('foto_pop')->store('post-tp');
        }
        if ($request->file('foto_bimtek')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['foto_bimtek'] = $request->file('foto_bimtek')->store('post-tp');
        }
        if ($request->file('laporan_bimtek')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['laporan_bimtek'] = $request->file('laporan_bimtek')->store('post-tp');
        }
        if ($request->file('foto_produksi')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['foto_produksi'] = $request->file('foto_produksi')->store('post-tp');
        }
        if ($request->file('surat_bebas_hukum')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['surat_bebas_hukum'] = $request->file('surat_bebas_hukum')->store('post-tp');
        }

        $data_kelompoks = Data_Kelompok::find($id);
        Tp::where('data_kelompok_id', $data_kelompoks->id) -> update($validatedData);
        
        
        Alert::success('Update Data Sukses!', 'Data Monitoring TP Berhasil Diupdate');
        return redirect()->to('/dashboard/tp');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tp = Tp::find($id);
        
        Tp::destroy($tp->id);

        Alert::success('Berhasil Dihapus!', 'Data Monitoring TP Berhasil Dihapus');
        return redirect()->to('/dashboard/tp');
    }
}
