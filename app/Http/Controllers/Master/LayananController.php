<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Mstlayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LayananController extends Controller
{
    private $menu = 'Manajemen Layanan';
    private $layanan;
    public function __construct()
    {
        View::share('menu', $this->menu);
        View::share('title', $this->menu);
        $this->layanan = new Mstlayanan();
    }

    public function getIndex(Request $request)
    {
        return view('layanan.index');
    }

    public function xgetListdata(Request $request)
    {   
        if(isset($params['limit']) && isset($params['page'])){

        }
        
        return $this->layanan->getRows($request);
    }

    public function getCreate(Request $request, string $kode = null)
    {
        $x = []; 
        if(isset($kode)){
            $IDLayanan = base64_decode($kode);
            $x['data'] = $this->layanan::where('IDLayanan', $IDLayanan)->first();
        }
        return view('layanan.form', $x);
    }

    public function postStore(Request $request)
    {
        $kode   =  $request->IDLayanan; 
        $insertdata = request()->except(['_token']);

        if($kode == ''){
            ## tambah data
            $status = 'tambah data';
            $insertdata['IDLayanan'] = $this->layanan->createId('LAY', 'IDLayanan', 'mstlayanan');
            $insertdata['IsAktif'] = 1;
            $result = $this->layanan->insertData($insertdata);
        } else {
            ## update data
            $status = 'update data';
            $result = $this->layanan->updateData($insertdata, ['IDLayanan' => $kode]);
        }
        
        if ($result) {
            echo json_encode([
                'status' => true,
                'msg'  => "Berhasil ".$status
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg'  => "Gagal ". $status
            ]);
        }
    }

    public function getDelete($kode = null)
    {
        $IDLayanan = base64_decode($kode);
        $result = $this->layanan::where('IDLayanan', $IDLayanan)->delete();
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

}
