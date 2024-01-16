@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ $title }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card card-default card-md mb-4">
                    <div class="card-body pb-md-30">
                        <form id="form-armada" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="NoUnit" class="il-gray fs-14 fw-500 align-center">No Unit</label>
                                        <input type="text"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('NoUnit') is-invalid @enderror"
                                            name="NoUnit" id="NoUnit" placeholder="Masukkan No. Unit">
                                        @error('NoUnit')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                        <input type="hidden" name="KodeArmada" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="NoRangka" class="il-gray fs-14 fw-500 align-center">No Rangka</label>
                                        <input type="text"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('NoRangka') is-invalid @enderror"
                                            name="NoRangka" id="NoRangka" placeholder="Masukkan No. Rangka">
                                        @error('NoRangka')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="NoMesin" class="il-gray fs-14 fw-500 align-center">No Mesin</label>
                                        <input type="text"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('NoMesin') is-invalid @enderror"
                                            name="NoMesin" id="NoMesin" placeholder="Masukkan No. Mesin">
                                        @error('NoMesin')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="NoPolisi" class="il-gray fs-14 fw-500 align-center">No. Polisi</label>
                                        <input type="text"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('NoPolisi') is-invalid @enderror"
                                            name="NoPolisi" id="NoPolisi" placeholder="Masukkan No. Polisi">
                                        @error('NoPolisi')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="NamaMerk" class="il-gray fs-14 fw-500 align-center">Merk
                                            Kendaraan</label>
                                        <input type="text"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('NamaMerk') is-invalid @enderror"
                                            name="NamaMerk" id="NamaMerk" placeholder="Masukkan Merk Kendaraan">
                                        @error('NamaMerk')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="JenisTipe" class="il-gray fs-14 fw-500 align-center">Tipe
                                            Kendaraan</label>
                                        <input type="text"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('JenisTipe') is-invalid @enderror"
                                            name="JenisTipe" id="JenisTipe" placeholder="Masukkan Tipe Kendaraan">
                                        @error('JenisTipe')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="TahunPembuatan" class="il-gray fs-14 fw-500 align-center">Tahun
                                            Pembuatan</label>
                                        <input type="number"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('TahunPembuatan') is-invalid @enderror"
                                            name="TahunPembuatan" id="TahunPembuatan"
                                            placeholder="Masukkan Tahun Pembuatan">
                                        @error('TahunPembuatan')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="KapasitasMuatan"
                                            class="il-gray fs-14 fw-500 align-center">Kapasitas</label>
                                        <input type="number" step="any"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('KapasitasMuatan') is-invalid @enderror"
                                            name="KapasitasMuatan" id="KapasitasMuatan" placeholder="Masukkan Kapasitas">
                                        @error('KapasitasMuatan')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="DurasiKmService" class="il-gray fs-14 fw-500 align-center">Durasi
                                            Service Berkala</label>
                                        <input type="number" step="any"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('DurasiKmService') is-invalid @enderror"
                                            name="DurasiKmService" id="DurasiKmService"
                                            placeholder="Masukkan Durasi Service">
                                        @error('DurasiKmService')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="MasaPajak" class="il-gray fs-14 fw-500 align-center">Masa
                                            Pajak</label>
                                        <input type="number" step="any"
                                            class="form-control ih-medium ip-light radius-xs b-light px-15 @error('MasaPajak') is-invalid @enderror"
                                            name="MasaPajak" id="MasaPajak" placeholder="Masukkan Masa Pajak">
                                        @error('MasaPajak')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 layout-button mt-25">
                                    <button type="button"
                                        class="btn btn-default btn-squared border-normal bg-normal px-20 ">cancel</button>
                                    <button type="submit"
                                        class="btn btn-primary btn-default btn-squared px-30">save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#form-armada').on('submit', function(e) {
            e.preventDefault();
            var fd = new FormData(this);
            var _token = $('meta[name=csrf-token]').attr('content');
            fd.append('_token', _token);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('armada.store') }}",
                data: fd,
                processData: false,
                contentType: false,
            }).done((response) => {
                if (response.status) {
                    showSwal('success', 'Informasi', response?.message).then(function() {
                        window.location = "{{ route('/armada.index') }}";
                    });
                } else {
                    showSwal('error', 'Informasi', response?.message);
                }
            }).fail((jqXHR, textStatus) => {
                const response = jqXHR.responseJSON
                if (response.title) {
                    Swal.fire({
                        title: response?.title || 'Aksi Gagal !',
                        html: response?.message || 'Data gagal diperbarui.',
                        icon: 'error',
                        confirmButtonText: 'Ya'
                    })
                }
            })
            return;
        });
    </script>
@endsection
