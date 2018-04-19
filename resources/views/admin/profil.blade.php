@extends('layouts.layout')

@section('custom-style')
    <style>
        body {
            background-color: #8C3391;    
        }
        h1, h3, h4, h5 {
            color: #FFFF00;
        }

        a.btn {
            margin: 10px;
            display: block;
            text-decoration: none;

            opacity: .8;
            color: black;
            font-weight: bold;
            border-radius: 10px;
            background-color: white;
        }

        .container {
            justify-content: center;
            align-items: center;
        }

        .main-info {
            text-align: center;
        }

        .modal-title {
            color: black !important;
        }

        #btn-kembali {
            background-color: yellow;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        @if(empty($infoAdmin))
                            <h1 class="main-info">Tiada rekod berkenaan admin</h1>
                        @else
                            <span class="main-info">
                                <h5><b>No. Pekerja:</b> {!! $infoAdmin['no_pekerja'] !!}</h5>
                                <h3>{!! $infoAdmin['admin_nama'] !!}</h3>
                            </span>
                            <h4>
                                <b>Emel:</b><br />
                                {!! $infoAdmin['admin_emel'] !!}
                            </h4>
                            <h4>
                                <b>No. IC:</b><br />
                                {!! $infoAdmin['admin_ic'] !!}
                            </h4>
                            <h4>
                                <b>No. Tel. H/P:</b><br />
                                {!! $infoAdmin['admin_no_tel_hp'] !!}
                            </h4>
                            <h4>
                                <b>No. Tel. Pejabat:</b><br />
                                {!! $infoAdmin['admin_no_tel_pej'] !!}
                            </h4>
                            <h4>
                                <b>Jawatan:</b><br />
                                {!! $infoAdmin['admin_jawatan_gred'] !!} - {!! $infoAdmin['admin_jawatan_nama'] !!}
                            </h4>
                            <h4>
                                <b>Tarikh Daftar:</b><br />
                                {!! $infoAdmin['admin_tarikh_daftar'] !!}
                            </h4>

                            <br /><br />

                            <a class="btn" id="btn-reset" href="#">Ubah Katalaluan</a>
                            <a class="btn" id="btn-kembali" href="{!! URL::previous() !!}">Kembali</a>
                        @endif
                    </div>
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

            $("#btn-reset").click(function() {
                $("#messageModal").modal();
            });
        });
    </script>
@endsection
