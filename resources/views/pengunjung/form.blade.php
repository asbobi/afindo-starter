@extends("layouts.app")

@section("title")
    {{ $title }}
@endsection

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-data" action="{{ url("api/pengunjung/store") }}" method="POST" enctype="multipart/form-data"
                        class="main-form">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="IDUser" value="{{ @$data->IDUser }}" />
                            <label>NIK</label>
                            <input type="number" class="form-control" name="NIK" placeholder="Masukkan NIK"
                                value="{{ @$data->NIK }}" required {{isset($data->NIK) ? 'readonly' : ''}} />
                        </div>
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="number" class="form-control" name="NoHP" placeholder="Masukkan No HP"
                                value="{{ @$data->NoHP }}" required />
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="NamaLengkap"
                                placeholder="Masukkan nama lengkap" value="{{ @$data->NamaLengkap }}" required />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="mail" class="form-control" name="Email" placeholder="Masukkan email"
                                value="{{ @$data->Email }}" required />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input class="form-control pass-input" name="Password" type="text" value="{{ @$data->Password}}">
                                <div class="input-group-append"><span
                                        class="profile-views feather-eye toggle-password"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" id="FotoProfil" name="FotoProfil" class="dropify" data-max-file-size="2mb"
                                {!! (@$data->FotoProfil != null && @$data->FotoProfil != "" ? ('data-default-file="' . url("public/storage/profiles/$data->FotoProfil") . '"') : "") !!} />
                        </div>
                        <div class="text-end">
                            <a href="javascript:history.back()" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        $('.dropify').dropify();

        $('#form-data').submit(function(e) {
            e.preventDefault();
            type = 'post';
            url = $(this).attr('action');
            var self = $(this)
            let data_post = new FormData(self[0]);

            post_response(url, data_post, function(response) {
                if (response.status) {
                    showSwal("success", "Informasi", response.message).then(function() {
                        window.location.href = "{{ url("pengunjung") }}";
                    });
                } else {
                    showSwal("error", "Gagal", response.message);
                }
            });
        });
    </script>
@endsection
