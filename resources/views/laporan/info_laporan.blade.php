@extends('layouts.layout')

@section('custom-style')
    <style>
        img {
            max-height: 200px;
            max-width: 200px;
        }

        #laporan_status {
            padding: 10px;
            color: #000000;
            background-color: {!! $laporan['laporan_status_warna'] !!};
        }

        .btn {
            margin: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1><b>Info Laporan</b></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-rounded" src="{!! asset('/images/' . $laporan['staf_imej']) !!}" />
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Status Laporan:</b></h5>

                                <div class="img-rounded" id="laporan_status">
                                    <b>{!! $laporan['laporan_status'] !!}</b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5><b>ID Laporan:</b> {!! $laporan['laporan_id'] !!}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Tempat:</b> {!! $laporan['laporan_tempat'] !!}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>Tarikh:</b> {!! $laporan['laporan_tarikh'] !!}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Nama Staf:</b> <a href="{!! route('admin.info.staf', ['id' => $laporan['staf_id']]) !!}">{!! $laporan['staf_nama'] !!}</a></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>Masa:</b> {!! $laporan['laporan_masa'] !!}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5><b>Nama Polis:</b> <a href="{!! route('admin.info.polis', ['id' => $laporan['polis_id']]) !!}">{!! $laporan['polis_nama'] !!}</a></h5>
                            </div>
                        </div>

                        <br />

                        <div class="row">
                            <div class="col-md-12">
                                <h5><b>No. Kenderaan:</b> {!! $laporan['kenderaan_no'] !!}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Jenis Kenderaan:</b> {!! $laporan['kenderaan_jenis'] !!}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>No. Pelajar:</b> <a href="{!! route('admin.info.pelajar', ['id' => $laporan['pelajar_id']]) !!}">{!! $laporan['pelajar_no'] !!}</a></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Status Kenderaan:</b> {!! $laporan['kenderaan_status'] !!}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>No. Siri Pelekat:</b> {!! $laporan['kenderaan_no_siri_pelekat'] !!}</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h5><b>Laporan Staf:</b></h5>
                        @if(isset($laporan['staf_laporan']))
                            <p>{!! $laporan['staf_laporan'] !!}</p>
                        @else
                            <p>Tiada laporan daripada staf.</p>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h5><b>Kesalahan:</b></h5>
                        @if(isset($laporan['kesalahanList']))
                            <ul>
                                @foreach($laporan['kesalahanList'] as $kesalahan)
                                    <li>{!! $kesalahan['jenis_kesalahan'] !!}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Tiada kesalahan.</p>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h5><b>Laporan Polis:</b></h5>
                        @if(isset($laporan['polis_laporan']))
                            <p>{!! $laporan['polis_laporan'] !!}</p>
                        @else
                            <p>Tiada laporan daripada polis.</p>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <br />

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        @if($laporan['laporan_status'] == "DILAPORKAN")
                            <a class="btn btn-info btn-block" href="#" data-toggle="modal" data-target="#jadualkanLaporan">JADUALKAN LAPORAN</a>
                        @elseif($laporan['laporan_status'] == "DIKUATKUASAKAN")
                            <form action="{!! route('admin.laporan.tutup') !!}" method="post">
                                <input type="hidden" name="laporan_id" value="{!! $laporan['laporan_id'] !!}" />
                                <input type="submit" class="btn btn-info btn-block" value="TUTUP KES" />
                            </form>
                        @endif
                        <a class="btn btn-danger btn-block" href="{!! route('admin.dashboard') !!}">KEMBALI</a>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <!-- popup for jadualkan laporan -->
    <!-- bootstrap modal -->
    <div id="jadualkanLaporan" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">JADUALKAN LAPORAN</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID Polis</th>
                                        <th>Pos</th>
                                        <th>Nama</th>
                                        <th>No. Tel. HP</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporan['jadual_polis_list'] as $polis)
                                        <tr>
                                            <td>{!! $polis['polis_id'] !!}</td>
                                            <td>{!! $polis['polis_pos'] !!}</td>
                                            <td>{!! $polis['polis_nama'] !!}</td>
                                            <td>{!! $polis['polis_tel_hp'] !!}</td>
                                            <td>
                                                <form method="post" action="{!! route('admin.laporan.jadual') !!}">
                                                    <input type="hidden" name="admin_id" value="{!! Auth::user()->id !!}" />
                                                    <input type="hidden" name="polis_id" value="{!! $polis['polis_id'] !!}" />
                                                    <input type="hidden" name="laporan_id" value="{!! $laporan['laporan_id'] !!}" />
                                                    <button type="submit" class="btn btn-primary">AGIH</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
