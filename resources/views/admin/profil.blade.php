@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        @if(empty($infoAdmin))
                            <h1>Tiada rekod berkenaan admin</h1>
                        @else
                            <h5>No. Pekerja: {!! $infoAdmin['no_pekerja'] !!}</h5>
                            <h3>{!! $infoAdmin['admin_nama'] !!}</h3>
                            <h4>Emel: {!! $infoAdmin['admin_emel'] !!}</h4>
                            <h4>No. IC: {!! $infoAdmin['admin_ic'] !!}</h4>
                            <h4>No. Tel. H/P: {!! $infoAdmin['admin_no_tel_hp'] !!}</h4>
                            <h4>No. Tel. Pejabat: {!! $infoAdmin['admin_no_tel_pej'] !!}</h4>
                            <h4>Jawatan: {!! $infoAdmin['admin_jawatan_gred'] !!} - {!! $infoAdmin['admin_jawatan_nama'] !!}</h4>
                            <h4>Tarikh Daftar: {!! $infoAdmin['admin_tarikh_daftar'] !!}</h4>

                            <a class="btn btn-default" href="{!! URL::previous() !!}">Kembali</a>
                            <a id="reset" class="btn btn-primary" href="#">Ubah Katalaluan</a>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- message modal -->
    <div id="messageModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Tukar Katalaluan</b></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="{!! route('admin.ubah_katalaluan') !!}">
                        <div class="form-group{{ $errors->has('cur_pass') ? ' has-error' : '' }}">
                            <label for="cur_pass" class="col-md-4 control-label">Katalaluan Lama</label>

                            <div class="col-md-6">
                                <input id="cur_pass" type="password" class="form-control" name="cur_pass" value="{{ old('cur_pass') }}" required autofocus>

                                @if ($errors->has('cur_pass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cur_pass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('new_pass') ? ' has-error' : '' }}">
                            <label for="new_pass" class="col-md-4 control-label">Katalaluan Baru</label>

                            <div class="col-md-6">
                                <input id="new_pass" type="password" class="form-control" name="new_pass" value="{{ old('new_pass') }}" required autofocus>

                                @if ($errors->has('new_pass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_pass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-danger">Ubah Katalaluan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            var resetPassword = "{!! $resetPassword !!}";

            if(resetPassword == 1)
                $("#messageModal").modal();

            $("#reset").click(function() {
                $("#messageModal").modal();
            });
        });
    </script>
@endsection
