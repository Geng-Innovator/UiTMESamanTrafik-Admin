@extends('layouts.layout')

@section('custom-style')
    <style>
        body {
            background-color: #8C3391;
        }
        h1 {
            color: #FFFF00;
        }

        input {
            margin: 20px 0 20px 0;
            color: black !important;
            background: transparent;
        }

        .input-text {
            padding: 5px;
            border-radius: 30px;
            background: white;
            opacity: 0.7;
        }

        .btn-submit {
            padding: 5px;
            border-radius: 30px;
            background: white;
            opacity: 0.9;
            border: none;

            width: 100%;
        }
        .btn-submit:hover {
            background-color: #FFFF00;
        }

        .checkbox, .btn-link {
            color: white;
        }
        .icon {
            margin: 0;
            padding: 0;
            height: auto !important;
            width: 50px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                    <div class="col-md-5 col-md-offset-4">
                        <h1><b>Log Masuk</b></h1>
                    </div>
                </div>

                <br /><br />
                
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="input-text form-group{{ $errors->has('no_pekerja') ? ' has-error' : '' }}">
                                <label for="no_pekerja" class="col-md-2 control-label">
                                    <img class="icon" src="{!! asset('/images/icons/icon_email.png') !!}" />
                                </label>

                                <div class="col-md-10">
                                    <b>
                                        <input id="no_pekerja"
                                            type="text"
                                            class="form-control"
                                            name="no_pekerja"
                                            value="{{ old('no_pekerja') }}"
                                            placeholder="No. Pekerja"
                                            required autofocus>
                                    </b>

                                    @if ($errors->has('no_pekerja'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('no_pekerja') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="input-text form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-2 control-label">
                                    <img class="icon" src="{!! asset('/images/icons/icon_password.png') !!}" />
                                </label>

                                <div class="col-md-10">
                                    <b>
                                        <input id="password"
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            placeholder="Password"
                                            required>
                                    </b>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <br /><br />

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="jenis_pekerja" value="1" />
                                        <button type="submit" class="btn-submit">
                                            <b>Log Masuk</b>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                    <h4 class="modal-title"><b>Amaran!</b></h4>
                </div>
                <div class="modal-body">
                    @if($message != null)
                        <p>{{ $message }}</p>
                    @endif
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
            var message = "{!! $message !!}";

            if(message != "")
                $("#messageModal").modal();
        });
    </script>
@endsection
