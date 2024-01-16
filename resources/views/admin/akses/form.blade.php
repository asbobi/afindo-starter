@extends('layouts.app')


@section('styles')
<style>
    .table>:not(caption)>*>* {
        box-shadow: unset;
        padding: .75rem;
        border: 1px solid #dee2e6;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="form-data" action="{{ url('akses/store') }}" method="POST" enctype="multipart/form-data" class="main-form">
                    @csrf
                    <div class="horizontal-form">
                        <div class="form-group row">
                            <div class="col-sm-3 aling-items-center">
                                <label for="NamaLevel" class="col-form-label color-dark align-center">Nama Level</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="NamaLevel" name="NamaLevel" value="{{ (isset($data) ? $data->NamaLevel : '') }}" placeholder="Nama Level">
                            </div>
                        </div>
                    </div>
                    <br>
                    <h5>Pengaturan Akses Level User </h5>
                    <div class="table-responsive">
                        <table id="table-akses" class="table table-bordered table-striped " style="font-size:13px">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle" rowspan="2">Nama Fitur</th>
                                    <th class="text-center">View Data</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><input type="checkbox" id="ViewData-all" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fitur as $key => $row)
                                <tr>
                                    <td>
                                        {{ $row->NamaFitur }}
                                    </td>
                                    <td class="text-center">
                                        <input value="{{ $row->KodeFitur }}" type="hidden" name="KodeFitur[]">
                                        <input type="checkbox" class="ViewData" {{ (@$row->view > 0 ? 'checked' : '') }}   name="ViewData{{ $row->KodeFitur }}" value="1">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="text-end mt-5">
                        <a href="javascript:history.back()" class="btn btn-warning">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <input type="hidden" id="KodeLevel" name="KodeLevel" value="{{ (isset($data) ? $data->KodeLevel : '') }}">
                        <input type="hidden" name="IsAktif"  value="{{ (isset($data) ? $data->IsAktif : 1) }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
 <script>
    //form submit
    $('#form-data').submit(function(e) {
        e.preventDefault();
        type = 'post';
        url  = $(this).attr('action');
        var self = $(this)
        let data_post = new FormData(self[0]);
        post_response(url, data_post, function(response) {
            if (response.status) {
                showSwal("success", "Informasi", response.msg).then(function() {
                    window.location.href = "{{ url('akses') }}";
                });
            } else {
                showSwal("error", "Gagal", response.msg);
            }
        });
    });

    function simpan(url, data_post) {
        
    }

    $('#ViewData-all').click(function(event) {   
        if(this.checked) {
            $('.ViewData').each(function() {
                this.checked = true;                        
            });
        } else {
            $('.ViewData').each(function() {
                this.checked = false;                       
            });
        }
    }); 

</script>
@endsection
