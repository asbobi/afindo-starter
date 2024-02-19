<?php

namespace App\Http\Controllers\Laporan;

use App\Models\Mstloket;
use App\Models\Mstlayanan;
use App\Models\Trkunjungan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Stevebauman\Purify\Facades\Purify;

class KunjunganController extends Controller
{
    public function __construct()
    {
        $this->kunjungan = new Trkunjungan();
        $this->layanan = new Mstlayanan();
        $this->loket = new Mstloket();
    }

    public function getIndex(Request $request)
    {
        View::share('menu', 'Laporan Kunjungan');
        View::share('title', 'Laporan Kunjungan');
        $data['layanan'] = $this->layanan::where('IsAktif', 1)->get();
        $data['loket'] = $this->loket::where('IsAktif', 1)->get();
        return view('laporan.kunjungan.index', $data);
    }

    public function xgetListkunjungan(Request $request)
    {
        $filter  = $request->all();
        $tanggal = Purify::clean($filter['tgl']);
        $IDLoket = Purify::clean($filter['id_loket']);
        $IDLayanan = Purify::clean($filter['id_layanan']);
        $search = Purify::clean($filter['search']);
        if ($search != null && $search != '') {
            $search = "$search";
        } else {
            $search = '';
        }

        $wheredata = [];
        $wheredataStr = $search != '' ? "(mp.NIK LIKE '%{$search}%' OR mp.NamaLengkap LIKE '%{$search}%') AND " : "";

        if ($tanggal != '') {
            $tgl = explode(" - ", $tanggal);
            $tglawal = date('Y-m-d', strtotime($tgl[0]));
            $tglakhir = date('Y-m-d', strtotime($tgl[1]));
            $wheredata[] = $wheredataStr . "(DATE(tr.TanggalJam) BETWEEN '$tglawal' AND '$tglakhir')";
        }
        if ($IDLoket != '') $wheredata[] = ["tr.IDLoket" => $IDLoket];
        if ($IDLayanan != '') $wheredata[] = ["tr.IDLayanan" => $IDLayanan];

        $request['select'] = 'tr.IDKunjungan, tr.TanggalJam, tr.JamDilayani, tr.NoAntrian, tr.StatusAntrian, tr.IDLoket, tr.UserName, tr.IDUser, tr.NilaiSPM, tr.IDLayanan, ml.NamaLayanan, lkt.NamaLoket, mp.NIK, mp.NamaLengkap';
        $request['from'] = 'trkunjungan AS tr';
        $request['where'] = $wheredata;
        $request['order_by'] = 'CAST(tr.NoAntrian AS UNSIGNED) ASC';
        $request['join'] = [
            [
                'table' => 'mstlayanan AS ml',
                'on' => ['ml.IDLayanan', 'tr.IDLayanan'],
                'param' => 'left',
            ],
            [
                'table' => 'mstloket AS lkt',
                'on' => ['lkt.IDLoket', 'tr.IDLoket'],
                'param' => 'left',
            ],
            [
                'table' => 'mstpengunjung AS mp',
                'on' => ['mp.IDUser', 'tr.IDUser'],
                'param' => 'left',
            ],
        ];
        return $this->kunjungan->getRows($request);
    }
}
