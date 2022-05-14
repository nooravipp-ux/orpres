<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabangOlahraga extends Model
{
    use HasFactory;

    protected $fillable = ['nama_cabang_olahraga'];


    protected $table = 'm_cabang_olahraga';
    public $timestamps = false;
}
