<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use PDF;

class SaranaOlahragaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->id_role == 1 || auth()->user()->id_role == 2) {
            $data = DB::table('t_sarana_prasarana')
                ->select('t_sarana_prasarana.id AS id', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan', 't_sarana_prasarana.nama_surveyor', 't_sarana_prasarana.jabatan_surveyor', 't_sarana_prasarana.jumlah_rt', 't_sarana_prasarana.jumlah_rw', 't_sarana_prasarana.jumlah_penduduk', 't_sarana_prasarana.dibuat_tanggal')
                ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_sarana_prasarana.kecamatan_id')
                ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_sarana_prasarana.desa_kelurahan_id')
                ->get();
        } elseif(auth()->user()->id_role == 3 || auth()->user()->id_role == 4) {

            if(auth()->user()->id_kecamatan != NULL && auth()->user()->id_desa_kelurahan != NULL){
                $data = DB::table('t_sarana_prasarana')
                ->select('t_sarana_prasarana.id AS id', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan', 't_sarana_prasarana.nama_surveyor', 't_sarana_prasarana.jabatan_surveyor', 't_sarana_prasarana.jumlah_rt', 't_sarana_prasarana.jumlah_rw', 't_sarana_prasarana.jumlah_penduduk', 't_sarana_prasarana.dibuat_tanggal')
                ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_sarana_prasarana.kecamatan_id')
                ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_sarana_prasarana.desa_kelurahan_id')
                ->where('t_sarana_prasarana.desa_kelurahan_id', auth()->user()->id_desa_kelurahan)
                ->get();
            }else{
                $data = DB::table('t_sarana_prasarana')
                ->select('t_sarana_prasarana.id AS id', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan', 't_sarana_prasarana.nama_surveyor', 't_sarana_prasarana.jabatan_surveyor', 't_sarana_prasarana.jumlah_rt', 't_sarana_prasarana.jumlah_rw', 't_sarana_prasarana.jumlah_penduduk', 't_sarana_prasarana.dibuat_tanggal')
                ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_sarana_prasarana.kecamatan_id')
                ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_sarana_prasarana.desa_kelurahan_id')
                ->where('t_sarana_prasarana.kecamatan_id', auth()->user()->id_kecamatan)
                ->get();
            }
        }

        return view('saranaOlahraga.index', compact('data'));
    }

    public function create()
    {
        $kecamatan = DB::table('m_kecamatan')->get();
        $desaKelurahan = DB::table('m_desa_kelurahan')->get();
        return view('SaranaOlahraga.create', compact('kecamatan', 'desaKelurahan'));
    }

    public function storeP1P2(Request $req)
    {

        // dd($req->all());
        $file = $req->file('demografi');
        $fileName = "-";
        if ($file) {
            $fileName = time() . "_" . $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/pendukung';
            $file->move($destinationPath, $fileName);
        }

        DB::table('t_sarana_prasarana')->insert([
            'kecamatan_id' => $req->kecamatan_id,
            'desa_kelurahan_id' => $req->desa_kelurahan_id,
            'nama_surveyor' => $req->nama_surveyor,
            'jabatan_surveyor' => $req->jabatan_surveyor,
            'alamat_Surveyor' => $req->alamat_surveyor,
            'no_telp_Surveyor' => $req->no_telp_surveyor,
            'email_desa_kel' => $req->email_desa_kel,
            'website_desa_kel' => $req->website_desa_kel,
            'jumlah_rt' => $req->jumlah_rt,
            'jumlah_rw' => $req->jumlah_rw,
            'jumlah_penduduk' => $req->jumlah_penduduk,
            'demografi' => $fileName,
        ]);

        $saranaOlahraga = DB::table('t_sarana_prasarana')->select('id')->orderByDesc('id')->first();

        Alert::success('Success', 'Data Berhasil Disimpan');
        return redirect()->route('sarana.createP3', ['id' => $saranaOlahraga->id]);
        // return view('SaranaOlahraga.createP3', compact('saranaOlahraga'));
    }

    public function createP3(Request $req)
    {
        $saranaOlahraga = DB::table('m_sarana')->get();
        $saranaPrasaranaId = $req->id;

        $t_sarana = DB::table('t_sarana')
            ->join('m_sarana', 'm_sarana.id', '=', 't_sarana.jenis_sarana')
            ->where('t_sarana.sarana_prasarana_id', $saranaPrasaranaId)
            ->get();

        return view('SaranaOlahraga.createP3', compact('saranaPrasaranaId', 'saranaOlahraga', 't_sarana'));
    }

    public function storeP3(Request $request)
    {
        // dd($request->all());
        $file = $request->file('lokasi');
        $fileName = "-";
        if ($file) {
            $fileName = time() . "_" . $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/pendukung';
            $file->move($destinationPath, $fileName);
        }

        DB::table('t_sarana')->insert([
            'sarana_prasarana_id' => $request->sarana_prasarana_id,
            'jenis_sarana' => $request->jenis_sarana,
            'tipe_sarana' => $request->tipe_sarana,
            'status_kepemilikan' => $request->status_kepemilikan,
            'nama_pemilik' => $request->nama_pemilik,
            'luas_lapang' => $request->luas_lapang,
            'kondisi_lapang' => $request->kondisi_lapang,
            'alamat_lokasi' => $request->alamat_lokasi,
            'foto_lokasi' => $fileName
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan');

        return redirect()->back();
    }

    public function createP4(Request $req)
    {
        $prasaranaOlahraga = DB::table('m_prasarana')->get();
        $saranaPrasaranaId = $req->id;

        $t_prasarana = DB::table('t_prasarana')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_prasarana.jenis_peralatan')
            ->where('t_prasarana.sarana_prasarana_id', $saranaPrasaranaId)
            ->get();

        return view('SaranaOlahraga.createP4', compact('saranaPrasaranaId', 'prasaranaOlahraga', 't_prasarana'));
    }

    public function storeP4(Request $request)
    {
        DB::table('t_prasarana')->insert([
            'sarana_prasarana_id' => $request->sarana_prasarana_id,
            'penerima_hibah' => $request->penerima_hibah,
            'jenis_penerima' => $request->jenis_penerima,
            'jenis_peralatan' => $request->jenis_peralatan,
            'jumlah' => $request->jumlah,
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan');

        return redirect()->back();
    }

    public function createP5(Request $req)
    {
        $cabangOlahraga = DB::table('m_cabang_olahraga')->get();
        $saranaPrasaranaId = $req->id;

        $t_kel_olahraga = DB::table('t_kelompok_olahraga')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_kelompok_olahraga.jenis_olahraga')
            ->where('t_kelompok_olahraga.sarana_prasarana_id', $saranaPrasaranaId)
            ->get();

        return view('SaranaOlahraga.createP5', compact('saranaPrasaranaId', 'cabangOlahraga', 't_kel_olahraga'));
    }

    public function storeP5(Request $request)
    {
        DB::table('t_kelompok_olahraga')->insert([
            'sarana_prasarana_id' => $request->sarana_prasarana_id,
            'jenis_olahraga' => $request->jenis_olahraga,
            'nama_club' => $request->nama_club,
            'alamat' => $request->alamat,
            'ketua_club' => $request->ketua_club,
            'status_club' => $request->status_club,
            'dibina_desa' => $request->dibina_desa,
            'diunggulkan_desa' => $request->diunggulkan_desa,
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan');

        return redirect()->back();
    }

    public function createP6(Request $req)
    {
        $cabangOlahraga = DB::table('m_cabang_olahraga')->get();
        $saranaPrasaranaId = $req->id;

        $t_prestasi_olahraga = DB::table('t_prestasi_olahraga')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_prestasi_olahraga.jenis_olahraga')
            ->where('t_prestasi_olahraga.sarana_prasarana_id', $saranaPrasaranaId)
            ->get();

        return view('SaranaOlahraga.createP6', compact('saranaPrasaranaId', 'cabangOlahraga', 't_prestasi_olahraga'));
    }

    public function storeP6(Request $request)
    {
        DB::table('t_prestasi_olahraga')->insert([
            'sarana_prasarana_id' => $request->sarana_prasarana_id,
            'nama' => $request->nama,
            'jenis_potensi' => $request->jenis_potensi,
            'jenis_olahraga' => $request->jenis_olahraga,
            'tingkat_prestasi' => $request->tingkat_prestasi,
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan');

        return redirect()->back();
    }

    public function createP7(Request $req)
    {
        $saranaPrasaranaId = $req->id;
        return view('SaranaOlahraga.createP7', compact('saranaPrasaranaId'));
    }

    public function storeP7(Request $request)
    {
    }

    public function show(Request $request)
    {
        $saranaOlahragaId = $request->id;

        $kecamatan = DB::table('m_kecamatan')->get();
        $desaKelurahan = DB::table('m_desa_kelurahan')->orderBy('desa_kelurahan', 'DESC')->get();

        $data = DB::table('t_sarana_prasarana')
            ->select('t_sarana_prasarana.id AS id', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan', 't_sarana_prasarana.nama_surveyor', 't_sarana_prasarana.jabatan_surveyor', 't_sarana_prasarana.alamat_surveyor', 't_sarana_prasarana.email_desa_kel', 't_sarana_prasarana.website_desa_kel', 't_sarana_prasarana.no_telp_surveyor', 't_sarana_prasarana.jumlah_rt', 't_sarana_prasarana.jumlah_rw', 't_sarana_prasarana.jumlah_penduduk', 't_sarana_prasarana.demografi', 't_sarana_prasarana.dibuat_tanggal')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_sarana_prasarana.kecamatan_id')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_sarana_prasarana.desa_kelurahan_id')
            ->where('t_sarana_prasarana.id', $saranaOlahragaId)
            ->first();

        $t_sarana = DB::table('t_sarana')
            ->select('t_sarana.*', 'm_sarana.nama_sarana')
            ->join('m_sarana', 'm_sarana.id', '=', 't_sarana.jenis_sarana')
            ->where('t_sarana.sarana_prasarana_id', $saranaOlahragaId)
            ->get();

        $m_sarana = DB::table('m_sarana')->get();

        $t_prasarana = DB::table('t_prasarana')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_prasarana.jenis_peralatan')
            ->where('t_prasarana.sarana_prasarana_id', $saranaOlahragaId)
            ->get();

        $t_kel_olahraga = DB::table('t_kelompok_olahraga')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_kelompok_olahraga.jenis_olahraga')
            ->where('t_kelompok_olahraga.sarana_prasarana_id', $saranaOlahragaId)
            ->get();

        $t_prestasi_olahraga = DB::table('t_prestasi_olahraga')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_prestasi_olahraga.jenis_olahraga')
            ->where('t_prestasi_olahraga.sarana_prasarana_id', $saranaOlahragaId)
            ->get();


        return view('SaranaOlahraga.show', compact('data', 'kecamatan', 'desaKelurahan', 't_sarana', 't_prasarana', 't_kel_olahraga', 't_prestasi_olahraga', 'm_sarana'));
    }

    public function exportPDF($id)
    {
        $kecamatan = DB::table('m_kecamatan')->get();
        $desaKelurahan = DB::table('m_desa_kelurahan')->orderBy('desa_kelurahan', 'DESC')->get();

        $data = DB::table('t_sarana_prasarana')
            ->select('t_sarana_prasarana.id AS id', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan', 't_sarana_prasarana.nama_surveyor', 't_sarana_prasarana.jabatan_surveyor', 't_sarana_prasarana.alamat_surveyor', 't_sarana_prasarana.email_desa_kel', 't_sarana_prasarana.website_desa_kel', 't_sarana_prasarana.no_telp_surveyor', 't_sarana_prasarana.jumlah_rt', 't_sarana_prasarana.jumlah_rw', 't_sarana_prasarana.jumlah_penduduk', 't_sarana_prasarana.demografi', 't_sarana_prasarana.dibuat_tanggal')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_sarana_prasarana.kecamatan_id')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_sarana_prasarana.desa_kelurahan_id')
            ->where('t_sarana_prasarana.id', $id)
            ->first();

        $t_sarana = DB::table('t_sarana')
            ->join('m_sarana', 'm_sarana.id', '=', 't_sarana.jenis_sarana')
            ->where('t_sarana.sarana_prasarana_id', $id)
            ->get();


        $t_prasarana = DB::table('t_prasarana')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_prasarana.jenis_peralatan')
            ->where('t_prasarana.sarana_prasarana_id', $id)
            ->get();

        $t_kel_olahraga = DB::table('t_kelompok_olahraga')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_kelompok_olahraga.jenis_olahraga')
            ->where('t_kelompok_olahraga.sarana_prasarana_id', $id)
            ->get();

        $t_prestasi_olahraga = DB::table('t_prestasi_olahraga')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_prestasi_olahraga.jenis_olahraga')
            ->where('t_prestasi_olahraga.sarana_prasarana_id', $id)
            ->get();

        $pdf = PDF::loadView('report', compact('data', 'kecamatan', 'desaKelurahan', 't_sarana', 't_prasarana', 't_kel_olahraga', 't_prestasi_olahraga'));
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->stream('graph.pdf');
    }

    public function editSaranaOlahraga($id)
    {
        $sarana = DB::table('t_sarana')->where('id', $id)->first();
        $m_sarana = DB::table('m_sarana')->get();
        return view('SaranaOlahraga.edit.saranaEdit', compact('sarana', 'm_sarana'));
    }

    public function storeSaranaOlahraga(Request $request)
    {
        // dd($request->all());
        $file = $request->file('lokasi');
        $fileName = "";
        if ($file) {
            $fileName = time() . "_" . $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/pendukung';
            $file->move($destinationPath, $fileName);
        }

        DB::table('t_sarana')->insert([
            'sarana_prasarana_id' => $request->sarana_prasarana_id,
            'jenis_sarana' => $request->jenis_sarana,
            'tipe_sarana' => $request->tipe_sarana,
            'status_kepemilikan' => $request->status_kepemilikan,
            'nama_pemilik' => $request->nama_pemilik,
            'luas_lapang' => $request->luas_lapang,
            'kondisi_lapang' => $request->kondisi_lapang,
            'alamat_lokasi' => $request->alamat_lokasi,
            'foto_lokasi' => $fileName
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan');

        return redirect()->back();
    }

    public function updateSaranaOlahraga(Request $request)
    {

        $file = $request->file('lokasi');
        $fileName = $request->old_lokasi;
        if ($file) {
            $fileName = time() . "_" . $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/pendukung';
            $file->move($destinationPath, $fileName);

            $existingFile = public_path() . '/images/pendukung/' . $request->old_lokasi;
            if (file_exists($existingFile)) {
                unlink(public_path() . '/images/pendukung/' . $request->old_lokasi);
            }
        }

        DB::table('t_sarana')->where('id', $request->id)->update([
            'jenis_sarana' => $request->jenis_sarana,
            'tipe_sarana' => $request->tipe_sarana,
            'status_kepemilikan' => $request->status_kepemilikan,
            'nama_pemilik' => $request->nama_pemilik,
            'luas_lapang' => $request->luas_lapang,
            'kondisi_lapang' => $request->kondisi_lapang,
            'alamat_lokasi' => $request->alamat_lokasi,
            'foto_lokasi' => $fileName
        ]);

        return redirect()->back();
    }

    public function deleteSaranaOlahraga($id)
    {
        $sarana = DB::table('t_sarana')->where('id', $id)->delete();

        Alert::success('Success', 'Data Berhasil Dihapus');
        return redirect()->back();
    }

    // Prestasi Olahraga
    public function prestasiOlahraga()
    {
        $prestasiOlahraga = DB::table('t_prestasi_olahraga')
            ->select('t_prestasi_olahraga.*', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan', 'm_cabang_olahraga.nama_cabang_olahraga')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_prestasi_olahraga.id_desa_kelurahan')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 'm_desa_kelurahan.kecamatan_id')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_prestasi_olahraga.jenis_olahraga')
            ->get();

        return view('admin.prestasi-olahraga.index', compact('prestasiOlahraga'));
    }

    public function prestasiOlahragaCreate()
    {
        $kecamatan = DB::table('m_kecamatan')->get();
        $cabangOlahraga = DB::table('m_cabang_olahraga')->orderBy('nama_cabang_olahraga', 'ASC')->get();
        return view('admin.prestasi-olahraga.create', compact('kecamatan', 'cabangOlahraga'));
    }

    public function prestasiOlahragaStore(Request $request)
    {

        $file = $request->file('foto');
        $fileName = "";
        if ($file) {
            $fileName = time() . "_" . $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/atlet';
            $file->move($destinationPath, $fileName);
        }

        $saranaPrasarana = DB::table('t_sarana_prasarana')
            ->where('kecamatan_id', $request->id_kecamatan)
            ->where('desa_kelurahan_id', $request->id_desa_kelurahan)
            ->first();

        DB::table('t_prestasi_olahraga')->insert([
            'sarana_prasarana_id' => $saranaPrasarana->id,
            'id_desa_kelurahan' => $request->id_desa_kelurahan,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'jenis_potensi' => $request->jenis_potensi,
            'jenis_olahraga' => $request->jenis_olahraga,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'foto' => $fileName,
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan');

        return redirect()->route('prestasiOlahraga.index');
    }

    public function prestasiOlahragaEdit($id)
    {
        $kecamatan = DB::table('m_kecamatan')->get();
        $desaKelurahan = DB::table('m_desa_kelurahan')->orderBy('desa_kelurahan')->get();
        $cabangOlahraga = DB::table('m_cabang_olahraga')->orderBy('nama_cabang_olahraga', 'ASC')->get();

        $detail_prestasi_olahraga = DB::table('t_detail_prestasi_olahraga')->select('t_detail_prestasi_olahraga.*', 'm_cabang_olahraga.nama_cabang_olahraga as cabang_olahraga')
                                    ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_detail_prestasi_olahraga.id_cabang_olahraga')
                                    ->where('t_detail_prestasi_olahraga.id_prestasi_olahraga', $id)->get();

        $prestasiOlahraga = DB::table('t_prestasi_olahraga')
            ->select('t_prestasi_olahraga.*', 'm_kecamatan.kecamatan','m_kecamatan.id AS id_kecamatan', 'm_desa_kelurahan.desa_kelurahan', 'm_cabang_olahraga.nama_cabang_olahraga')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_prestasi_olahraga.id_desa_kelurahan')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 'm_desa_kelurahan.kecamatan_id')
            ->join('m_cabang_olahraga', 'm_cabang_olahraga.id', '=', 't_prestasi_olahraga.jenis_olahraga')
            ->where('t_prestasi_olahraga.id', $id)
            ->first();

        return view('admin.prestasi-olahraga.edit', compact('kecamatan', 'desaKelurahan', 'cabangOlahraga','prestasiOlahraga','detail_prestasi_olahraga'));
    }

    public function prestasiOlahragaUpdate(Request $request)
    {

        $file = $request->file('foto');
        $fileName = $request->old_foto;
        if ($file) {
            $fileName = time() . "_" . $file->getClientOriginalName();
            $destinationPath = public_path() . '/images/atlet';
            $file->move($destinationPath, $fileName);

            $existingFile = public_path() . '/images/atlet/' . $request->old_foto;
            if (file_exists($existingFile)) {
                unlink(public_path() . '/images/atlet/' . $request->old_foto);
            }
        }

        DB::table('t_prestasi_olahraga')->where('id', $request->id)->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'jenis_potensi' => $request->jenis_potensi,
            'jenis_olahraga' => $request->jenis_olahraga,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'foto' => $fileName,
        ]);

        return redirect()->route('prestasiOlahraga.index');
    }

    public function prestasiOlahragaDelete($id)
    {
        $data = DB::table('t_prestasi_olahraga')->where('id', $id)->first();

        if ($data) {
            DB::table('t_prestasi_olahraga')->where('id', $id)->delete();
            $existingFile = public_path() . '/images/atlet/' . $data->foto;
            if (file_exists($existingFile)) {
                File::delete(public_path() . '/images/atlet/' . $data->foto);
            }

            Alert::success('Success', 'Data Berhasil Dihapus');
        }
        return redirect()->back();
    }

    public function detailPrestasiOlahragaStore(Request $request)
    {
        // dd($request->all());
        DB::table('t_detail_prestasi_olahraga')->insert([
            'id_prestasi_olahraga' => $request->id_prestasi_olahraga,
            'id_cabang_olahraga' => $request->id_cabang_olahraga,
            'tahun' => $request->tahun,
            'peringkat' => $request->peringkat,
            'tingkat_prestasi' => $request->tingkat_prestasi,
            'keterangan' => $request->keterangan,

        ]);

        return redirect()->back();
    }

    public function detailPrestasiOlahragaDelete($id)
    {
        DB::table('t_detail_prestasi_olahraga')->where('id', $id)->delete();
        return redirect()->back();
    }


}
