<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class SaranaPrasaranaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $prasarana = DB::table('m_prasarana')->get();
        $sarana = DB::table('m_sarana')->get();
        return view('sarana_prasarana.index', compact('prasarana', 'sarana'));
    }

    public function storeSarana(Request $request){
        DB::table('m_sarana')->insert([
            'nama_sarana' => $request->nama_sarana,
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan');
        return redirect()->route('saranaPrasarana.index');
    }

    public function storePrasarana(Request $request){
        DB::table('m_prasarana')->insert([
            'nama_prasarana' => $request->nama_prasarana,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'satuan' => $request->satuan
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan');
        return redirect()->route('saranaPrasarana.index');

    }

    public function editPrasarana($id){
        $prasarana = DB::table('m_prasarana')->where('id', $id)->first();

        return view('sarana_prasarana.edit_prasarana', compact('prasarana'));

    }
    public function updatePrasarana(Request $request){

        DB::table('m_prasarana')->where('id', $request->id)->update([
            'nama_prasarana' => $request->nama_prasarana,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'satuan' => $request->satuan
        ]);

        return redirect()->back();

    }

    public function editSarana($id){
        $sarana = DB::table('m_sarana')->where('id', $id)->first();

        return view('sarana_prasarana.edit_sarana', compact('sarana'));

    }
    public function updateSarana(Request $request){
        DB::table('m_sarana')->where('id', $request->id)->update([
            'nama_sarana' => $request->nama_sarana
        ]);

        return redirect()->back();

    }
}
