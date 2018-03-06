@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        @if(empty($infoPelajar))
                            <h1>Tiada rekod berkenaan pelajar</h1>
                        @else
                            <h3>{!! $infoPelajar['pelajar_nama'] !!}</h3>
                            <h4>No.Pelajar: {!! $infoPelajar['pelajar_no'] !!}</h4>
                            <h4>Kursus: {!! $infoPelajar['pelajar_kursus_kod'] !!} - {!! $infoPelajar['pelajar_kursus_nama'] !!}</h4>
                            <h4>Fakulti: {!! $infoPelajar['pelajar_fakulti'] !!}</h4>
                            <h4>Kolej: {!! $infoPelajar['pelajar_kolej'] !!}</h4>

                            <a class="btn btn-default" href="{!! URL::previous() !!}">Kembali</a>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
