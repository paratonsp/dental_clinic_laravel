<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = "jadwal_dokter";
    protected $fillable = ["dokter_id","jam","hari"];
}
