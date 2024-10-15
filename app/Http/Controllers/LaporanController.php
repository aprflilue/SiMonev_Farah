<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Data_Kelompok;
use App\Models\Dekon;
use App\Models\EvaluasiA;
use App\Models\Province;
use App\Models\Tp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LaporanController extends Controller
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
                ->limit(5)
                ->get();
            
            $data_kelompoks = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
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
                ->limit(5)
                ->get();
            
            $data_kelompoks = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
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
        
        
        // ======== EVALUASI ==========
        if(Gate::allows('pusat')){

            $data_kel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
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
                ->limit(5)
                ->get();
            
            $data_kels = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
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
            $data_kel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
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
                ->limit(5)
                ->get();
            
            $data_kels = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
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
                ->where('data__kelompoks.provinsi_id',Auth::user()->provinsi_id)
                ->orderBy('data__kelompoks.created_at','desc')
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

        return view('dashboard.laporan.index', [
            'title' => 'Laporan',
            'data_kelompok' => $data_kelompok,
            'data_kelompoks' => $data_kelompoks,
            'data_kel' => $data_kel,
            'data_kels' => $data_kels,
            'tp' => $tp,
            'dekon' => $dekon,
            'anggaran' => $anggaran,
            'evaluasi' => $evaluasi,
            'provinsi_auth' => $provinsi_auth,
        ]);

        // return response()->json(
        //     $data_kelompoks, 
        // );
    }
}
