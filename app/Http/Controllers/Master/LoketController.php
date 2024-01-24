<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Mstloket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LoketController extends Controller
{
    private $menu = 'Manajemen Loket';
    public function __construct()
    {
        View::share('menu', $this->menu);
        View::share('title', $this->menu);
        $this->loket = new Mstloket();
    }

    public function getIndex(Request $request)
    {
        return view('loket.index');
    }

    public function xgetListdata(Request $request)
    {
        return $this->loket->getRows($request);
    }

    public function postStore(Request $request)
    {
        $kode   =  $request->IDLoket;
        $insertdata = request()->except(['_token']);

        $insertdata['IsAvailable'] = isset($insertdata['IsAvailable']) && $insertdata['IsAvailable'] > 0 ? 1 : 0;
        if ($kode == '') {
            ## tambah data
            $status = 'tambah data';
            $insertdata['IDLoket'] = $this->loket->createId('LOKET', 'IDLoket', 'mstloket');
            $insertdata['IsAktif'] = 1;
            $insertdata['UserName'] = auth()->user()->UserName;
            $result = $this->loket->insertData($insertdata);
        } else {
            ## update data
            $status = 'update data';
            $result = $this->loket->updateData($insertdata, ['IDLoket' => $kode]);
        }

        if ($result) {
            echo json_encode([
                'status' => true,
                'msg'  => "Berhasil " . $status
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg'  => "Gagal " . $status
            ]);
        }
    }

    public function getDelete($kode = null)
    {
        $IDLoket = base64_decode($kode);
        $result = $this->loket::where('IDLoket', $IDLoket)->delete();
        if ($result) {
            echo json_encode([
                'status' => true,
                'msg'  => "Berhasil Menghapus Data"
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg'  => "Gagal Menghapus Data"
            ]);
        }
    }

    public function getStatus($kode = null, $isaktif = null)
    {
        $IDLoket = base64_decode($kode);
        $IsAktif   = base64_decode($isaktif);
        $result = $this->loket->updateData(['IsAktif' => $IsAktif], ['IDLoket' => $IDLoket]);
        if ($result) {
            echo json_encode([
                'status' => true,
                'msg'  => ($IsAktif == 1 ? "Berhasil Mengaktifkan Data" : "Berhasil Menonaktifkan Data")
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg'  => ($IsAktif == 1 ? "Gagal Mengaktifkan Data" : "Gagal Menonaktifkan Data")
            ]);
        }
    }
}
