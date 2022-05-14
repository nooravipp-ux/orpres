<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CabangOlahraga;
use Illuminate\Support\Facades\DB;

class CabangOlahragaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cabor = DB::table('m_cabang_olahraga')->get();
        return view('cabang-olahraga.index', compact('cabor'));
    }

    public function store(Request $request)
    {
        DB::table('m_cabang_olahraga')->insert([
            'nama_cabang_olahraga' => $request->nama_cabang_olahraga,
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        $cabor = DB::table('m_cabang_olahraga')->where('id', $id)->first();
        return view('cabang-olahraga.edit', compact('cabor'));
    }

    public function update(Request $request)
    {
        DB::table('m_cabang_olahraga')->where('id', $request->id)->update([
            'nama_cabang_olahraga' => $request->nama_cabang_olahraga,
        ]);
        return redirect()->back();
    }
}
