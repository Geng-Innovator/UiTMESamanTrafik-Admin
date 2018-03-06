@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        @if(empty($infoStaf))
                            <h1>Tiada rekod berkenaan staf</h1>
                        @else
                            <h5>No. Pekerja: {!! $infoStaf['no_pekerja'] !!}</h5>
                            <h3>{!! $infoStaf['staf_nama'] !!}</h3>
                            <h4>Emel: {!! $infoStaf['staf_emel'] !!}</h4>
                            <h4>No. IC: {!! $infoStaf['staf_ic'] !!}</h4>
                            <h4>No. Tel. H/P: {!! $infoStaf['staf_no_tel_hp'] !!}</h4>
                            <h4>No. Tel. Pejabat: {!! $infoStaf['staf_no_tel_pej'] !!}</h4>
                            <h4>Jawatan: {!! $infoStaf['staf_jawatan_gred'] !!} - {!! $infoStaf['staf_jawatan_nama'] !!}</h4>
                            <h4>Jabatan: {!! $infoStaf['staf_jabatan'] !!}</h4>
                            <h4>Tarikh Daftar: {!! $infoStaf['staf_tarikh_daftar'] !!}</h4>

                            <a class="btn btn-default" href="{!! URL::previous() !!}">Kembali</a>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
