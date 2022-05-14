<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(){
        $pengguna = DB::table('users')
                    ->select('users.id','users.name', 'users.email', 'm_organisasi_lembaga.nama_organisasi')
                    ->leftJoin('m_organisasi_lembaga', 'm_organisasi_lembaga.id', '=', 'users.id_organisasi_lembaga')
                    ->get();
        $organisasiLembaga = DB::table('m_organisasi_lembaga')->get();
        $roles = DB::table('m_role')->get();
        $kecamatan = DB::table('m_kecamatan')->get();
        $kelurahan = DB::table('m_desa_kelurahan')->orderBy('desa_kelurahan', 'asc')->get();
        return view('pengguna.index', compact('pengguna', 'roles','kecamatan','kelurahan','organisasiLembaga'));
    }

    public function store(Request $request){
        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'id_role' => $request->role_id,
            'id_kecamatan' => $request->kecamatan_id,
            'id_desa_kelurahan' => $request->desa_kelurahan_id,
            'id_organisasi_lembaga' => $request->id_organisasi_lembaga,
            'password' => Hash::make('orpres1234')
        ]);

        return redirect()->back();
    }

    public function edit($id){
        $roles = DB::table('m_role')->get();
        $kecamatan = DB::table('m_kecamatan')->get();
        $kelurahan = DB::table('m_desa_kelurahan')->orderBy('desa_kelurahan', 'asc')->get();
        $user = DB::table('users')->where('id', $id)->first();
        $organisasiLembaga = DB::table('m_organisasi_lembaga')->get();
        return view('pengguna.edit', compact('user','roles','kecamatan', 'kelurahan','organisasiLembaga'));
    }

    public function update(Request $request){

        User::where('id', $request->id)->update([
            'name' => $request->username,
            'email' => $request->email,
            'id_role' => $request->role_id,
            'id_kecamatan' => $request->kecamatan_id,
            'id_desa_kelurahan' => $request->desa_kelurahan_id,
            'id_organisasi_lembaga' => $request->id_organisasi_lembaga,
        ]);

        return redirect()->route('users.index');
    }

    public function delete($id){
        User::where('id', $id)->delete();

        Alert::success('Success', 'Data Berhasil Dihapus');
        return redirect()->back();

    }
}
