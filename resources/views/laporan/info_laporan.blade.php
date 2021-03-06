@extends('layouts.layout')

@section('custom-style')
    <style>
        body {
            color: #FFFF00;
            background-color: #8C3391;
        }
        a {
            color: #FFFF00;
        }
        img {
            margin: 0 auto 1em 0;
            height: auto !important;
            width: 280px !important;
        }

        #laporan_status {
            padding: 10px;
            color: #000000;
        }
        #penerangan-staf {
            padding: 10px;

            border-color: white;
            border-style: solid;
            border-width: 1px;
            border-radius: 10px;
        }
        #penerangan-polis {
            padding: 10px;

            border-color: white;
            border-style: solid;
            border-width: 1px;
            border-radius: 10px;
        }
        #jadualkanLaporan {
            color: black;
        }
        #jadualkanLaporan .btn-primary {
            color: white;
        }
        #btn-kembali {
            background-color: yellow;
        }

        .btn {
            margin: 5px;
            color: black;
            font-weight: bold;
            background-color: white;
        }
        .data {
            color: white;
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

        <br/><br/>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-rounded" src="{!! $laporan['staf_imej'] !!}" />
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Status Laporan:</b></h5>

                                <!-- warna status laporan -->
                                @if($laporan['laporan_status'] == 'DILAPORKAN')
                                    <div class="img-rounded" id="laporan_status" style="background-color: #00FF00">
                                @elseif($laporan['laporan_status'] == 'DIJADUALKAN')
                                    <div class="img-rounded" id="laporan_status" style="background-color: #FFFF00">
                                @elseif($laporan['laporan_status'] == 'DIKUATKUASAKAN')
                                    <div class="img-rounded" id="laporan_status" style="background-color: #FF0000">
                                @elseif($laporan['laporan_status'] == 'DITUTUP')
                                    <div class="img-rounded" id="laporan_status" style="background-color: #D2D2D2">
                                @else
                                    <div class="img-rounded" id="laporan_status" style="background-color: #00FF00">
                                @endif
                                    <b>{!! $laporan['laporan_status'] !!}</b>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5><b>ID Laporan:</b> <span class="data">{!! $laporan['laporan_id'] !!}</span></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Tempat:</b> <span class="data">{!! $laporan['laporan_tempat'] !!}</span></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>Tarikh:</b> <span class="data">{!! $laporan['laporan_tarikh'] !!}</span></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Nama Staf:</b> <a href="{!! route('admin.info.staf', ['id' => $laporan['staf_id']]) !!}"><span class="data"><u>{!! $laporan['staf_nama'] !!}</u></span></a></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>Masa:</b> <span class="data">{!! $laporan['laporan_masa'] !!}</span></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5><b>Nama Polis:</b> <a href="{!! route('admin.info.polis', ['id' => $laporan['polis_id']]) !!}"><span class="data"><u>{!! $laporan['polis_nama'] !!}</u></span></a></h5>
                            </div>
                        </div>

                        <br />

                        <div class="row">
                            <div class="col-md-12">
                                <h5><b>No. Kenderaan:</b> <span class="data">{!! $laporan['kenderaan_no'] !!}</span></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Jenis Kenderaan:</b> <span class="data">{!! $laporan['kenderaan_jenis'] !!}</span></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>No. Pelajar:</b> <span class="data"><u><a href="{!! route('admin.info.pelajar', ['id' => $laporan['pelajar_id']]) !!}">{!! $laporan['pelajar_no'] !!}</a></u></span></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5><b>Status Kenderaan:</b> <span class="data">{!! $laporan['kenderaan_status'] !!}</span></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>No. Siri Pelekat:</b> <span class="data">{!! $laporan['kenderaan_no_siri_pelekat'] !!}</span></h5>
                            </div>
                        </div>

                        <!-- laporan staf -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5><b>Laporan Staf:</b></h5>
                                <div id="penerangan-staf">
                                    @if(isset($laporan['staf_laporan']))
                                        <p><span class="data">{!! $laporan['staf_laporan'] !!}</span></p>
                                    @else
                                        <p><span class="data">Tiada laporan daripada staf.</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <!-- laporan polis -->
                <div class="row" id="laporan-polis">
                    <div class="col-md-3">
                        @if($laporan['polis_imej'] != null)
                            <img class="img-rounded" src="{!! $laporan['polis_imej'] !!}" />
                        @else
                            <h3><b>Tiada Gambar</b></h3>
                        @endif
                    </div>
                    <div class="col-md-7 col-md-offset-1">
                        <div class="row">
                            <div class="md-col-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5><b>Laporan Polis:</b></h5>
                                        <div id="penerangan-polis">
                                            @if(isset($laporan['polis_laporan']))
                                                <p><span class="data">{!! $laporan['polis_laporan'] !!}</span></p>
                                            @else
                                                <p><span class="data">Tiada laporan daripada polis.</span></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5><b>Kesalahan:</b></h5>
                                        @if(isset($laporan['kesalahanList']))
                                            <ul>
                                                @foreach($laporan['kesalahanList'] as $kesalahan)
                                                    <li><span class="data">{!! $kesalahan['jenis_kesalahan'] !!}</span></li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p><span class="data">Tiada kesalahan.</span></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br />

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        @if($laporan['laporan_status'] == "DILAPORKAN")
                            <a class="btn btn-block" href="#" data-toggle="modal" data-target="#jadualkanLaporan">JADUALKAN LAPORAN</a>
                        @elseif($laporan['laporan_status'] == "DIKUATKUASAKAN")
                            <form action="{!! route('admin.laporan.tutup') !!}" method="post">
                                <input type="hidden" name="laporan_id" value="{!! $laporan['laporan_id'] !!}" />
                                <input type="submit" class="btn btn-block" value="TUTUP KES" />
                            </form>
                        @endif
                        <a class="btn btn-block" id="btn-kembali" href="{!! route('admin.dashboard') !!}">KEMBALI</a>
                    </div>
                </div>
            </div>
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

@section('custom-script')
    <script>
        var laporanPolis = "{!! $laporan['polis_laporan'] !!}";
        
        if(laporanPolis == null)
            $("#laporan-polis").css("display", "none");
    </script>
@endsection
