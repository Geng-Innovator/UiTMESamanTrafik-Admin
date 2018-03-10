@extends('layouts.layout')

@section('custom-style')
    <style>
        body {
            color: #FFFF00;
            background-color: #8C3391;    
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
        .indent {
            padding-left: 10%;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @if(empty($infoPolis))
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 main-info">
                                    <h1>Tiada rekod berkenaan polis</h1>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 main-info">
                                    <h5>
                                        <b>No. Pekerja:</b><br />
                                        {!! $infoPolis['no_pekerja'] !!}
                                    </h5>
                                    <h3><b>{!! $infoPolis['polis_nama'] !!}</b></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div clas=="col-md-10 col-md-offset-1">
                                    <h4>
                                        <b>Emel:</b><br />
                                        <div class="indent">{!! $infoPolis['polis_emel'] !!}</div>
                                    </h4>
                                    <h4>
                                        <b>No. IC:</b><br />
                                        <div class="indent">{!! $infoPolis['polis_ic'] !!}</div>
                                    </h4>
                                    <h4>
                                        <b>No. Tel. H/P:</b><br />
                                        <div class="indent">{!! $infoPolis['polis_no_tel_hp'] !!}</div>
                                    </h4>
                                    <h4>
                                        <b>No. Tel. Pejabat:</b><br />
                                        <div class="indent">{!! $infoPolis['polis_no_tel_pej'] !!}</div>
                                    </h4>
                                    <h4>
                                        <b>Jawatan:</b><br />
                                        <div class="indent">{!! $infoPolis['polis_jawatan_gred'] !!} - {!! $infoPolis['polis_jawatan_nama'] !!}</div>
                                    </h4>
                                    <h4>
                                        <b>Pos:</b><br />
                                        <div class="indent">{!! $infoPolis['polis_pos'] !!}</div>
                                    </h4>
                                    <h4>
                                        <b>Tarikh Daftar:</b><br />
                                        <div class="indent">{!! $infoPolis['polis_tarikh_daftar'] !!}</div>
                                    </h4>
                                </div>
                            </div>

                            <a class="btn btn-default btn-block" id="btn-kembali" href="{!! URL::previous() !!}">Kembali</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
