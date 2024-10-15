<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Data_Kelompok;
use App\Models\Dekon;
use App\Models\Tp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LaporanMonitoringController extends Controller
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
            ->leftjoin('anggarans','anggarans.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('
                    data__kelompoks.id, 
                    data__kelompoks.provinsi_id , 
                    data__kelompoks.nama , 
                    data__kelompoks.komoditi, 
                    data__kelompoks.tahun_bantuan, 
                    data__kelompoks.jenis_bantuan, 
                    provinces.name as provinsi_name,
                    tps.data_kelompok_id as status_tp,
                    dekons.data_kelompok_id as status_dekon,
                    count(anggarans.data_kelompok_id) as total_anggaran'))
                ->groupBy(
                    'data__kelompoks.id', 
                    'data__kelompoks.provinsi_id',
                    'data__kelompoks.nama',
                    'data__kelompoks.komoditi',
                    'data__kelompoks.tahun_bantuan',
                    'data__kelompoks.jenis_bantuan',
                    'tps.data_kelompok_id',
                    'dekons.data_kelompok_id',
                    'provinces.name'
                    )
                    ->orderBy('data__kelompoks.created_at','desc')
                ->get();
        }
        elseif(Gate::allows('provinsi')){
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('tps','tps.data_kelompok_id','=','data__kelompoks.id')
            ->leftjoin('dekons','dekons.data_kelompok_id','=','data__kelompoks.id')
            ->leftjoin('anggarans','anggarans.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('
                    data__kelompoks.id, 
                    data__kelompoks.provinsi_id , 
                    data__kelompoks.nama , 
                    data__kelompoks.komoditi, 
                    data__kelompoks.tahun_bantuan, 
                    data__kelompoks.jenis_bantuan, 
                    provinces.name as provinsi_name,
                    tps.data_kelompok_id as status_tp,
                    dekons.data_kelompok_id as status_dekon,
                    count(anggarans.data_kelompok_id) as total_anggaran'))
                    ->groupBy(
                        'data__kelompoks.id', 
                    'data__kelompoks.provinsi_id',
                    'data__kelompoks.nama',
                    'data__kelompoks.komoditi',
                    'data__kelompoks.tahun_bantuan',
                    'data__kelompoks.jenis_bantuan',
                    'tps.data_kelompok_id',
                    'dekons.data_kelompok_id',
                    'provinces.name'
                    )
                    ->where('data__kelompoks.provinsi_id',Auth::user()->provinsi_id)
                    ->orderBy('data__kelompoks.created_at','desc')
                    ->get();
                }
                
            $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
                ->select('provinces.name')
                ->where('users.provinsi_id', Auth::user()->provinsi_id)
                ->first();

                // 13
            $tp = Tp::select(DB::raw(
                    '(ISNULL(tps.cpcl)
                    + ISNULL(tps.sk_penetapan)
                    + ISNULL(tps.workshop)
                    + ISNULL(tps.spk)
                    + ISNULL(tps.status_lahan)
                    + ISNULL(tps.penyusunan_sop)
                    + ISNULL(tps.bast_sarana)
                    + ISNULL(tps.bast_prasarana)
                    + ISNULL(tps.foto_pop)
                    + ISNULL(tps.foto_bimtek)
                    + ISNULL(tps.laporan_bimtek)
                    + ISNULL(tps.foto_produksi)
                    + ISNULL(tps.surat_bebas_hukum)
                ) as total_null, tps.data_kelompok_id'
            ))->get();
        
        // $progres_tp = ($tp->total_null)/13 * 100;

        // 12
        $dekon = Dekon::select(DB::raw(
                    '(ISNULL(dekons.persiapan_pelaksanaan_a)
                    + ISNULL(dekons.persiapan_pelaksanaan_b)
                    + ISNULL(dekons.sosialisasi_juknis_a)
                    + ISNULL(dekons.sosialisasi_juknis_b)
                    + ISNULL(dekons.koordinasi_a)
                    + ISNULL(dekons.koordinasi_b)
                    + ISNULL(dekons.pelaksanaan_kegiatan_a)
                    + ISNULL(dekons.pelaksanaan_kegiatan_b)
                    + ISNULL(dekons.pembinaan_monitoring_a)
                    + ISNULL(dekons.pembinaan_monitoring_b)
                    + ISNULL(dekons.pelaporan_a)
                    + ISNULL(dekons.pelaporan_b)
                ) as total_null, dekons.data_kelompok_id'
            ))->get();
        
        // 10
        $anggaran = Anggaran::select(DB::raw(
                    '(ISNULL(anggarans.kegiatan)
                    + ISNULL(anggarans.volume)
                    + ISNULL(anggarans.pagu)
                    + ISNULL(anggarans.rel_keuangan)
                    + ISNULL(anggarans.rel_keuangan_persen)
                    + ISNULL(anggarans.rel_fisik_persen)
                    + ISNULL(anggarans.progres)
                    + ISNULL(anggarans.kendala)
                    + ISNULL(anggarans.tindakan)
                    + ISNULL(anggarans.file_upload)
                ) as total_null, anggarans.data_kelompok_id, anggarans.id as anggaran_id'
            ))->get();
            
        return view('dashboard.laporan.monitoring.index', [
            'title' => 'Laporan Monitoring',
            'data_kelompok' => $data_kelompok,
            'tp' => $tp,
            'dekon' => $dekon,
            'anggaran' => $anggaran,
            'provinsi_auth' => $provinsi_auth,
        ]);

        // return response()->json(
        //     $tp, 
        // );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //
    }

    /**
     * Display the specified resource.
     */
    public function show_anggaran($id)
    {        
        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        $anggaran = Anggaran::join('data__kelompoks','data__kelompoks.id','=','anggarans.data_kelompok_id')
            ->join('provinces','provinces.id','=', 'data__kelompoks.provinsi_id')
            ->find($id);

        return view('dashboard.laporan.monitoring.view_anggaran', [
            'title' => 'View Laporan Anggaran',
            'id'        => $id,
            'anggaran' => $anggaran,
            'provinsi_auth' => $provinsi_auth,
        ]);

        // return response()->json(
        //     $count_anggaran
        // );
    }
    
    public function show_tp(string $id)
    {        
        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        $tp = Data_Kelompok::join('tps', 'tps.data_kelompok_id', '=','data__kelompoks.id')
            ->join('provinces', 'provinces.id', '=', 'data__kelompoks.provinsi_id')
            ->select(DB::raw('data__kelompoks.*, tps.*, provinces.name as provinsi_name'))
            ->find($id);
        
        $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('tps','tps.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.id, data__kelompoks.provinsi_id , data__kelompoks.nama , data__kelompoks.komoditi, data__kelompoks.tahun_bantuan, provinces.name as provinsi_name'))
                ->groupBy('data__kelompoks.id', 'data__kelompoks.provinsi_id','data__kelompoks.nama','data__kelompoks.komoditi','data__kelompoks.tahun_bantuan','provinces.name')
                ->where('data__kelompoks.id', $id)
                ->get();

        return view('dashboard.laporan.monitoring.view_tp', [
            'title' => 'View Laporan TP',
            'id'        => $id,
            'data_kelompok' => $data_kelompok,
            'tp' => $tp,
            'provinsi_auth' => $provinsi_auth,
        ]);
    }
    
    public function show_dekon(string $id)
    {        
        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        $dekon = Data_Kelompok::join('dekons', 'dekons.data_kelompok_id', '=','data__kelompoks.id')
            ->join('provinces', 'provinces.id', '=', 'data__kelompoks.provinsi_id')
            ->select(DB::raw('data__kelompoks.*, dekons.*, provinces.name as provinsi_name'))
            ->find($id);
        
        
        return view('dashboard.laporan.monitoring.view_dekon', [
            'title' => 'View Laporan Dekon',
            'id'        => $id,
            'dekon'     => $dekon,
            'provinsi_auth' => $provinsi_auth,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        //
    }
}
