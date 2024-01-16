<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Mstloket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->loket = new Mstloket();
    }

  
    public function getIndex(Request $request)
    {
        View::share('menu', 'Laporan Antrian');
        View::share('title', 'Laporan Antrian');
        return view('laporan.antrian');
    }

    public function xgetlisthutang(Request $request)
    {   
        $filter  = $request->all();
        $wheredata = '';
        $tanggal = $filter['tgl'];
        if ($tanggal != '') {
            $tgl = explode(" - ", $tanggal);
            $tglawal = date('Y-m-d', strtotime($tgl[0]));
            $tglakhir = date('Y-m-d', strtotime($tgl[1]));
            $wheredata .= " (DATE(trkunjungan.TanggalJam) BETWEEN '$tglawal' AND '$tglakhir')";
        }

        $request['select'] = 'trkunjungan.*, mstlayanan.NamaLayanan, mstloket.NamaLoket';
        $request['from']   = 'trkunjungan';
        $request['where']  = $wheredata;
        $request['join'] = [
            [
                'table' => 'mstlayanan',
                'on' => ['mstlayanan.IDLayanan', 'trkunjungan.IDLayanan'],
                'param' => 'left',
            ],   
            [
                'table' => 'mstloket',
                'on' => ['mstloket.IDLoket', 'trkunjungan.IDLoket'],
                'param' => 'left',
            ],   
        ];
        return $this->loket->getRows($request);
    }

    public function getPiutang(Request $request)
    {
        View::share('menu', 'Laporan Piutang');
        View::share('title', 'Laporan Piutang');
        return view('laporan.piutang');
    }

    
}
