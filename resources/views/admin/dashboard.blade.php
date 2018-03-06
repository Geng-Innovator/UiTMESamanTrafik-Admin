@extends('layouts.layout')

@section('custom-style')
    <style>
        td {
            text-align: center;
        }

        #status-laporan {
            padding: 10px;
            border-radius: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h1><b>Dashboard</b></h1>
            </div>
            <div class="col-md-4"></div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Laporan</th>
                            <th>Imej</th>
                            <th>Tempat</th>
                            <th>No. Kenderaan</th>
                            <th>Jenis Kenderaan</th>
                            <th>Status Laporan</th>
                            <th>Tarikh Lapor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(empty($laporanList))
                            <tr>
                                <td colspan="7">Tiada laporan lagi.</td>
                            </tr>
                        @else
                            @foreach($laporanList as $laporan)
                                <tr>
                                    <td>{{ $laporan['id'] }}</td>
                                    <td>
                                        <a href="{!! route('admin.laporan', ['id' => $laporan['id']]) !!}">
                                            <img class="img-rounded img-responsive" src="{!! asset('/images/' . $laporan['imej']) !!}" />
                                        </a>
                                    </td>
                                    <td>{{ $laporan['tempat'] }}</td>
                                    <td>{{ $laporan['no_kenderaan'] }}</td>
                                    <td>{{ $laporan['jenis_kenderaan'] }}</td>
                                    <td>
                                        @if($laporan['status_laporan'] == 'DILAPORKAN')
                                            <div id="status-laporan" style="background-color: #00FF00">
                                        @elseif($laporan['status_laporan'] == 'DIJADUALKAN')
                                            <div id="status-laporan" style="background-color: #FFFF00">
                                        @elseif($laporan['status_laporan'] == 'DIKUATKUASAKAN')
                                            <div id="status-laporan" style="background-color: #FF0000">
                                        @elseif($laporan['status_laporan'] == 'DITUTUP')
                                            <div id="status-laporan" style="background-color: #D2D2D2">
                                        @else
                                            <div id="status-laporan" style="background-color: #00FF00">
                                        @endif
                                            <b>{{ $laporan['status_laporan'] }}</b>
                                        </div>
                                    </td>
                                    <td>{{ $laporan['tarikh'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <!-- message modal -->
    <div id="messageModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Message</h4>
                </div>
                <div class="modal-body">
                    @if($daftar == 1)
                        Akaun baru telah berjaya didaftarkan.<br />
                        Emel telah dihantar ke alamat emel akaun baru.
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
        jQuery.noConflict();

        $(document).ready(function() {
            var daftar = "{!! $daftar !!}";

            if(daftar == "1")
                $("#messageModal").modal();
        });
    </script>
@endsection
