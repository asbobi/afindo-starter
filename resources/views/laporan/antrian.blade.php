@extends("layouts.app")

@section("title")
    {{ $title }}
@endsection

@section("content")


    <div class="container-fluid">
        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-3"> 
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control filter" id="tgl-transaksi" value="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary" id="btn-cari">Search</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" style="white-space:wrap!important">
                            <table class="table  border-0 star-student table-hover table-center mb-0 table-striped yajra-datatable">
                                <thead class="student-thread">
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No.</th>
                                        <th>Tanggal</th>
                                        <th>Jam Dilayani</th>
                                        <th>No Antrian</th>
                                        <th>Status</th>
                                        <th>ID Loket</th>
                                        <th>Nilai SPM</th>
                                        <th>Layanan</th>
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
                url: "{{ url("laporan/listhutang") }}",
                data: function(d) {
                    d.search = $('input[type="search"]').val();
                    d.tgl = $("#tgl-transaksi").val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    // name: 'TanggalJam',
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
                    data: 'NoAntrian',
                    name: 'NoAntrian'
                }, 
                {
                    data: 'StatusAntrian',
                    name: 'StatusAntrian',
                    orderable: false,
                    searchable: false
                }, 
                {
                    data: 'NamaLoket',
                    name: 'NamaLoket'
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
                            columns: [0,1,2,3,4,5,6]
                        }
                    }, {
                        extend: 'pdfHtml5',
                        title: '{{ @$title }}',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
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
                url: "{{ asset('assets/js/language_id.json') }}",
            },
        });

        $('#tgl-transaksi').daterangepicker({
            ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month'),
                locale: {
                    format: "DD-MM-YYYY"
                }
            },
            // function(start, end) {
            //     $('#tgl-transaksi').val(start.format("DD-MM-YYYY") + ' - ' + end.format("DD-MM-YYYY"));
            //     table.ajax.reload();
            // }
        );

        $("#btn-cari").on("click", function() {
            table.ajax.reload();
        })

    });
    

</script>
@endsection
