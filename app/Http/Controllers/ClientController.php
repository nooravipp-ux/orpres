<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(){
        $kecamatan = DB::table('m_kecamatan')->count();
        $desaKelurahan = DB::table('m_desa_kelurahan')->count();
        $sarana = DB::table('t_sarana')->count();
        $potensiAtlet = DB::table('t_prestasi_olahraga')->count();

        $dataKecamatan = DB::table('m_kecamatan')->get();
        $dataDesaKelurahan = DB::table('m_desa_kelurahan')->orderBy('desa_kelurahan', 'asc')->get();

        return view('welcome', compact('kecamatan', 'desaKelurahan','sarana','potensiAtlet', 'dataKecamatan', 'dataDesaKelurahan'));
    }

    public function detail(Request $request){

        $saranaOlahraga = DB::table('t_sarana_prasarana')
                            ->select('id')
                            ->where('kecamatan_id', $request->kecamatan_id)
                            ->where('desa_kelurahan_id', $request->desa_kelurahan_id)
                            ->first();

        $data = DB::table('t_sarana_prasarana')
            ->select('t_sarana_prasarana.id AS id', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan', 't_sarana_prasarana.nama_surveyor', 't_sarana_prasarana.jabatan_surveyor', 't_sarana_prasarana.alamat_surveyor', 't_sarana_prasarana.email_desa_kel', 't_sarana_prasarana.website_desa_kel', 't_sarana_prasarana.no_telp_surveyor', 't_sarana_prasarana.jumlah_rt', 't_sarana_prasarana.jumlah_rw', 't_sarana_prasarana.jumlah_penduduk', 't_sarana_prasarana.demografi', 't_sarana_prasarana.dibuat_tanggal')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_sarana_prasarana.kecamatan_id')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_sarana_prasarana.desa_kelurahan_id')
            ->where('t_sarana_prasarana.id', $saranaOlahraga->id)
            ->first();

        $t_sarana = DB::table('t_sarana')
            ->join('m_sarana', 'm_sarana.id', '=', 't_sarana.jenis_sarana')
            ->where('t_sarana.sarana_prasarana_id', $saranaOlahraga->id)
            ->get();

        $t_prasarana = DB::table('t_prasarana')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_prasarana.jenis_peralatan')
            ->where('t_prasarana.sarana_prasarana_id', $saranaOlahraga->id)
            ->get();

        $t_kel_olahraga = DB::table('t_kelompok_olahraga')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_kelompok_olahraga.jenis_olahraga')
            ->where('t_kelompok_olahraga.sarana_prasarana_id', $saranaOlahraga->id)
            ->get();

        $t_prestasi_olahraga = DB::table('t_prestasi_olahraga')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_prestasi_olahraga.jenis_olahraga')
            ->where('t_prestasi_olahraga.sarana_prasarana_id', $saranaOlahraga->id)
            ->get();

        return view('datakeolahragaan', compact('data','t_sarana', 't_prasarana', 't_kel_olahraga', 't_prestasi_olahraga'));

    }
}
