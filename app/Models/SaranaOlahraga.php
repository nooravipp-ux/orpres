<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranaOlahraga extends Model
{
    use HasFactory;

    protected $fillable = ['kecamatan_id','desa_kelurahan_id', 'nama_surveyor','jabatan_surveyor','alamat_surveyor','no_telp_surveyor','email_desa_kel','website_desa_kel','jumlah_rt','jumlah_rw','jumlah_penduduk','dibuat_tanggal'];


    protected $table = 't_sarana_prasarana';
    public $timestamps = false;
}
