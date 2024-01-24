<?php

namespace App\Models;

use App\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mstpengunjung extends MyModel
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'mstpengunjung';

    protected $fillable = [
        "IDUser", "NIK", "NamaLengkap", "NoHP", "TglRegister", "IsAktif", "Password", "Email", "FotoProfil"
    ];
}
