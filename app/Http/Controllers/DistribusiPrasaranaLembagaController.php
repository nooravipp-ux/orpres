<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class DistribusiPrasaranaLembagaController extends Controller
{
    // Enumeration status : 1 = DRAFT, 2 = SUBMITTED, 3 = APPROVED, 4 = REJECTED, 5 = DONE

    public function index()
    {
        if (auth()->user()->id_role == 1 || auth()->user()->id_role == 2) {
            $distribusiPrasarana = DB::table('t_distribusi_prasarana_lembaga')
                ->orderBy('t_distribusi_prasarana_lembaga.tanggal_pengajuan', 'desc')
                ->get();
        } else {
            if (auth()->user()->id_organisasi_lembaga == 3 || auth()->user()->id_organisasi_lembaga == 4 || auth()->user()->id_organisasi_lembaga == 5) {
                $distribusiPrasarana = DB::table('t_distribusi_prasarana_lembaga')
                    ->where('nama_lembaga', auth()->user()->id_role)
                    ->orderBy('t_distribusi_prasarana_lembaga.tanggal_pengajuan', 'desc')
                    ->get();
            } else {
            }
            $distribusiPrasarana = DB::table('t_distribusi_prasarana_lembaga')
                ->where('nama_lembaga', auth()->user()->id_role)
                ->orderBy('t_distribusi_prasarana_lembaga.tanggal_pengajuan', 'desc')
                ->get();
        }

        return view('admin.pengajuan-lembaga.index', compact('distribusiPrasarana'));
    }

    public function create()
    {
        $organisasiLembaga = DB::table('m_organisasi_lembaga')->get();
        return view('admin.pengajuan-lembaga.create', compact('organisasiLembaga'));
    }

    public function store(Request $request)
    {

        $fileLampiran1 = $request->file('file_lampiran_1');
        $fileLampiran1FileName = "";
        if ($fileLampiran1) {
            $fileLampiran1FileName = time() . "_" . $fileLampiran1->getClientOriginalName();
            $destinationPath = public_path() . '/images/doc_pengajuan_lembaga';
            $fileLampiran1->move($destinationPath, $fileLampiran1FileName);
        }

        $fileLampiran2 = $request->file('file_lampiran_2');
        $fileLampiran2FileName = "";
        if ($fileLampiran2) {
            $fileLampiran2FileName = time() . "_" . $fileLampiran2->getClientOriginalName();
            $destinationPath = public_path() . '/images/doc_pengajuan_lembaga';
            $fileLampiran2->move($destinationPath, $fileLampiran2FileName);
        }

        $fileLampiran3 = $request->file('file_lampiran_3');
        $fileLampiran3FileName = "";
        if ($fileLampiran3) {
            $fileLampiran3FileName = time() . "_" . $fileLampiran3->getClientOriginalName();
            $destinationPath = public_path() . '/images/doc_pengajuan_lembaga';
            $fileLampiran3->move($destinationPath, $fileLampiran3FileName);
        }

        $data = DB::table('t_distribusi_prasarana_lembaga')->insert([
            "kode" => "",
            "nama_lembaga" => $request->nama_lembaga,
            "tanggal_pengajuan" => $request->tanggal_pengajuan,
            "penanggung_jawab" => $request->penanggung_jawab,
            "file_lampiran_1" => $fileLampiran1FileName,
            "file_lampiran_2" => $fileLampiran2FileName,
            "file_lampiran_3" => $fileLampiran3FileName,
            "status" => 1,
            "dibuat_oleh" => auth()->user()->name,
            "dibuat_tanggal" => date('Y-m-d H:i:s')
        ]);

        $dataId = DB::table('t_distribusi_prasarana_lembaga')->orderBy('dibuat_tanggal', 'desc')->first();

        Alert::success('Success', 'Data Berhasil Disimpan');
        return redirect()->route('distribusiPrasaranaLembaga.edit', ['id' => $dataId->id]);
    }

    public function edit($id)
    {
        $distribusiPrasaranaLembaga = DB::table('t_distribusi_prasarana_lembaga')->where('id', $id)->first();
        $distribusiPrasaranaLembagaDetail = DB::table('t_distribusi_prasarana_lembaga_detail')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_distribusi_prasarana_lembaga_detail.id_prasarana')
            ->where('t_distribusi_prasarana_lembaga_detail.id_distribusi_prasarana_lembaga', $id)->get();
        $prasarana = DB::table('m_prasarana')->get();

        return view('admin.pengajuan-lembaga.edit', compact('distribusiPrasaranaLembaga', 'distribusiPrasaranaLembagaDetail', 'prasarana'));
    }

    public function submit(Request $request)
    {
        DB::table('t_distribusi_prasarana_lembaga')->where('id', $request->id_distribusi_prasarana)->update([
            'status' => 2,
            'submitted_date' => date('Y-m-d H:i:s')
        ]);
        Alert::success('Success', 'Data Pengajuan Terkirim !');
        return redirect()->back();
    }

    public function approve()
    {
    }

    public function reject()
    {
    }

    public function createDetail()
    {
    }

    public function storeDetail(Request $request)
    {
        $data = DB::table('t_distribusi_prasarana_lembaga_detail')->insert([
            "id_distribusi_prasarana_lembaga" => $request->id_distribusi_prasarana_lembaga,
            "id_prasarana" => $request->id_prasarana,
            "jumlah" => $request->jumlah,
        ]);

        return redirect()->route('distribusiPrasaranaLembaga.edit', ['id' => $request->id_distribusi_prasarana_lembaga]);
    }

    public function editDetail()
    {
    }

    public function updateDetail()
    {
    }

    public function hapusDetail($idDistribusiPrasaranaLembaga, $id)
    {
        DB::table('t_distribusi_prasarana_lembaga_detail')->where('id', $id)->delete();

        return redirect()->route('distribusiPrasaranaLembaga.edit', ['id' => $idDistribusiPrasaranaLembaga]);
    }

    public function findRoleName($idRole)
    {
        $user = DB::table('users')->join('m_role', 'm_role.id', '=', 'users.id_role')->where('users.id_role', auth()->user()->id_role)->first();
        return $user->role;
    }
}
