@extends("layouts.app")

@section("title")
    {{ $title }}
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" style="white-space:wrap!important">
                            <table class="table  border-0 star-student table-hover table-center mb-0 table-striped yajra-datatable">
                                <thead class="student-thread">
                                    <tr>
                                        <th style="width: 10%;" class="text-center">No.</th>
                                        <th>Nama Loket</th>
                                        <th>Nomor</th>
                                        <th>Available</th>
                                        <th>Available</th>
                                        <th>Status</th>
                                        <th style="width: 10%;" class="text-center">#</th>
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

        
    <div class="modal fade ui-dialog" id="ModalTambah" role="dialog">
        <div class="modal-dialog ui-dialog-content modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Tambah Data</h4>
                </div>
                <form id="form-data" action="{{ url('manajemen-loket/store') }}" method="POST" enctype="multipart/form-data" class="main-form">
                    @csrf
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Nama Loket</label>
                                    <input type="hidden" class="form-control" id="IDLoket" name="IDLoket" />
                                    <input type="text" class="form-control" id="NamaLoket" name="NamaLoket" value="" placeholder="Masukkan nama loket">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Nomor Loket</label>
                                    <input type="text" class="form-control" id="NoLoket" name="NoLoket" value="" placeholder="Masukkan nomor loket">
                                </div>
                                <div class="form-group">
                                    <div class="checkbox mt-2">
                                        <label>
                                            <input type="checkbox" id="IsAvailable" name="IsAvailable" value="1"> Available
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batalkan</button>
                        <button type="submit" id="btnsave" class="btn btn-primary waves-effect">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    @include('loket.scripts')
@endsection
