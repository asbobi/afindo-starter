<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\DB;

class AksesRouteController extends Controller
{
    // ambil data untuk perulangan url route
    public function getRoute()
    {
        return DB::table('fiturlevel')
                ->leftJoin('serverfitur', 'serverfitur.KodeFitur', '=', 'fiturlevel.KodeFitur')
                ->leftJoin('akseslevel', 'fiturlevel.KodeLevel', '=', 'akseslevel.KodeLevel')
                // mengambil variable di session
                ->where('fiturlevel.KodeLevel', '=', 1)
                ->where('serverfitur.IsAktif', '=', 1)
                ->where('fiturlevel.ViewData', '=', 1)
                ->where('akseslevel.IsAktif', '=', 1)
                ->select('serverfitur.*')
                ->get();

    }
}
