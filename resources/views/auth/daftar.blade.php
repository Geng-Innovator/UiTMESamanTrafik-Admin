@extends('layouts.layout')

@section('custom-style')
    <style>
        body {
            background-color: #8C3391;
        }
        h1, label {
            color: #FFFF00;
        }

        input {
            color: black !important;
            background: transparent;
        }
        
        select {
            opacity: 0.7;
        }

        .input-text {
            padding: 5px;
            background: white;
            opacity: 0.7;
        }

        .btn-submit {
            padding: 5px;
            border-radius: 30px;
            background: white;
            opacity: 0.7;
            border: none;

            width: 100%;
        }
        .btn-submit:hover {
            background-color: #FFFF00;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1><b>DAFTAR</b></h1>
                </div>
            </div>

            <br /><br />
            
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <!-- jenis pekerja -->
                        <div class="form-group{{ $errors->has('jenis_pekerja') ? ' has-error' : '' }}">
                            <label for="jenis_pekerja" class="col-md-4 control-label">Jenis Pekerja</label>

                            <div class="col-md-6">
                                <select id="jenis_pekerja" name="jenis_pekerja" class="form-control">
                                    @foreach($jenisPekerjaList as $jenisPekerja)
                                        <option name="field[]" value="{{ $jenisPekerja['id'] }}">{{ $jenisPekerja['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- jawatan -->
                        <div class="form-group{{ $errors->has('jawatan') ? ' has-error' : '' }}">
                            <label for="jawatan" class="col-md-4 control-label">Jawatan</label>

                            <div class="col-md-6">
                                <select id="jawatan" name="jawatan" class="form-control">
                                    @foreach($jawatanList as $jawatan)
                                        <option value="{{ $jawatan['id'] }}">{{ $jawatan['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                        <!-- jabatan -->
                        <div id="in_jabatan" class="form-group">
                            <label for="jabatan" class="col-md-4 control-label">Jabatan</label>

                            <div class="col-md-6">
                                <select id="jabatan" name="jabatan_id" class="form-control">
                                    @foreach($jabatanList as $jabatan)
                                        <option value="{{ $jabatan['id'] }}">{{ $jabatan['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- pos -->
                        <div id="in_pos" class="form-group">
                            <label for="pos" class="col-md-4 control-label">Pos</label>

                            <div class="col-md-6">
                                <select id="pos" name="pos_id" class="form-control">
                                    @foreach($posList as $pos)
                                        <option value="{{ $pos['id'] }}">{{ $pos['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- no pekerja -->
                        <div class="form-group{{ $errors->has('no_pekerja') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="no_pekerja"
                                    type="text"
                                    class="input-text form-control"
                                    name="no_pekerja"
                                    value="{{ old('no_pekerja') }}"
                                    placeholder="No. Pekerja"
                                    required autofocus>

                                @if ($errors->has('no_pekerja'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_pekerja') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- nama -->
                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="nama"
                                    type="text"
                                    class="input-text form-control"
                                    name="nama"
                                    value="{{ old('nama') }}"
                                    placeholder="Nama"
                                    required autofocus>

                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- emel -->
                        <div class="form-group{{ $errors->has('emel') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="emel"
                                    type="email"
                                    class="input-text form-control"
                                    name="emel"
                                    value="{{ old('emel') }}"
                                    placeholder="Alamat Emel"
                                    required>

                                @if ($errors->has('emel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- no ic -->
                        <div class="form-group{{ $errors->has('no_ic') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="no_ic"
                                    type="text"
                                    class="input-text form-control"
                                    name="no_ic"
                                    value="{{ old('no_ic') }}"
                                    placeholder="No. IC"
                                    required autofocus>

                                @if ($errors->has('no_ic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_ic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- no tel hp -->
                        <div class="form-group{{ $errors->has('no_tel_hp') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="no_tel_hp"
                                    type="text"
                                    class="input-text form-control"
                                    name="no_tel_hp"
                                    value="{{ old('no_tel_hp') }}"
                                    placeholder="No. Telefon H/P"
                                    required autofocus>

                                @if ($errors->has('no_tel_hp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_tel_hp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- no tel pej -->
                        <div class="form-group{{ $errors->has('no_tel_pej') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="no_tel_pej"
                                    type="text"
                                    class="input-text form-control"
                                    name="no_tel_pej"
                                    value="{{ old('no_tel_pej') }}"
                                    placeholder="No. Telefon Pejabat"
                                    required autofocus>

                                @if ($errors->has('no_tel_pej'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_tel_pej') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br /><br />

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn-submit">
                                    <b>Daftar</b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            $("#in_jabatan").hide();
            $("#in_pos").hide();

            $("#jenis_pekerja").change(function() {
                var jenisPekerjaSelection = $("#jenis_pekerja").find(":selected").text();
            
                switch(jenisPekerjaSelection) {
                    case "ADMIN":
                        $("#in_jabatan").hide();
                        $("#in_pos").hide();
                        break;
                    case "STAF":
                        $("#in_jabatan").show();
                        $("#in_pos").hide();
                        break;
                    case "POLIS":
                        $("#in_jabatan").hide();
                        $("#in_pos").show();
                        break;
                }
            });
        });
    </script>
@endsection
