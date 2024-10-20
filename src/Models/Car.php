<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $primaryKey = "nopol";
    protected $table = "tbl_mobil";
    protected $guarded = [""];
    public $timestamps = false;
}
