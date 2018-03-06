@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        @if(empty($infoPolis))
                            <h1>Tiada rekod berkenaan polis</h1>
                        @else
                            <h5>No. Pekerja: {!! $infoPolis['no_pekerja'] !!}</h5>
                            <h3>{!! $infoPolis['polis_nama'] !!}</h3>
                            <h4>Emel: {!! $infoPolis['polis_emel'] !!}</h4>
                            <h4>No. IC: {!! $infoPolis['polis_ic'] !!}</h4>
                            <h4>No. Tel. H/P: {!! $infoPolis['polis_no_tel_hp'] !!}</h4>
                            <h4>No. Tel. Pejabat: {!! $infoPolis['polis_no_tel_pej'] !!}</h4>
                            <h4>Jawatan: {!! $infoPolis['polis_jawatan_gred'] !!} - {!! $infoPolis['polis_jawatan_nama'] !!}</h4>
                            <h4>Pos: {!! $infoPolis['polis_pos'] !!}</h4>
                            <h4>Tarikh Daftar: {!! $infoPolis['polis_tarikh_daftar'] !!}</h4>

                            <a class="btn btn-default" href="{!! URL::previous() !!}">Kembali</a>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
