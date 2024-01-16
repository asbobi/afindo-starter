@extends("layouts.app")

@section("title")
    {{ $title }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="form-data" action="{{ url('manajemen-layanan/save') }}" method="POST" enctype="multipart/form-data" class="main-form">
                    @csrf
                    <div class="form-group">
                        <label for="NamaLayanan">Nama Layanan</label>
                        <textarea class="form-control" name="NamaLayanan" placeholder="Masukkan nama layanan" required>{{ (isset($data) ? $data->NamaLayanan : '') }}</textarea>
                    </div>
                    <div class="text-end">
                        <a href="javascript:history.back()" class="btn btn-warning">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <input type="hidden" name="IDLayanan"  value="{{ (isset($data) ? $data->IDLayanan : '') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('layanan.scripts')
@endsection
