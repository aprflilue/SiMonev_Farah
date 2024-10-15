<?php

namespace App\Http\Controllers;

use App\Models\Data_Kelompok;
use App\Models\EvaluasiA;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LaporanEvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        if(Gate::allows('pusat')){

            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('evaluasi_a_s','evaluasi_a_s.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('
                    data__kelompoks.id as kelompok_id, 
                    data__kelompoks.provinsi_id , 
                    data__kelompoks.nama , 
                    data__kelompoks.komoditi, 
                    data__kelompoks.tahun_bantuan, 
                    data__kelompoks.jenis_bantuan,
                    evaluasi_a_s.data_kelompok_id as status,
                    provinces.name as provinsi_name'))
                ->orderBy('data__kelompoks.created_at','desc')
                ->get();
        }
        elseif(Gate::allows('provinsi')){
            
            $data_kelompok = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
            ->leftjoin('evaluasi_a_s','evaluasi_a_s.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('
                    data__kelompoks.id as kelompok_id, 
                    data__kelompoks.provinsi_id , 
                    data__kelompoks.nama , 
                    data__kelompoks.komoditi, 
                    data__kelompoks.tahun_bantuan, 
                    data__kelompoks.jenis_bantuan,
                    evaluasi_a_s.data_kelompok_id as status,
                    provinces.name as provinsi_name'))
                ->orderBy('data__kelompoks.created_at','desc')
                ->where('data__kelompoks.provinsi_id',Auth::user()->provinsi_id)
                ->get();
        }


        // TINGKAT KEBERMANFAATAN
        $evaluasi = EvaluasiA::select(DB::raw("evaluasi_a_s.data_kelompok_id
            ,( COUNT(case when(evaluasi_a_s.A1) = '1' then 1 else null end)
            + COUNT(case when(evaluasi_a_s.A2) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.A3) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.A4) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.B1) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.B2) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.B3) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.B4) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.B5) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.B6) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.B7) = '1' then 1 else null end) 
            + COUNT(case when(evaluasi_a_s.B8) = '1' then 1 else null end) 
            
            ) as total_yes
        "))
        ->groupby('evaluasi_a_s.data_kelompok_id')
        ->get();

        return view('dashboard.laporan.evaluasi.index', [
            'title' => 'Laporan Evaluasi',
            'data_kelompok' => $data_kelompok,
            'evaluasi' => $evaluasi,
            'provinsi_auth' => $provinsi_auth,
        ]);

        // return response()->json(
        //     $evaluasi
        // );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($id)
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
        
        return view('dashboard.laporan.evaluasi.view', [
            'title' => 'View Laporan Evaluasi',
            'id'    => $id,
            'evaluasi' => $evaluasi,
            'provinsi_auth' => $provinsi_auth,
        ]);

        // return response()->json(
        //     $count_anggaran
        // );
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
