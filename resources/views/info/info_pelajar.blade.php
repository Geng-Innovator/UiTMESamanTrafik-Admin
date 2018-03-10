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
                        @if(empty($infoPelajar))
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 main-info">
                                    <h1>Tiada rekod berkenaan pelajar</h1>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1 main-info">
                                    <h3><b>{!! $infoPelajar['pelajar_nama'] !!}</b></h3>
                                    <h4>
                                        <b>No.Pelajar:</b><br />
                                        {!! $infoPelajar['pelajar_no'] !!}
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                        <b>Kursus:</b><br />
                                        <div class="indent">{!! $infoPelajar['pelajar_kursus_kod'] !!} - {!! $infoPelajar['pelajar_kursus_nama'] !!}</div>
                                    </h4>
                                    <h4>
                                        <b>Fakulti:</b><br />
                                        <div class="indent">{!! $infoPelajar['pelajar_fakulti'] !!}</div>
                                    </h4>
                                    <h4>
                                        <b>Kolej:</b><br />
                                        <div class="indent">{!! $infoPelajar['pelajar_kolej'] !!}</div>
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
