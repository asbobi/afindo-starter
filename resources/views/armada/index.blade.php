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
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn">
                            <div class="form-group mb-0">
                                <div class="input-container icon-left position-relative">
                                    <span class="input-icon icon-left">
                                        <span data-feather="calendar"></span>
                                    </span>
                                    <input type="text" class="form-control form-control-default date-ranger"
                                        name="date-ranger" placeholder="Oct 30, 2019 - Nov 30, 2019">
                                    <span class="input-icon icon-right">
                                        <span data-feather="chevron-down"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown action-btn">
                            <button class="btn btn-sm btn-default btn-white dropdown-toggle" type="button"
                                id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <span class="dropdown-item">Export With</span>
                                <div class="dropdown-divider"></div>
                                <a href="" class="dropdown-item"><i class="la la-file-pdf"></i> PDF</a>
                                <a href="" class="dropdown-item"><i class="la la-file-excel"></i> Excel (XLSX)</a>
                            </div>
                        </div>
                        <div class="action-btn">
                            <a href="{{route('armada.create')}}" class="btn btn-sm btn-primary btn-add"><i class="la la-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                    <th>No. Polisi</th>
                                    <th>Merk</th>
                                    <th>Tipe</th>
                                    <th>Tahun Pembuatan</th>
                                    <th>Masa Pajak</th>
                                    <th>Km Service</th>
                                    <th>Kapasitas</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('armada.index') }}",
                    data: function(d) {
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'NoPolisi',
                        name: 'NoPolisi'
                    },
                    {
                        data: 'NamaMerk',
                        name: 'NamaMerk'
                    },
                    {
                        data: 'JenisTipe',
                        name: 'JenisTipe'
                    },
                    {
                        data: 'TahunPembuatan',
                        name: 'TahunPembuatan'
                    },
                    {
                        data: 'MasaPajak',
                        name: 'MasaPajak'
                    },
                    {
                        data: 'DurasiKmService',
                        name: 'DurasiKmService'
                    },
                    {
                        data: 'KapasitasMuatan',
                        name: 'KapasitasMuatan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
