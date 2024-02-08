@extends("layouts.app")

@section("title")
    {{ $title }}
@endsection

@section("content")
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="si si-calendar"></i>
                                </span>
                                <input type="text" class="form-control filter" id="tgl-transaksi" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <select class="form-control select2" id="id-layanan">
                                <option value="">Semua Layanan</option>
                                @foreach ($layanan as $lay)
                                    <option value="{{ $lay->IDLayanan }}">{{ $lay->NamaLayanan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <select class="form-control select2" id="id-loket">
                                <option value="">Semua Loket</option>
                                @foreach ($loket as $lkt)
                                    <option value="{{ $lkt->IDLoket }}">{{ $lkt->NamaLoket }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 offset-md-8">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" id="input-search" class="form-control" placeholder="Search here">
                                <button class="btn btn-primary" type="button" id="btn-search"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-30">
                        <div class="table-responsive" style="white-space:wrap!important">
                            <table
                                class="table  border-0 star-student table-hover table-center mb-0 table-striped yajra-datatable">
                                <thead class="student-thread">
                                    <tr>
                                        <th class="text-center">No. Antrian</th>
                                        <th>Tanggal</th>
                                        <th>Jam Dilayani</th>
                                        <th>Status</th>
                                        <th>Pengunjung</th>
                                        <th>Nilai SPM</th>
                                        <th>Layanan</th>
                                        <th>Loket</th>
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
    </div>
@endsection

@section("scripts")
    <script>
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                dom: 'lBfrtip',
                searching: false,
                ajax: {
                    url: "{{ url("laporan-kunjungan/listkunjungan") }}",
                    data: function(d) {
                        d.search = $('#input-search').val();
                        d.tgl = $("#tgl-transaksi").val();
                        d.id_loket = $("#id-loket").val();
                        d.id_layanan = $("#id-layanan").val();
                    }
                },
                columns: [{
                        data: 'NoAntrian',
                        name: 'NoAntrian',
                        orderable: false
                    },
                    {
                        data: null,
                        name: 'TanggalJam',
                        render: function(data, type, row) {
                            return formatDate(data.TanggalJam);
                        }
                    },
                    {
                        data: 'JamDilayani',
                        name: 'JamDilayani'
                    },
                    {
                        data: 'StatusAntrian',
                        name: 'StatusAntrian',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'NamaLengkap',
                        name: 'NamaLengkap'
                    },
                    {
                        data: null,
                        name: 'NilaiSPM',
                        render: function(data, type, row) {
                            return formatRupiah(data.NilaiSPM);
                        }
                    },
                    {
                        data: 'NamaLayanan',
                        name: 'NamaLayanan'
                    },
                    {
                        data: 'NamaLoket',
                        name: 'NamaLoket'
                    },
                ],
                columnDefs: [{
                    className: "text-center",
                    targets: [0, 2]
                }],
                "lengthChange": true,
                "buttons": {
                    "dom": {
                        "button": {
                            "tag": "button",
                            "className": "btn-datatabel waves-effect waves-light btn btn-primary"
                        }
                    },
                    "buttons": [{
                        extend: 'excelHtml5',
                        title: '{{ @$title }}',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }, {
                        extend: 'pdfHtml5',
                        title: '{{ @$title }}',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },
                        customize: function(doc) {
                            doc.styles.tableHeader = {
                                color: 'black',
                                background: 'white',
                                alignment: 'left',
                                bold: true,
                            }

                        }
                    }]
                },
                language: {
                    url: "{{ asset("assets/js/language_id.json") }}",
                },
            });

            $('#tgl-transaksi').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                locale: {
                    format: "DD-MM-YYYY"
                }
            }, );

            $("#btn-search").on("click", function() {
                table.ajax.reload();
            })

        });
    </script>
@endsection
