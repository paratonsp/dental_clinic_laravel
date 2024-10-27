<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiburDokter extends Model
{
    protected $table = "libur_dokter";
    protected $fillable = ["dokter_id","jam","tanggal"];
}
