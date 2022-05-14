<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = ['kode','kecamatan'];


    protected $table = 'm_kecamatan';
    public $timestamps = false;
}
