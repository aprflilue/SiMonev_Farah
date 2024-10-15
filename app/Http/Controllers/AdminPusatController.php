<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPusatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'title' => 'Admin Pusat',
            'users' => User::where('role_id', 1)
                ->get()
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
            'name'      => 'required|max:255',
            "username"  => 'required|min:3|unique:users|max:20',
            'email'     => 'required|email:dns|unique:users|max:255',
            'password'  => 'required|min:5|max:255',
        ]);
        $validatedData['role_id'] = 1;

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        Alert::success('Input Sukses!', 'Data Admin Pusat Berhasil Ditambahkan');
        return redirect()->to('/dashboard/users');
        // return redirect('/dashboard/users')->with('success', 'Data Admin Pusat berhasil ditambahkan');
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
    public function update(Request $request, User $user)
    {
        // return $request;
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email:dns',
            'provinsi_id' => 'required',
        ];

        if ($request->username !== $user->username) {
            $rules['username'] = 'required|min:3|unique:users|max:10';
        }

        $validatedData = $request->validate($rules);
        User::where('id', $user->id)
            ->update($validatedData);

        Alert::success('Ubah Data Sukses!', 'Data Admin berhasil diubah');
        return redirect()->back();
        // return redirect('/dashboard/users')->with('success', 'Data Admin Pusat berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('deleted', 'Hapus data Admin Pusat berhasil');
    }

}
