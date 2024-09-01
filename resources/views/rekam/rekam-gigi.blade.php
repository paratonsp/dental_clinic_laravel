@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{Route('rekam.detail',$rekam->pasien_id)}}">Rekam Medis</a></li>
        <li class="breadcrumb-item active"><a href="#">Tambah Rekam Gigi {{$rekam->pasien->nama}}</a></li>
    </ol>
</div>
@include('rekam.partial.modal-diagnosa-gigi')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <a href="{{Route('rekam.gigi.odontogram',$rekam->pasien_id)}}" style="width: 120px"
                        class="btn-rounded btn-info btn-xs "><i class="fa fa-eye"></i> Lihat Riwayat Odontogram</a>
                    <br/><br/>
                    <canvas id="odontogram" style="margin-top: 15px;">
                        Browser anda tidak support canvas, silahkan update browser anda.
                    </canvas>
                    <br/><br/>
                    <button type="button" id="ODONTOGRAM_MODE_HAPUS">ODONTOGRAM_MODE_HAPUS</button>
                    <button type="button" id="ODONTOGRAM_MODE_DEFAULT">ODONTOGRAM_MODE_DEFAULT</button>
                    <button type="button" id="ODONTOGRAM_MODE_AMF">ODONTOGRAM_MODE_AMF</button>
                    <button type="button" id="ODONTOGRAM_MODE_COF">ODONTOGRAM_MODE_COF</button>
                    <button type="button" id="ODONTOGRAM_MODE_FIS">ODONTOGRAM_MODE_FIS</button>
                    <button type="button" id="ODONTOGRAM_MODE_NVT">ODONTOGRAM_MODE_NVT</button>
                    <button type="button" id="ODONTOGRAM_MODE_RCT">ODONTOGRAM_MODE_RCT</button>
                    <button type="button" id="ODONTOGRAM_MODE_NON">ODONTOGRAM_MODE_NON</button>
                    <button type="button" id="ODONTOGRAM_MODE_UNE">ODONTOGRAM_MODE_UNE</button>
                    <button type="button" id="ODONTOGRAM_MODE_PRE">ODONTOGRAM_MODE_PRE</button>
                    <button type="button" id="ODONTOGRAM_MODE_ANO">ODONTOGRAM_MODE_ANO</button>
                    <button type="button" id="ODONTOGRAM_MODE_CARIES">ODONTOGRAM_MODE_CARIES</button>
                    <button type="button" id="ODONTOGRAM_MODE_CFR">ODONTOGRAM_MODE_CFR</button>
                    <button type="button" id="ODONTOGRAM_MODE_FMC">ODONTOGRAM_MODE_FMC</button>
                    <button type="button" id="ODONTOGRAM_MODE_POC">ODONTOGRAM_MODE_POC</button>
                    <button type="button" id="ODONTOGRAM_MODE_RRX">ODONTOGRAM_MODE_RRX</button>
                    <button type="button" id="ODONTOGRAM_MODE_MIS">ODONTOGRAM_MODE_MIS</button>
                    <button type="button" id="ODONTOGRAM_MODE_IPX">ODONTOGRAM_MODE_IPX</button>
                    <button type="button" id="ODONTOGRAM_MODE_FRM_ACR">ODONTOGRAM_MODE_FRM_ACR</button>
                    <button type="button" id="ODONTOGRAM_MODE_BRIDGE">ODONTOGRAM_MODE_BRIDGE</button>
                    <button type="button" id="ODONTOGRAM_MODE_ARROW_TOP_LEFT">ODONTOGRAM_MODE_ARROW_TOP_LEFT</button>
                    <button type="button" id="ODONTOGRAM_MODE_ARROW_TOP_RIGHT">ODONTOGRAM_MODE_ARROW_TOP_RIGHT</button>
                    <button type="button" id="ODONTOGRAM_MODE_ARROW_TOP_TURN_LEFT">ODONTOGRAM_MODE_ARROW_TOP_TURN_LEFT</button>
                    <button type="button" id="ODONTOGRAM_MODE_ARROW_TOP_TURN_RIGHT">ODONTOGRAM_MODE_ARROW_TOP_TURN_RIGHT</button>
                    <button type="button" id="ODONTOGRAM_MODE_ARROW_BOTTOM_LEFT">ODONTOGRAM_MODE_ARROW_BOTTOM_LEFT</button>
                    <button type="button" id="ODONTOGRAM_MODE_ARROW_BOTTOM_RIGHT">ODONTOGRAM_MODE_ARROW_BOTTOM_RIGHT</button>
                    <button type="button" id="ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_LEFT">ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_LEFT</button>
                    <button type="button" id="ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_RIGHT">ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_RIGHT</button>
                    <button type="button" id="download">DOWNLOAD</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('header')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('odontograma/js/odontogram.js')}}"></script>
<style type="text/css">
        canvas {
            border: 1px solid #a9a9a9;
        }
    </style>

@endsection
@section('script')
<script>
    jQuery( document ).ready(function( $ ) {
        var odontogram = $("#odontogram").odontogram('init', {
        width: "900px",
        height: "420px"
    });
    // $("#odontogram").data('odontogram').setGeometryByPos([
    //     { code: 'AMF', pos: '18-R' },
    //     { code: 'AMF', pos: '18-T' },
    //     { code: 'AMF', pos: '18-L' },
    //     { code: 'AMF', pos: '18-B' },
    //     { code: 'CARIES', pos: '83-M' },
    //     { code: 'POC', pos: '84' },
    // ]);
    $('#odontogram').on('change', function (_, geometry) {
        // console.log(Object.keys(geometry)["name"]);
        // console.log(JSON.stringify(geometry));
        // console.log(geometry);
        // var result = Object.keys(geometry).map((key) => [geometry[key][0]]);
        // console.log(result);
        var arr = [];
        for (var i = 0; i < Object.keys(geometry).length; i++) {
            arr.push(Object.values(geometry)[i][0]);
        }
        console.log(arr);
    })

    $("#ODONTOGRAM_MODE_HAPUS").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_HAPUS);
    });
    $("#ODONTOGRAM_MODE_DEFAULT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_DEFAULT);
    });
    $("#ODONTOGRAM_MODE_AMF").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_AMF);
    });
    $("#ODONTOGRAM_MODE_COF").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_COF);
    });
    $("#ODONTOGRAM_MODE_FIS").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_FIS);
    });
    $("#ODONTOGRAM_MODE_NVT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_NVT);
    });
    $("#ODONTOGRAM_MODE_RCT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_RCT);
    });
    $("#ODONTOGRAM_MODE_NON").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_NON);
    });
    $("#ODONTOGRAM_MODE_UNE").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_UNE);
    });
    $("#ODONTOGRAM_MODE_PRE").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_PRE);
    });
    $("#ODONTOGRAM_MODE_ANO").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_ANO);
    });
    $("#ODONTOGRAM_MODE_CARIES").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_CARIES);
    });
    $("#ODONTOGRAM_MODE_CFR").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_CFR);
    });
    $("#ODONTOGRAM_MODE_FMC").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_FMC);
    });
    $("#ODONTOGRAM_MODE_POC").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_POC);
    });
    $("#ODONTOGRAM_MODE_RRX").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_RRX);
    });
    $("#ODONTOGRAM_MODE_MIS").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_MIS);
    });
    $("#ODONTOGRAM_MODE_IPX").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_IPX);
    });
    $("#ODONTOGRAM_MODE_FRM_ACR").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_FRM_ACR);
    });
    $("#ODONTOGRAM_MODE_BRIDGE").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_BRIDGE);
    });
    $("#ODONTOGRAM_MODE_ARROW_TOP_LEFT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_ARROW_TOP_LEFT);
    })
    $("#ODONTOGRAM_MODE_ARROW_TOP_RIGHT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_ARROW_TOP_RIGHT);
    })
    $("#ODONTOGRAM_MODE_ARROW_TOP_TURN_LEFT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_ARROW_TOP_TURN_LEFT);
    })
    $("#ODONTOGRAM_MODE_ARROW_TOP_TURN_RIGHT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_ARROW_TOP_TURN_RIGHT);
    })
    $("#ODONTOGRAM_MODE_ARROW_BOTTOM_LEFT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_ARROW_BOTTOM_LEFT);
    })
    $("#ODONTOGRAM_MODE_ARROW_BOTTOM_RIGHT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_ARROW_BOTTOM_RIGHT);
    })
    $("#ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_LEFT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_LEFT);
    })
    $("#ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_RIGHT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_RIGHT);
    })

    $("#download").click(function (_, geometry) {
            console.log(geometry)
    })
    });
</script>

@endsection