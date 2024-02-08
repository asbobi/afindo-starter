@extends("layouts.app")

@section("title")
    {{ $title }}
@endsection

@section("content")
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 offset-md-8">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search here">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-30">
                        <div class="table-responsive" style="white-space:wrap!important">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 table-striped yajra-datatable">
                                <thead class="student-thread">
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No.</th>
                                        <th>Foto</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>No HP</th>
                                        <th>Tgl Register</th>
                                        <th style="width: 20%;" class="text-center">#</th>
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
    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                dom: 'lBfrtip',
                searching: false,
                ajax: {
                    url: "{{ url("api/pengunjung") }}",
                    data: function(d) {
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'FotoProfil',
                        name: 'FotoProfil'
                    },
                    {
                        data: 'NIK',
                        name: 'NIK'
                    },
                    {
                        data: 'NamaLengkap',
                        name: 'NamaLengkap'
                    },
                    {
                        data: 'NoHP',
                        name: 'NoHP'
                    },
                    {
                        data: 'TglRegister',
                        name: 'TglRegister'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                columnDefs: [{
                    className: "text-center",
                    targets: [0, 6]
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
                            columns: [0, 1]
                        }
                    }, {
                        extend: 'pdfHtml5',
                        title: '{{ @$title }}',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        customize: function(doc) {
                            doc.styles.tableHeader = {
                                color: 'black',
                                background: 'white',
                                alignment: 'left',
                                bold: true,
                            }

                        }
                    }, {
                        text: 'Tambah',
                        action: function(e, dt, node, config) {
                            window.location.href = "{{ url("pengunjung/create") }}";
                        }
                    }]
                },
                language: {
                    url: "{{ asset("assets/js/language_id.json") }}",
                },
            });

            $(".yajra-datatable").on("click", ".btn-del", function() {
                const kode = $(this).data('id');
                Swal.fire({
                    title: 'Apa anda yakin?',
                    text: "data terhapus tidak dapat di kembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus data!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let deleteURL = `{{ url('manajemen-layanan/delete/${kode}') }}`;
                        get_response(deleteURL, '', function(response) {
                            if (response.status === false) {
                                showSwal('warning', 'Peringatan', response.msg);
                                return false;
                            } else {
                                table.ajax.reload();
                                showSwal('success', 'Informasi', response.msg);
                            }
                        })
                    }
                })
            });
        });
    </script>
@endsection
