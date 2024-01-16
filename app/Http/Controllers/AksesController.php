<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use App\Models\Akseslevel;
use App\Models\User;

class AksesController extends Controller
{
    
    private $menu = 'Akses Level';
    public function __construct()
    {
        View::share('menu', $this->menu);
        View::share('title', $this->menu);
        $this->middleware('auth');
        $this->akses = new Akseslevel();
    }


    public function index(Request $request)
    {
        return view('admin.akses.index');
    }

    public function xgetlistdata(Request $request)
    {   
        return $this->akses->getRows($request);
    }

    public function getCreate(Request $request, string $kode = null)
    {
        ## data serverfitur
        $fitur = DB::table('serverfitur')->where('IsAktif', 1)->orderBy('NoUrut', 'ASC')->get();
        if(isset($kode)){
            $KodeLevel = base64_decode($kode);
            $x['data'] = $this->akses::where('KodeLevel', $KodeLevel)->first();

            foreach ($fitur as $key => $row) {
                $check = DB::table('fiturlevel')->where('KodeLevel', $KodeLevel)->where('KodeFitur', $row->KodeFitur)->first(); 
                @$row->view   = $check->ViewData;
            }
        }

        $x['fitur'] = $fitur;
        return view('admin.akses.form', $x);
    }

    public function store(Request $request) //save and update with form_validation
    {
        $kodelevel =  $request->KodeLevel; 
        $kode     =  isset($request->KodeLevel) && $request->KodeLevel != '' ? $request->KodeLevel : $this->akses->get_kode();
  
        $data = [
            "KodeLevel" => $kode,
            "NamaLevel" => $request->NamaLevel, 
            "IsAktif" => $request->IsAktif
        ];

        if($kodelevel == ''){
            ## tambah data
            $status = 'tambah data';
            $this->akses->insertData($data);
        } else {
            ## edit data
            unset($data['KodeLevel']);
            $status = 'update data';
            $this->akses->updateData($data, ['KodeLevel' => $kode]);
            DB::table('fiturlevel')->where('KodeLevel', $kode)->delete();
        }

        ## insert to fitur_level
        $fitur       = $request->KodeFitur;
        $postData    = $request->all();
        foreach ($fitur as $row) {
            @$itemdata['KodeLevel'] = $kode;
            @$itemdata['KodeFitur']  = $row;
            @$itemdata['ViewData']   = $postData['ViewData'.$row] > 0 ? $postData['ViewData'.$row] : 0;
            @$itemdata['AddData']    = $postData['ViewData'.$row] > 0 ? $postData['ViewData'.$row] : 0;
            @$itemdata['EditData']   = $postData['ViewData'.$row] > 0 ? $postData['ViewData'.$row] : 0;
            @$itemdata['DeleteData'] = $postData['ViewData'.$row] > 0 ? $postData['ViewData'.$row] : 0;
            @$itemdata['PrintData']  = $postData['ViewData'.$row] > 0 ? $postData['ViewData'.$row] : 0;
            $res = DB::table('fiturlevel')->insert($itemdata);
        }

        if ($res) {

            if(auth()->user()->KodeLevel == $kodelevel)
            {
                $akseslevel = $this->akses->get_fitur($kodelevel);
                $request->session()->put('akses', $akseslevel);
            }
           
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
        $KodeLevel = base64_decode($kode);
        $count = User::where(['KodeLevel' => $KodeLevel])->count();

        if($count > 0){
            echo json_encode([
                'status' => false,
                'msg'  => "Maaf data sudah digunakan transaksi"
            ]);
        } else {
            DB::table('fiturlevel')->where('KodeLevel', $KodeLevel)->delete();
            $result = $this->akses::where('KodeLevel', $KodeLevel)->delete();
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

}
