<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ubah_password()
    {
        return view('profile.ubah-password');
    }

    public function simpan_password(Request $request)
    {
        $passlama = $request->text_passlama;
        $passbaru = $request->text_password;
        if (!Hash::check($passlama, auth()->user()->Password , [])) {
            echo json_encode([
                'status' => false,
                'msg'  => "Password lama tidak sesuai."
            ]); die;
            
        } else {
            $result = User::where('UserName', auth()->user()->UserName)
            ->update(['Password' => Hash::make($passbaru)]);
        }

        if ($result) {
            echo json_encode([
                'status' => true,
                'msg'  => "Berhasil mengubah password, silakan login kembali menggunakan password baru Anda."
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg'  => "Gagal  mengubah password"
            ]);
        }
    }
}
