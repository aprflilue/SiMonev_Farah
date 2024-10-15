<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Data_Kelompok;
use App\Models\Dekon;
use App\Models\EvaluasiA;
use App\Models\Tp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::where('users.role_id', 1)->count();
        $admins = User::where('users.role_id', 2)->count();
        $uph = Data_Kelompok::count();
        $tp = Tp::all();
        $tp_all = Data_Kelompok::where('data__kelompoks.jenis_bantuan','TP')->count();
        $dekon = Dekon::all();
        $dekon_all = Data_Kelompok::where('data__kelompoks.jenis_bantuan','Dekon')->count();
        $anggaran = Anggaran::select(DB::raw('count(anggarans.data_kelompok_id) as total'))->groupby('anggarans.data_kelompok_id')->get();
        $anggaran_all = Data_Kelompok::where('data__kelompoks.jenis_bantuan','Anggaran')->count();
        $evaluasi = EvaluasiA::all();

        $admin_update = User::where('users.role_id', 1)->orderby('users.created_at', 'desc')->first();
        $admins_update = User::where('users.role_id', 2)->orderby('users.created_at', 'desc')->first();
        $uph_update = Data_Kelompok::orderby('data__kelompoks.created_at', 'desc')->first();
        $tp_update = Tp::orderby('tps.created_at', 'desc')->first();
        $dekon_update = Dekon::orderby('dekons.created_at', 'desc')->first();
        $anggaran_update = Anggaran::orderby('anggarans.created_at', 'desc')->first();
        $evaluasi_update = EvaluasiA::orderby('evaluasi_a_s.created_at', 'desc')->first();


        $users = User::leftjoin('provinces','provinces.id','=','users.provinsi_id')
        ->select('users.name','users.provinsi_id','provinces.name as provinsi_name')
        ->orderby('users.created_at','desc')
        ->limit(5)
        ->get();

        $provinsi = Data_Kelompok::join('provinces','provinces.id','=','data__kelompoks.provinsi_id')
            ->select(DB::raw("provinces.name as provinsi_name ,count(data__kelompoks.provinsi_id) as count_provinsi"))
            ->groupby('provinces.name')
            ->orderby(DB::raw('COUNT(*)'),'DESC')
            ->orderby('provinces.id','asc')
            ->limit(5)
            ->get();

        if(Gate::allows('pusat')){
    
            $tp_tabel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('tps','tps.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,tps.data_kelompok_id as status'))
                ->where('data__kelompoks.jenis_bantuan','tp')
                ->where('tps.data_kelompok_id', null)
                ->orderBy('data__kelompoks.created_at','desc')
                ->limit(5)
                ->get();

            $dekon_tabel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('dekons','dekons.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,dekons.data_kelompok_id as status'))
                ->where('data__kelompoks.jenis_bantuan','dekon')
                ->where('dekons.data_kelompok_id', null)
                ->orderBy('data__kelompoks.created_at','desc')
                ->limit(5)
                ->get();
            
            $anggaran_tabel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('anggarans','anggarans.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.id, data__kelompoks.provinsi_id , data__kelompoks.nama , data__kelompoks.komoditi, data__kelompoks.tahun_bantuan, provinces.name as provinsi_name, count(anggarans.data_kelompok_id) as total'))
                ->groupBy('data__kelompoks.id', 'data__kelompoks.provinsi_id','data__kelompoks.nama','data__kelompoks.komoditi','data__kelompoks.tahun_bantuan','provinces.name')
                ->where('data__kelompoks.jenis_bantuan','anggaran')
                ->where('anggarans.data_kelompok_id', null)
                ->orderBy('data__kelompoks.created_at','desc')
                ->limit(5)
                ->get();

            $evaluasi_tabel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('evaluasi_a_s','evaluasi_a_s.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,evaluasi_a_s. data_kelompok_id as status'))
                ->where('data_kelompok_id',null)
                ->orderBy('data__kelompoks.created_at','desc')
                ->limit(5)
                ->get();
        }elseif(Gate::allows('provinsi')){
            $tp_tabel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('tps','tps.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,tps.data_kelompok_id as status'))
                ->where('data__kelompoks.jenis_bantuan','tp')
                ->where('tps.data_kelompok_id', null)
                ->orderBy('data__kelompoks.created_at','desc')
                ->where('data__kelompoks.provinsi_id', Auth::user()->provinsi_id)
                ->limit(5)
                ->get();

            $dekon_tabel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('dekons','dekons.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,dekons.data_kelompok_id as status'))
                ->where('data__kelompoks.jenis_bantuan','dekon')
                ->where('dekons.data_kelompok_id', null)
                ->orderBy('data__kelompoks.created_at','desc')
                ->where('data__kelompoks.provinsi_id', Auth::user()->provinsi_id)
                ->limit(5)
                ->get();
            
            $anggaran_tabel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('anggarans','anggarans.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.id, data__kelompoks.provinsi_id , data__kelompoks.nama , data__kelompoks.komoditi, data__kelompoks.tahun_bantuan, provinces.name as provinsi_name, count(anggarans.data_kelompok_id) as total'))
                ->groupBy('data__kelompoks.id', 'data__kelompoks.provinsi_id','data__kelompoks.nama','data__kelompoks.komoditi','data__kelompoks.tahun_bantuan','provinces.name')
                ->where('data__kelompoks.jenis_bantuan','anggaran')
                ->where('anggarans.data_kelompok_id', null)
                ->orderBy('data__kelompoks.created_at','desc')
                ->where('data__kelompoks.provinsi_id', Auth::user()->provinsi_id)
                ->limit(5)
                ->get();

            $evaluasi_tabel = Data_Kelompok::join('provinces', 'provinces.id' ,'=','data__kelompoks.provinsi_id')
                ->leftjoin('evaluasi_a_s','evaluasi_a_s.data_kelompok_id','=','data__kelompoks.id')
                ->select(DB::raw('data__kelompoks.*, provinces.name as provinsi_name,evaluasi_a_s. data_kelompok_id as status'))
                ->where('data_kelompok_id',null)
                ->orderBy('data__kelompoks.created_at','desc')
                ->where('data__kelompoks.provinsi_id', Auth::user()->provinsi_id)
                ->limit(5)
                ->get();
        }

        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();

        $dataPoints = [];

         foreach ($provinsi as $provinsi) {

            $dataPoints[] = array(
                "name" => $provinsi['provinsi_name'],
                "y" => $provinsi['count_provinsi'],
                "drilldown" => $provinsi['provinsi_name'],
            );
        }

        return view('dashboard.index', [
            'title' => "Dashboard Admin | Home",
            'admin' => $admin,
            'admins' => $admins,
            'admin_update' => $admin_update,
            'admins_update' => $admins_update,
            'uph' => $uph,
            'uph_update' => $uph_update,
            'tp' => $tp,
            'tp_all' => $tp_all,
            'tp_update' => $tp_update,
            'dekon' => $dekon,
            'dekon_all' => $dekon_all,
            'dekon_update' => $dekon_update,
            'anggaran' => $anggaran,
            'anggaran_all' => $anggaran_all,
            'anggaran_update' => $anggaran_update,
            'evaluasi' => $evaluasi,
            'evaluasi_update' => $evaluasi_update,
            'users' => $users,
            'tp_tabel' => $tp_tabel,
            'dekon_tabel' => $dekon_tabel,
            'anggaran_tabel' => $anggaran_tabel,
            'evaluasi_tabel' => $evaluasi_tabel,
            'provinsi_auth' => $provinsi_auth,
            "provinsi" => json_encode($dataPoints),
        ]);
        // return response()->json(
        //     $provinsi_auth
        // );
    }

}
