@extends('layouts.app')

@section('title')
    {{ $title ?? '' }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ubah Password</h5>
                <div class="row">
                    <div class="col-md-10 col-lg-6">
                        <form id="form-pass" action="{{  url('simpan_password') }}" method="POST" enctype="multipart/form-data" class="px-3">
                            @csrf
                            <div class="form-group">
                                <label>Password Lama</label>
                                <div class="input-group mb-2"> 
                                    <input type="password" class="form-control pass-input-new" id="pass_lama" name="text_passlama" placeholder="Masukkan password lama" required>
                                    <span class="input-group-text feather-eye toggle-password-new" style="background-color:#fff">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <div class="input-group mb-2"> 
                                    <input type="password" name="text_password" class="form-control pass-input" id="pass_baru" placeholder="Masukan password baru"  required>
                                    <span class="input-group-text feather-eye toggle-password" style="background-color:#fff">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <div class="input-group mb-2"> 
                                    <input type="password" class="form-control pass-confirm" id="pass_confirm" placeholder="Ulangi password baru"  required>
                                    <span class="input-group-text feather-eye reg-toggle-password" style="background-color:#fff">
                                    </span>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Ubah Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
$('#form-pass').submit(function(e) {
    e.preventDefault();
    type = 'post';
    url  = $(this).attr('action');
    var self = $(this)
    let data_post = new FormData(self[0]);

    var pass_baru    = $('#pass_baru').val();
    var pass_confirm    = $('#pass_confirm').val();

    if(pass_baru == pass_confirm){
        post_response(url, data_post, function(response) {
            if (response.status) {
                showSwal("success", "Informasi", response.msg).then(function() {
                    location.reload();
                });
            } else {
                showSwal("error", "Gagal", response.msg);
            }
        });
    } else {
        showSwal('warning', 'Peringatan', 'Maaf password dan konfirmasi password tidak sama');
        return false;
    }
});
</script>
@endsection