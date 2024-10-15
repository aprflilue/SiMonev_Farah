<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('pusat')){
            $admin_provs = User::select('users.*','provinces.name as provinsi_name')
                ->join('provinces', 'provinces.id' ,'=','users.provinsi_id')
                ->where('role_id', 2)
                ->get();
            
            $provinces= Province::all();
        
        }elseif(Gate::allows('provinsi')){
            $admin_provs = User::select('users.*','provinces.name as provinsi_name')
                ->join('provinces', 'provinces.id' ,'=','users.provinsi_id')
                ->where('role_id', 2)
                ->where('users.provinsi_id', Auth::user()->provinsi_id)
                ->get();
            
            $provinces= Province::where('provinces.id', Auth::user()->provinsi_id)
                ->get();
        }
        
        $provinsi_auth = User::join('provinces', 'provinces.id' ,'=','users.provinsi_id')
            ->select('provinces.name')
            ->where('users.provinsi_id', Auth::user()->provinsi_id)
            ->first();
        
        return view('dashboard.admin.index', [
            'title' => "Admin Provinsi",
            'admins' => $admin_provs,
            'provinces' => $provinces,
            'provinsi_auth' => $provinsi_auth,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'provinsi_id' => 'required',
            "username"  => 'required|min:3|unique:users|max:20',
            'email' => 'required|email:dns|unique:users|max:255',
            'password'  => 'required|min:5|max:255',
        ]);

        $validatedData['role_id'] = 2;

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        Alert::success('Input Sukses!', 'Data Admin Provinsi Berhasil Ditambahkan');
        return redirect()->to('/dashboard/admin');
        // return redirect('/dashboard/admin')->with('success', 'Data admin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return json_encode($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $rules = [
            'name' => 'required|max:255',
            'provinsi_id' => 'required',
            "username"  => 'required|min:3|unique:users|max:10',
            'email' => 'required|email:dns|unique:users|max:255',
        ];

        $validatedData = $request->validate($rules);
        User::where('id', $admin->id)
            ->update($validatedData);

        Alert::success('Ubah Data Sukses!', 'Data Admin berhasil diubah');
        return redirect()->back();
        // return redirect('/dashboard/admin')->with('success', 'Data admin berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        User::destroy($admin->id);
        return redirect('/dashboard/admin')->with('deleted', 'Hapus data admin berhasil');
    }


}