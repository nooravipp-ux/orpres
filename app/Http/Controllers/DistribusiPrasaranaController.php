<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use PDF;

class DistribusiPrasaranaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kecamatan = DB::table('m_kecamatan')->get();
        $desaKelurahan = DB::table('m_desa_kelurahan')->get();
        $distribusiPrasarana = DB::table('t_distribusi_prasarana')
            ->select('t_distribusi_prasarana.*', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_distribusi_prasarana.id_kecamatan')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_distribusi_prasarana.id_desa_kelurahan')
            ->where('t_distribusi_prasarana.status', 'APPROVED')
            ->orWhere('t_distribusi_prasarana.status', 'DONE')
            ->orderBy('t_distribusi_prasarana.dibuat_tanggal', 'desc')
            ->get();
        return view('admin.distribusi-prasarana.index', compact('kecamatan', 'desaKelurahan', 'distribusiPrasarana'));
    }

    public function verifyForm(Request $request)
    {
        $distribusiId = $request->id;
        $prasarana = DB::table('m_prasarana')->get();
        $distribusi = DB::table('t_distribusi_prasarana')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_distribusi_prasarana.id_kecamatan')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_distribusi_prasarana.id_desa_kelurahan')
            ->where('t_distribusi_prasarana.id', $distribusiId)
            ->first();
        $detailDistribusi = DB::table('t_detail_distribusi_prasarana')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_detail_distribusi_prasarana.id_prasarana')
            ->where('t_detail_distribusi_prasarana.id_distribusi_prasarana', $distribusiId)
            ->get();
        return view('admin.distribusi-prasarana.verifyForm', compact('prasarana', 'distribusiId', 'distribusi', 'detailDistribusi'));
    }

    public function verified(Request $request)
    {
        DB::table('t_distribusi_prasarana')->where('id', $request->id_distribusi_prasarana)->update([
            "status" => 3
        ]);
        Alert::success('Success', 'Data Sudah Terverifikasi');
        return redirect()->back();
    }

    public function approveForm(Request $request)
    {
        $distribusiId = $request->id;
        $prasarana = DB::table('m_prasarana')->get();
        $distribusi = DB::table('t_distribusi_prasarana')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_distribusi_prasarana.id_kecamatan')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_distribusi_prasarana.id_desa_kelurahan')
            ->where('t_distribusi_prasarana.id', $distribusiId)
            ->first();
        $detailDistribusi = DB::table('t_detail_distribusi_prasarana')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_detail_distribusi_prasarana.id_prasarana')
            ->where('t_detail_distribusi_prasarana.id_distribusi_prasarana', $distribusiId)
            ->get();
        return view('admin.distribusi-prasarana.approveForm', compact('prasarana', 'distribusiId', 'distribusi', 'detailDistribusi'));
    }

    public function approved(Request $request)
    {
        DB::table('t_distribusi_prasarana')->where('id', $request->id_distribusi_prasarana)->update([
            'status' => 'APPROVED',
            'approved_date' => date('Y-m-d H:i:s'),
        ]);
        Alert::success('Success', 'Data Approved !');
        return redirect()->route('distribusiPrasarana.index');
    }

    public function reject(Request $request)
    {
        DB::table('t_distribusi_prasarana')->where('id', $request->id_distribusi_prasarana)->update([
            'status' => 'REJECTED'
        ]);
        Alert::success('Success', 'Data Rejected !');
        return redirect()->route('distribusiPrasarana.index');
    }

    public function submit(Request $request)
    {
        DB::table('t_distribusi_prasarana')->where('id', $request->id_distribusi_prasarana)->update([
            'status' => 'SUBMITTED'
        ]);
        Alert::success('Success', 'Data Pengajuan Terkirim !');
        return redirect()->back();
    }

    public function done(Request $request)
    {
        // dd($request->all());
        DB::table('t_detail_distribusi_prasarana')->where('id_distribusi_prasarana', $request->id_distribusi_prasarana)->update([
            'status' => 'DONE'
        ]);

        DB::table('t_distribusi_prasarana')->where('id', $request->id_distribusi_prasarana)->update([
            'status' => 'DONE'
        ]);
        Alert::success('Success', 'Prasarana Sudah Diserahkan !');
        return redirect()->back();
    }



    public function create(Request $request)
    {
        $distribusiId = $request->id;
        $prasarana = DB::table('m_prasarana')->get();
        $detailDistribusi = DB::table('t_detail_distribusi_prasarana')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_detail_distribusi_prasarana.id_prasarana')
            ->where('t_detail_distribusi_prasarana.id_distribusi_prasarana', $distribusiId)
            ->get();
        return view('admin.distribusi-prasarana.create', compact('prasarana', 'distribusiId', 'detailDistribusi'));
    }

    public function store(Request $request)
    {
        $proposalFile = $request->file('file_proposal');
        $proposalFileName = "-";
        if ($proposalFile) {
            $proposalFileName = time() . "_" . $proposalFile->getClientOriginalName();
            $destinationPath = public_path() . '/images/doc_pengajuan';
            $proposalFile->move($destinationPath, $proposalFileName);
        }

        $skFile = $request->file('file_sk_kelompok');
        $skFileName = "-";
        if ($skFile) {
            $skFileName = time() . "_" . $skFile->getClientOriginalName();
            $destinationPath = public_path() . '/images/doc_pengajuan';
            $skFile->move($destinationPath, $skFileName);
        }

        $saranaFile = $request->file('file_foto_sarana');
        $saranaFileName = "-";
        if ($saranaFile) {
            $saranaFileName = time() . "_" . $saranaFile->getClientOriginalName();
            $destinationPath = public_path() . '/images/doc_pengajuan';
            $saranaFile->move($destinationPath, $saranaFileName);
        }

        $data = DB::table('t_distribusi_prasarana')->insert([
            "kode" => "",
            "tanggal" => date("Y/m/d"),
            "id_kecamatan" => $request->id_kecamatan,
            "id_desa_kelurahan" => $request->id_desa_kelurahan,
            "periode_tahun" => $request->periode_tahun,
            "file_proposal" => $proposalFileName,
            "file_sk_kelompok" => $skFileName,
            "file_foto_sarana" => $saranaFileName,
            "status" => "DRAFT",
            "submited_date" => date('Y-m-d H:i:s'),
            "dibuat_oleh" => auth()->user()->name
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan');
        return redirect()->route('distribusiPrasarana.pengajuan');
    }

    public function storeDetail(Request $request)
    {
        $data = DB::table('t_detail_distribusi_prasarana')->insert([
            "lembaga_penerima" => $request->lembaga_penerima,
            "nama_penerima" => $request->nama_penerima,
            "alamat_lembaga" => $request->alamat_lembaga,
            "id_distribusi_prasarana" => $request->id_distribusi_prasarana,
            "id_prasarana" => $request->id_prasarana,
            "jumlah" => $request->jumlah,
            "keterangan" => $request->keterangan,
        ]);
        Alert::success('Success', 'Data Berhasil Disimpan');
        return redirect()->back();
    }

    public function cetakBA(Request $request)
    {
        $distribusiId = $request->id;
        $header = DB::table('t_distribusi_prasarana')->where('id', $distribusiId)->get();
        $details = DB::table('t_detail_distribusi_prasarana')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_detail_distribusi_prasarana.id_prasarana')
            ->where('t_detail_distribusi_prasarana.id_distribusi_prasarana', $distribusiId)
            ->get();
        $pdf = PDF::loadview('admin.distribusi-prasarana.beritaAcara', compact('header', 'details'));
        $pdf->setOption('enable-local-file-access', true);
        return $pdf->download('berita-acara.pdf');
    }

    public function cetakNPHD(Request $request)
    {
        $distribusiId = $request->id;
        $header = DB::table('t_distribusi_prasarana')->where('id', $distribusiId)->get();
        $details = DB::table('t_detail_distribusi_prasarana')
            ->join('m_prasarana', 'm_prasarana.id', '=', 't_detail_distribusi_prasarana.id_prasarana')
            ->where('t_detail_distribusi_prasarana.id_distribusi_prasarana', $distribusiId)
            ->get();
        $pdf = PDF::loadview('admin.distribusi-prasarana.nphd', compact('header', 'details'));
        $pdf->setOption('enable-local-file-access', true);
        return $pdf->download('berita-acara.pdf');
    }

    public function reportCPCL()
    {
        $kecamatan = DB::table('m_kecamatan')->get();
        $desaKelurahan = DB::table('m_desa_kelurahan')->orderBy('desa_kelurahan', 'asc')->get();
        $periode = DB::table('m_periode_tahun')->get();
        $cpcl = DB::table('t_distribusi_prasarana')
            ->select('t_distribusi_prasarana.tanggal', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan', 't_detail_distribusi_prasarana.lembaga_penerima','t_detail_distribusi_prasarana.nama_penerima', 't_detail_distribusi_prasarana.alamat_lembaga', 'm_prasarana.nama_prasarana', 't_detail_distribusi_prasarana.jumlah', 't_detail_distribusi_prasarana.status', 't_detail_distribusi_prasarana.id')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_distribusi_prasarana.id_kecamatan')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_distribusi_prasarana.id_desa_kelurahan')
            ->join('t_detail_distribusi_prasarana', 't_detail_distribusi_prasarana.id_distribusi_prasarana', '=', 't_distribusi_prasarana.id')
            ->join('m_prasarana', 't_detail_distribusi_prasarana.id_prasarana', '=', 'm_prasarana.id')
            ->Where('t_distribusi_prasarana.status', 'DONE')
            ->orderBy('t_distribusi_prasarana.tanggal', 'desc')
            ->orderBy('m_kecamatan.kecamatan', 'asc')
            ->orderBy('m_desa_kelurahan.desa_kelurahan', 'asc')
            ->get();
        return view('admin.distribusi-prasarana.reportCPCL', compact('cpcl', 'periode', 'kecamatan', 'desaKelurahan'));
    }

    public function generateKodeDistribusi()
    {
        $lastId = DB::table('t_distribusi_prasarana')->max('id');
    }

    public function pengajuan()
    {
        $kecamatan = DB::table('m_kecamatan')->get();
        $desaKelurahan = DB::table('m_desa_kelurahan')->get();
        if (auth()->user()->id_role == 1 || auth()->user()->id_role == 2) {
            $distribusiPrasarana = DB::table('t_distribusi_prasarana')
                ->select('t_distribusi_prasarana.*', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan')
                ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_distribusi_prasarana.id_kecamatan')
                ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_distribusi_prasarana.id_desa_kelurahan')
                ->where('t_distribusi_prasarana.status', 'SUBMITTED')
                ->orWhere('t_distribusi_prasarana.status', 'REJECTED')
                ->get();
        } elseif(auth()->user()->id_role == 3 || auth()->user()->id_role == 4) {
            $id_kecamatan = auth()->user()->id_kecamatan;
            $id_desa_kelurahan = auth()->user()->id_desa_kelurahan;
            if(auth()->user()->id_kecamatan != NULL && auth()->user()->id_desa_kelurahan != NULL){
                $distribusiPrasarana = DB::table('t_distribusi_prasarana')
                ->select('t_distribusi_prasarana.*', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan')
                ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_distribusi_prasarana.id_kecamatan')
                ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_distribusi_prasarana.id_desa_kelurahan')
                ->where('t_distribusi_prasarana.id_desa_kelurahan', $id_desa_kelurahan)
                ->orderBy('t_distribusi_prasarana.dibuat_tanggal', 'desc')
                ->get();
            }else{
                $distribusiPrasarana = DB::table('t_distribusi_prasarana')
                ->select('t_distribusi_prasarana.*', 'm_kecamatan.kecamatan', 'm_desa_kelurahan.desa_kelurahan')
                ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_distribusi_prasarana.id_kecamatan')
                ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_distribusi_prasarana.id_desa_kelurahan')
                ->where('t_distribusi_prasarana.id_kecamatan', $id_kecamatan)
                ->orderBy('t_distribusi_prasarana.dibuat_tanggal', 'desc')
                ->get();
            }

        }

        return view('admin.pengajuan-prasarana.index', compact('kecamatan', 'desaKelurahan', 'distribusiPrasarana'));
    }

    public function buatPengajuan()
    {
        $kecamatan = DB::table('m_kecamatan')->get();
        $desaKelurahan = DB::table('m_desa_kelurahan')->get();
        return view('admin.pengajuan-prasarana.create', compact('kecamatan', 'desaKelurahan'));
    }

    public function storeDataForCPCL(Request $request)
    {
        $kecamatan = $request->id_kecamatan;
        $desa_kelurahan = $request->id_desa_kelurahan;
        $tanggal = $request->tanggal;
        $prasarana = DB::table('m_prasarana')->get();
        $data = DB::table('t_distribusi_prasarana')->insert([
            "kode" => "",
            "tanggal" => $tanggal,
            "id_kecamatan" => $kecamatan,
            "id_desa_kelurahan" => $desa_kelurahan,
            "keterangan" => "Data Adjustment",
            "status" => "DONE",
            "dibuat_oleh" => auth()->user()->name
        ]);

        $getIdDistribution = DB::table('t_distribusi_prasarana')->orderBy('id', 'desc')->first();
        $distribusiId = $getIdDistribution->id;

        return redirect()->signedRoute('distribusiPrasarana.create', ['id' => $distribusiId]);
    }

    //Export

    public function exportCPCL(Request $request)
    {
        $starDate = $request->start_date;
        $endDate = $request->end_date;

        $strDate = strtotime($starDate);

        dd(date("Y", $strDate));

        $cpcl = DB::table('t_distribusi_prasarana')
            ->select('m_kecamatan.kecamatan as Kecamatan', 'm_desa_kelurahan.desa_kelurahan AS Desa','t_detail_distribusi_prasarana.nama_penerima as Penerima','t_detail_distribusi_prasarana.alamat_lembaga as Alamat Penerima', 'm_prasarana.nama_prasarana as Jenis Barang', 't_detail_distribusi_prasarana.jumlah as Jumlah')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 't_distribusi_prasarana.id_kecamatan')
            ->join('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_distribusi_prasarana.id_desa_kelurahan')
            ->join('t_detail_distribusi_prasarana', 't_detail_distribusi_prasarana.id_distribusi_prasarana', '=', 't_distribusi_prasarana.id')
            ->join('m_prasarana', 't_detail_distribusi_prasarana.id_prasarana', '=', 'm_prasarana.id')
            ->where('t_distribusi_prasarana.status', 'APPROVED')
            ->orWhere('t_distribusi_prasarana.status', 'DONE')
            ->orderBy('Kecamatan', 'asc')
            ->orderBy('Desa', 'asc')
            ->get();

        return (new FastExcel($cpcl))->download('Laporan CPCL.xlsx');
    }
}
