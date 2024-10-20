<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;
    protected $table = "tbl_member";
    protected $guarded = [""];
    protected $primaryKey = 'nik';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
