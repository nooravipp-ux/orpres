<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $fillable = ['kecamatan_id','desa_kelurahan'];


    protected $table = 'm_desa_kelurahan';
    public $timestamps = false;
}
