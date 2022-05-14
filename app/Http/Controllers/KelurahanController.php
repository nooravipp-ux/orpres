<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
{
    public function index(){
        $data = DB::table('m_desa_kelurahan')->select('m_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan', 'm_desa_kelurahan.id')
                ->join('m_kecamatan', 'm_kecamatan.id', '=', 'm_desa_kelurahan.kecamatan_id')
                ->get();

        return view('kelurahan.index', compact('data'));
    }

    public function store(Request $req){

        return view('kelurahan.index', compact('data'));
    }

    public function edit($id){
        $kelurahan = DB::table('m_desa_kelurahan')
                ->where('m_desa_kelurahan.id', $id)
                ->first();
        return view('kelurahan.edit', compact('kelurahan'));
    }

    public function update(Request $req){
        DB::table('m_desa_kelurahan')->where('id', $req->id)->update([
            'desa_kelurahan' => $req->desa_kelurahan,
            'nama_kades' => $req->nama_kades,
            'email' => $req->email,
            'web' => $req->web,
            'jumlah_rt' => $req->jumlah_rt,
            'jumlah_rw' => $req->jumlah_rw,
            'jumlah_penduduk' => $req->jumlah_penduduk,
            'sosial_media' => $req->sosial_media,
            'demografi_desa' => $req->demografi_desa,
            'titik_lokasi' => $req->titik_lokasi,
            'kategori' => $req->kategori
        ]);

        return redirect()->back();
    }

    public function delete($id){

        return view('kelurahan.index', compact('data'));
    }

    //Services

    public function getKelurahanByIdKecamatan($id){
        $data = DB::table('m_desa_kelurahan')->where('kecamatan_id', $id)->orderBy('desa_kelurahan')->get();

        return response()->json($data);
    }
}
