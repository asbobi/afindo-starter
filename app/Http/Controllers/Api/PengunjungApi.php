<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Mstpengunjung;
use App\Http\Controllers\Controller;
use Stevebauman\Purify\Facades\Purify;

class PengunjungApi extends Controller
{
    public function __construct()
    {
        $this->pengunjung = new Mstpengunjung();
    }

    public function getIndex(Request $req)
    {
        if (isset($req->page)) {
            try {
                $page = (int)$req->page;
                if (!is_numeric($req->page)) {
                    $page = 10;
                }
                $search = $req->search;
                if ($search != null && $search != '') {
                    $search = "%$req->search%";
                } else {
                    $search = '%%';
                }

                /* $data = $this->pengunjung::where(function ($query) {
                    $query->where('IsAktif', '=', 1);
                })->where(function ($query) use ($search) {
                    $query->where('NIK', 'like', $search)
                        ->orWhere('NamaLengkap', 'like', $search);
                })->orderBy('NamaLengkap', 'ASC')
                    ->limit(10)->offset($page)->get(); */

                $data = $this->pengunjung->getRows([
                    'select' => '*',
                    'where' => [
                        ['IsAktif' => 1],
                        "(NIK LIKE '%{$search}%' OR NamaLengkap LIKE '%{$search}%')"
                    ],
                    'order_by' => 'NamaLengkap ASC',
                    'limit' => 10,
                    'offset' => $page
                ]);
                if ($data['status'] && sizeof($data['data']) > 0) {
                    return response()->json([
                        'data' => $data['data'],
                        'status'  => true,
                        'message' => 'Data pengunjung tersedia.'
                    ], 200);
                } else {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Data pengunjung tidak tersedia.',
                        'data'    => '',
                    ], 404);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Terjadi kesalahan.',
                    'pesan'   => $e->getMessage(),
                    'data'    => '',
                ], 500);
            }
        }

        $req['pre_datatable'] = function ($datatable) {
            return $datatable
                ->editColumn('TglRegister', '{{mediumdate_indo($TglRegister)}}')
                ->editColumn('FotoProfil', function ($row) {
                    $image = $row->FotoProfil != null ? $row->FotoProfil : "nope-not-here.webp";
                    $url = url("public/storage/profiles/$image");
                    $src = '<a href="student-details.html" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="' . $url . '" alt="User Image"></a>';
                    return $src;
                })
                ->rawColumns(['FotoProfil', 'action']);
        };

        $req['action'] = function ($row) {
            $tombolAksi = '<a href="' . url('pengunjung/create/' . base64_encode($row->IDUser)) . '" class="text-primary" style="margin-right:8px;"><i class="fa fa-edit"></i></a>

            <a href="#" data-id="\'' . $row->IDUser . '\'" class="text-danger btn-del"><i class="fa fa-trash"></i></a>';
            return $tombolAksi;
        };
        return $this->pengunjung->getRows($req);
    }

    public function getShow(Request $request)
    {
        $IDUser = Purify::clean($request->IDUser);
        $data = $this->pengunjung::where('IDUser', $IDUser)->first();
        if ($data) {
            return response()->json(['data' => $data, 'status' => true, 'message' => ''], 200);
        } else {
            return response()->json(['data' => [], 'status' => false, 'message' => 'data tidak ditemukan'], 404);
        }
    }

    public function postStore(Request $request)
    {
        $IDUser = @$request->IDUser;
        $insertdata = $request->input();
        unset($insertdata['_token']);
        $insertdata['Password'] = base64_encode($insertdata['Password']);
        if ($IDUser == null || $IDUser == '') {
            ## check username
            $adanik = $this->pengunjung::where('NIK', $insertdata['NIK'])->first();
            if ($adanik) {
                return response()->json(['data' => [], 'status' => false, 'message' => "NIK sudah terdaftar sebelumnya."], 200);
            }
            ## tambah data
            $status = 'tambah data';
            $insertdata['IDUser'] = $this->pengunjung->createId("P-" . date('Ymd'), 'IDUser', 'mstpengunjung');
            $insertdata['IsAktif'] = 1;
            $insertdata['TglRegister'] = date('Y-m-d H:i:s');
            $uploadFoto = $this->pengunjung->uploadFile('FotoProfil', 'public/profiles');
            if (!$uploadFoto['status']) {
                return response()->json(['data' => [], 'status' => false, 'message' => $uploadFoto['message']], 304);
            }
            $insertdata['FotoProfil'] = $uploadFoto['data'];
            $result = $this->pengunjung->insertData($insertdata);
        } else {
            ## update data
            $status = 'update data';
            if (request()->hasFile('FotoProfil') && request()->file('FotoProfil')->isValid()) {
                $uploadFoto = $this->pengunjung->uploadFile('FotoProfil', 'public/profiles');
                if (!$uploadFoto['status']) {
                    return response()->json(['data' => [], 'status' => false, 'message' => $uploadFoto['message']], 304);
                }
                $insertdata['FotoProfil'] = $uploadFoto['data'];
            }
            $result = $this->pengunjung->updateData($insertdata, ['IDUser' => $IDUser]);
        }
        if ($result) {
            return response()->json(['data' => $insertdata, 'status' => true, 'message' => "Berhasil {$status}"], 200);
        } else {
            return response()->json(['data' => [], 'status' => false, 'message' => "Gagal {$status}"], 304);
        }
    }

    public function postDelete(Request $request)
    {
        $IDUser = $request->IDUser;
        $result = $this->pengunjung->updateData(['IsAktif' => 0], ['IDUser' => $IDUser]);
        if ($result) {
            return response()->json(['status' => true, 'message' => "Berhasil menghapus data."], 200);
        } else {
            return response()->json(['status' => false, 'message' => "Gagal menghapus data."], 304);
        }
    }
}
