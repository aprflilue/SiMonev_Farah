<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Data_Kelompok;
use App\Models\Mon_anggaran;
use App\Models\Mon_dataanggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('pusat')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('anggarans','anggarans.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.id, data__kelompoks.provinsi_id , data__kelompoks.nama , data__kelompoks.komoditi, data__kelompoks.tahun_bantuan, provinces.name as provinsi_name, count(anggarans.data_kelompok_id) as total'))
                ->groupBy('data__kelompoks.id', 'data__kelompoks.provinsi_id','data__kelompoks.nama','data__kelompoks.komoditi','data__kelompoks.tahun_bantuan','provinces.name')
                ->where('data__kelompoks.jenis_bantuan','anggaran')
                ->orderBy('data__kelompoks.created_at','desc')
                ->get();
        }elseif(Gate::allows('provinsi')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('anggarans','anggarans.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.id, data__kelompoks.provinsi_id , data__kelompoks.nama , data__kelompoks.komoditi, data__kelompoks.tahun_bantuan, provinces.name as provinsi_name, count(anggarans.data_kelompok_id) as total'))
                ->groupBy('data__kelompoks.id', 'data__kelompoks.provinsi_id','data__kelompoks.nama','data__kelompoks.komoditi','data__kelompoks.tahun_bantuan','provinces.name')
                ->where('data__kelompoks.jenis_bantuan','anggaran')
                ->where('data__kelompoks.provinsi_id', Auth::user()->provinsi_id)
                ->orderBy('data__kelompoks.created_at','desc')
                ->get();
        }
        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        return view('dashboard.monitoring.anggaran.index', [
            'title' => 'Monitoring Anggaran',
            'data_kelompok' => $data_kelompok,
            'provinsi_auth' => $provinsi_auth

        ]);
        // return response()->json(
        //     $data_kelompok
        // );
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
        
        return view('dashboard.monitoring.anggaran.create', [
            'title' => 'Input Monitoring Anggaran',
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
            'kegiatan'              => 'nullable|max:400',
            'volume'                => 'nullable|numeric|min:0',
            'pagu'                  => 'nullable|numeric|min:0',
            'rel_keuangan'          => 'nullable|numeric',
            'rel_keuangan_persen'   => 'nullable|numeric|max:100',
            'rel_fisik_persen'      => 'nullable|numeric|max:100',
            'progres'               => 'nullable|max:400',           
            'kendala'               => 'nullable|max:400',           
            'tindakan'              => 'nullable|max:400',           
            'file_upload'           => 'nullable|file|max:2048',
        ]);

        $validatedData['file_upload']  = ($request->file_upload!=null) ? $request->file('file_upload')->store('post-anggaran') : null;

        $data_kelompok = Data_Kelompok::findOrFail($id);

        $anggaran = new Anggaran();
        $anggaran->data_kelompok_id    = $data_kelompok->id;
        $anggaran->kegiatan            = $validatedData['kegiatan'];
        $anggaran->volume              = $validatedData['volume'];
        $anggaran->pagu                = $validatedData['pagu'];
        $anggaran->rel_keuangan        = $validatedData['rel_keuangan'];
        $anggaran->rel_keuangan_persen = $validatedData['rel_keuangan_persen'];
        $anggaran->rel_fisik_persen    = $validatedData['rel_fisik_persen'];
        $anggaran->progres             = $validatedData['progres'];
        $anggaran->kendala             = $validatedData['kendala'];
        $anggaran->tindakan            = $validatedData['tindakan'];
        $anggaran->file_upload         = $validatedData['file_upload'];


        $anggaran->save();

        Alert::success('Input Sukses!', 'Data Monitoring Anggaran Berhasil Ditambahkan');
        return redirect()->to('/dashboard/anggaran/'.$data_kelompok->id.'/show');        
        // return redirect()->to('/dashboard/anggaran');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $anggaran = Anggaran::select('anggarans.*','anggarans.id as anggaran_id','data__kelompoks.*')
        ->join('data__kelompoks', 'data__kelompoks.id' ,'=','anggarans.data_kelompok_id')
        ->where('data__kelompoks.id', $id)
        ->get();

        $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('anggarans','anggarans.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.id, data__kelompoks.provinsi_id , data__kelompoks.nama , data__kelompoks.komoditi, data__kelompoks.tahun_bantuan, provinces.name as provinsi_name, count(anggarans.data_kelompok_id) as total'))
                ->groupBy('data__kelompoks.id', 'data__kelompoks.provinsi_id','data__kelompoks.nama','data__kelompoks.komoditi','data__kelompoks.tahun_bantuan','provinces.name')
                ->where('data__kelompoks.id', $id)
                ->get();

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
                ->select('provinces.name')
                ->where('users.provinsi_id', Auth::user()->provinsi_id)
                ->first();
        
        return view('dashboard.monitoring.anggaran.view', [
            'title' => 'View Monitoring Anggaran',
            'id' => $id,
            'anggaran'      => $anggaran,
            'data_kelompok' => $data_kelompok,
            'provinsi_auth' => $provinsi_auth,
        ]);

        // return response()->json(
        //     $anggaran
        // );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $anggaran = Anggaran::find($id);

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        return view('dashboard.monitoring.anggaran.edit', [
            'title'     => 'Update Monitoring Anggaran',
            'id'        => $id,
            'anggaran'  => $anggaran,
            'provinsi_auth'  => $provinsi_auth,
        ]);

        //  return response()->json(
        //      $data_kelompok
        // );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([ 
            'kegiatan'              => 'nullable|max:400',
            'volume'                => 'nullable|numeric|min:0',
            'pagu'                  => 'nullable|numeric|min:0',
            'rel_keuangan'          => 'nullable|numeric',
            'rel_keuangan_persen'   => 'nullable|numeric|max:100',
            'rel_fisik_persen'      => 'nullable|numeric|max:100',
            'progres'               => 'nullable|max:400',           
            'kendala'               => 'nullable|max:400',           
            'tindakan'              => 'nullable|max:400',           
            'file_upload'           => 'nullable|file|max:2048',
        ]);

        // $validatedData['file_upload']  = $request->file('file_upload')->store('post-anggaran');

        if ($request->file('file_upload')) {
            if ($request->post('old-image')) Storage::delete($request->post('old-image'));
            $validatedData['file_upload'] = $request->file('file_upload')->store('post-anggaran');
        }

        $anggaran = Anggaran::find($id);


        Anggaran::where('id', $anggaran->id) -> update($validatedData);

        Alert::success('Update Data Sukses!', 'Data Monitoring Anggaran Berhasil Diupdate');
        return redirect()->to('/dashboard/anggaran/'.$anggaran->data_kelompok_id.'/show');        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anggaran = Anggaran::find($id);
        
        Anggaran::destroy($anggaran->id);

        Alert::success('Berhasil Dihapus!', 'Data Monitoring Anggaran Berhasil Dihapus');
        return redirect()->to('/dashboard/anggaran/'.$anggaran->data_kelompok_id.'/show');
    }
}
