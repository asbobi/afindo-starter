<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Mstpengunjung;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class PengunjungController extends Controller
{
    private $menu = 'Pengunjung';
    private $pengunjung;

    public function __construct()
    {
        View::share('menu', $this->menu);
        View::share('title', $this->menu);
        $this->pengunjung = new Mstpengunjung();
    }

    public function getIndex(Request $request)
    {
        return view('pengunjung.index');
    }

    public function getCreate(Request $request, string $kode = null)
    {
        $x = [];
        if(isset($kode)){
            $IDUser = base64_decode($kode);
            $x['data'] = $this->pengunjung::where('IDUser', $IDUser)->first();
            $x['data']->Password = base64_decode($x['data']->Password);
        }
        return view('pengunjung.form', $x);
    }
}
