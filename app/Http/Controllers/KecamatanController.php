<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{

    public function index(){
        $data = DB::table('m_kecamatan')->get();

        return view('kecamatan.index', compact('data'));
    }

    public function store(Request $req){

        return view('kecamatan.index', compact('data'));
    }

    public function edit($id){

        return view('kecamatan.index', compact('data'));
    }

    public function update(Request $req){

        return view('kecamatan.index', compact('data'));
    }

    public function delete($id){

        return view('kecamatan.index', compact('data'));
    }
}
