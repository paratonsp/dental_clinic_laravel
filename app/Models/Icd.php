<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icd extends Model
{
    protected $table = "icds";
    protected $fillable = ["code","name_id","name_en"];
}
