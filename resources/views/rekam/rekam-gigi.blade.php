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
                    <table class="table" style="width: 100%">
                        <tbody>
                            <tr>
                                <td align="center">
                                    <canvas id="odontogram">
                                        Browser anda tidak support canvas, silahkan update browser anda.
                                    </canvas>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-primary" id="ODONTOGRAM_MODE_AMF">AMF</button>
                    <button type="button" class="btn btn-primary" id="ODONTOGRAM_MODE_COF">COF</button>
                    <button type="button" class="btn btn-primary" id="ODONTOGRAM_MODE_FIS">FIS</button>
                    
                    <button type="button" class="btn btn-secondary" id="ODONTOGRAM_MODE_NVT">NVT</button>
                    <button type="button" class="btn btn-secondary" id="ODONTOGRAM_MODE_RCT">RCT</button>

                    <button type="button" class="btn btn-success" id="ODONTOGRAM_MODE_NON">NON</button>
                    <button type="button" class="btn btn-success" id="ODONTOGRAM_MODE_UNE">UNE</button>
                    <button type="button" class="btn btn-success" id="ODONTOGRAM_MODE_PRE">PRE</button>
                    <button type="button" class="btn btn-success" id="ODONTOGRAM_MODE_ANO">ANO</button>
                    <button type="button" class="btn btn-success" id="ODONTOGRAM_MODE_IPX">IPX</button>

                    <button type="button" class="btn btn-warning" id="ODONTOGRAM_MODE_MIS">MIS</button>
                    <button type="button" class="btn btn-warning" id="ODONTOGRAM_MODE_CARIES">CARIES</button>
                    <button type="button" class="btn btn-warning" id="ODONTOGRAM_MODE_CFR">CFR</button>
                    <button type="button" class="btn btn-warning" id="ODONTOGRAM_MODE_FMC">FMC</button>
                    <button type="button" class="btn btn-warning" id="ODONTOGRAM_MODE_POC">POC</button>
                    <button type="button" class="btn btn-warning" id="ODONTOGRAM_MODE_RRX">RRX</button>

                    <button type="button" class="btn btn-danger" id="ODONTOGRAM_MODE_FRM_ACR">FRM/ACR</button>
                    <!-- <button type="button" class="btn btn-danger" id="ODONTOGRAM_MODE_BRIDGE">BRIDGE</button> -->
                    <button type="button" class="btn btn-danger" id="ODONTOGRAM_MODE_BRIDGE_LEFT"><i class="fa fa-arrow-left"></i> Bridge</button>
                    <button type="button" class="btn btn-danger" id="ODONTOGRAM_MODE_BRIDGE_RIGHT"><i class="fa fa-arrow-right"></i> Bridge</button>
                    <button type="button" class="btn btn-danger" id="ODONTOGRAM_MODE_BRIDGE_JOIN"><i class="fa fa-minus"></i> Bridge</button>

                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_ARROW_TOP_LEFT"><i class="fa fa-arrow-left"></i> Top</button>
                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_ARROW_TOP_RIGHT"><i class="fa fa-arrow-right"></i> Top</button>
                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_ARROW_TOP_TURN_LEFT"><i class="fa fa-rotate-left"></i> Top</button>
                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_ARROW_TOP_TURN_RIGHT"><i class="fa fa-rotate-right"></i> Top</button>
                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_ARROW_BOTTOM_LEFT"><i class="fa fa-arrow-left"></i> Bottom</button>
                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_ARROW_BOTTOM_RIGHT"><i class="fa fa-arrow-right"></i> Bottom</button>
                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_LEFT"><i class="fa fa-rotate-left"></i> Bottom</button>
                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_RIGHT"><i class="fa fa-rotate-right"></i> Bottom</button>

                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_BRIDGE_LEFT"<i class="fa fa-rotate-left"> >Bridge</button>
                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_BRIDGE_RIGHT">ODONTOGRAM_MODE_BRIDGE_RIGHT</button>
                    <button type="button" class="btn btn-info" id="ODONTOGRAM_MODE_BRIDGE_JOIN">ODONTOGRAM_MODE_BRIDGE_JOIN</button>

                    <button type="button" class="btn btn-dark" id="ODONTOGRAM_MODE_DEFAULT">Default</button>
                    <button type="button" class="btn btn-dark" id="ODONTOGRAM_MODE_HAPUS">Hapus</button>
                    <!-- <button type="button" class="btn btn-dark" id="download">Download</button> -->
                    <br>
                    <form action="{{Route('pasien.updateOdontogram',$rekam->pasien_id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group transparent-append">
                                <input type="text" id="odontogramValue" name="odontogram" class="form-control" value="{{$pasien->odontogram}}" hidden>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group transparent-append">
                                <input type="text" id="rekamId" name="rekamId" class="form-control" value="{{$rekam->id}}" hidden>
                            </div>
                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-primary">Update Odontogram</button>
                        </div>
                    </form>
                    <br><br>
                    <form action="{{Route('rekam.gigi.store',$rekam->id)}}" method="POST">
                        {{ csrf_field() }}
                        <hr>
                        <div class="row">
                            <div class="card-body pt-3">
                                <div class="row">
                                    @if ($rekam->status <= 2)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="text-black font-w500">Element Gigi*</label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                            <select id="element_gigi" class="form-control">
                                                                @php
                                                                    for ($i=11; $i < 19; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=21; $i < 29; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=31; $i < 39; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=41; $i < 49; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=51; $i < 56; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=61; $i < 66; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=71; $i < 76; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=81; $i < 86; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                @endphp
                                                            </select>
                                                        
                                                    </div>
                                                
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">Kondisi Gigi* </label>
                                                <select name="pemeriksaan" id="kondisi_gigi" class="form-control">
                                                    @foreach ($kondisi_gigi as $item)
                                                        <option value="{{$item->kode}}">{{$item->kode}}</span></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">Diagnosa*</label>
                                                <div class="input-group transparent-append">
                                                    <input type="text" id="diagnosa" class="form-control"
                                                    data-toggle="modal" data-target="#addDiagnosa" readonly
                                                    name="diagnosa" placeholder="">
                                                    <div class="input-group-append show-pass"  data-toggle="modal"
                                                    data-target="#addDiagnosa">
                                                        <span class="input-group-text"> 
                                                            <a href="javascript:void(0)"  data-toggle="modal"
                                                            data-target="#modalObat"><i class="fa fa-search"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">Tindakan/Prosedur* </label>
                                                <select name="tindakan" id="tindakan" class="form-control">
                                                    @foreach ($tindakan as $item)
                                                        <option value="{{$item->kode}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        
                                        
                                            <div class="form-group">
                                                <button type="button" onclick="addRekam()" class="btn btn-info">+ Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                    <div class="col-md-{{$rekam->status <= 2 ? '8' : '12'}}">
                                        <div class="table-responsive card-table">
                                            <h5>Rincian</h5>
                                                <table  id="table-tindakan"
                                                class="table table-responsive-md table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Elemen Gigi</th>
                                                        <th>Kondisi Gigi</th>
                                                        <th>Diagnosa</th>
                                                        <th>Tindakan</th>
                                                        <th><strong>#</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pem_gigi as $row)
                                                        <tr>
                                                            <td>{{$row->elemen_gigi}}</td>
                                                            <td>{{$row->pemeriksaan}}</td>
                                                            <td>{{$row->diagnosa}}</td>
                                                            <td>{{$row->tindakan}}</td>
                                                            <td> @if ($rekam->status<=2)
                                                                <a href="#" class="btn btn-danger shadow btn-xs sharp delete" 
                                                                    r-link="{{Route('rekam.gigi.delete',$row->id)}}"
                                                                    r-name="{{$row->elemen_gigi}}" r-id="{{$row->id}}"><i class="fa fa-trash"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                
                                            </table>
                                           @if ($rekam->status<=2)
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                                </div>
                                           @endif
                                           {{-- </form> --}}
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        {{-- <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('header')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
    .btn {
        margin-right: -5px;
        padding: 8px 8px;
    }
</style>

@endsection
@section('script')
<script src="{{asset('odontograma/js/modernizr-2.0.6.min.js')}}"></script>
<script defer src="{{asset('odontograma/js/plugins.js')}}"></script>
<script defer src="{{asset('odontograma/js/jquery.tmpl.j')}}s"></script>
<script defer src="{{asset('odontograma/js/knockout-2.0.0.js')}}"></script>
<script defer src="{{asset('odontograma/js/jquery.svg.min.js')}}"></script>  
<script defer src="{{asset('odontograma/js/jquery.svggraph.min.js')}}"></script>  

<script>
    // CONSTANTA untuk MODE Odontogram
    var ODONTOGRAM_MODE_HAPUS = 100; // HAPUS
    var ODONTOGRAM_MODE_DEFAULT = 0; // Do Nothing
    var ODONTOGRAM_MODE_AMF = 1; // Hitam = TAMBALAN AMALGAM
    var ODONTOGRAM_MODE_COF = 2; // Hijau Diarsir = TAMBALAN COMPOSITE
    var ODONTOGRAM_MODE_FIS = 3; // UNGU = pit dan fissure sealant
    var ODONTOGRAM_MODE_NVT = 4; // SEGITIGA DIBAWAH (seperti Akar) = gigi non-vital
    var ODONTOGRAM_MODE_RCT = 5; // SEGITIGA DIBAWAH (seperti Akar) filled = Perawatan Saluran Akar
    var ODONTOGRAM_MODE_NON = 6; // gigi tidak ada, tidak diketahui ada atau tidak ada. (non)
    var ODONTOGRAM_MODE_UNE = 7; // Un-Erupted (une)
    var ODONTOGRAM_MODE_PRE = 8; // Partial-Erupt (pre) 
    var ODONTOGRAM_MODE_ANO = 9; // Anomali (ano), Pegshaped, micro, fusi, etc
    var ODONTOGRAM_MODE_CARIES = 10; // Caries = Tambalan sementara (car)
    var ODONTOGRAM_MODE_CFR = 11; // fracture (cfr) (Tanda '#' di tengah" gigi)
    var ODONTOGRAM_MODE_FMC = 12; // Full metal crown pada gigi vital (fmc)
    var ODONTOGRAM_MODE_POC = 13; // Porcelain crown pada gigi vital (poc)
    var ODONTOGRAM_MODE_RRX = 14; // Sisa Akar (rrx)
    var ODONTOGRAM_MODE_MIS = 15; // Gigi hilang (mis)
    var ODONTOGRAM_MODE_IPX = 16; // Implant + Porcelain crown (ipx - poc)
    var ODONTOGRAM_MODE_FRM_ACR = 17; // Partial Denture/ Full Denture
    var ODONTOGRAM_MODE_BRIDGE = 18; // BRIDGE
    var ODONTOGRAM_MODE_ARROW_TOP_LEFT = 19; // TOP-LEFT ARROW
    var ODONTOGRAM_MODE_ARROW_TOP_RIGHT = 20; // TOP-RIGHT ARROW
    var ODONTOGRAM_MODE_ARROW_TOP_TURN_LEFT = 21; // TOP-TURN-LEFT ARROW
    var ODONTOGRAM_MODE_ARROW_TOP_TURN_RIGHT = 22; // TOP-TURN-RIGHT ARROW
    var ODONTOGRAM_MODE_ARROW_BOTTOM_LEFT = 23; // BOTTOM-LEFT ARROW
    var ODONTOGRAM_MODE_ARROW_BOTTOM_RIGHT = 24; // BOTTOM-RIGHT ARROW
    var ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_LEFT = 25; // BOTTOM-TURN-LEFT ARROW
    var ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_RIGHT = 26; // BOTTOM-TURN-RIGHT ARROW
    var ODONTOGRAM_MODE_BRIDGE_LEFT = 27; // BRIDGE_LEFT
    var ODONTOGRAM_MODE_BRIDGE_RIGHT = 28; // BRIDGE_RIGHT
    var ODONTOGRAM_MODE_BRIDGE_JOIN = 29; // BRIDGE_JOIN

    // Create closure.
    jQuery(function ($) {
        // Class Polygon
        function Polygon(vertices, options) {
            this.name = 'Polygon';
            this.vertices = vertices;
            this.options = options;
            return this;
        }
        Polygon.prototype.render = function (ctx) {
            if (this.vertices.length <= 0) return;
            ctx.fillStyle = this.options.fillStyle;
            ctx.beginPath();

            var vertices = this.vertices.concat([]);
            var fpos = vertices.shift();
            ctx.moveTo(fpos.x, fpos.y);

            var pos;
            while (vertices.length > 0) {
                pos = vertices.shift();
                if (pos) {
                    ctx.lineTo(pos.x, pos.y);
                }
            }
            ctx.lineTo(fpos.x, fpos.y);
            ctx.closePath();
            ctx.fill();
        };
        // Class AMF = Tambalan Amalgam
        function AMF(vertices, options) {
            this.name = 'AMF';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#222' }, options);
            return this;
        }
        AMF.prototype.render = function (ctx) {
            ctx.fillStyle = this.options.fillStyle;
            ctx.beginPath();

            var vertices = this.vertices.concat([]);
            var fpos = vertices.shift();
            ctx.moveTo(fpos.x + 1, fpos.y + 1);

            var pos;
            while (vertices.length > 0) {
                pos = vertices.shift();
                if (pos) {
                    ctx.lineTo(pos.x + 1, pos.y + 1);
                }
            }
            ctx.lineTo(fpos.x + 1, fpos.y + 1);
            ctx.closePath();
            ctx.fill();
        }
        // Class COF = TAMBALAN COMPOSITE
        function COF(vertices, options) {
            this.name = 'COF';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#29b522' }, options);
            return this;
        }
        COF.prototype.render = function (ctx) {
            ctx.fillStyle = this.options.fillStyle;
            ctx.beginPath();

            var vertices = this.vertices.concat([]);
            var fpos = vertices.shift();
            ctx.moveTo(fpos.x + 1, fpos.y + 1);

            var top_left, top_right,
                bottom_left, bottom_right;
            var xcount = [], ycount = [];

            var pos;
            var i = 0;
            while (vertices.length > 0) {
                pos = vertices.shift();
                if (pos) {
                    ctx.lineTo(pos.x + 1, pos.y + 1);
                }

                if (i == 0) { // TOP LEFT
                    top_left = { x: pos.x, y: pos.y };
                } else if (i == 1) { // TOP RIGHT
                    top_right = { x: pos.x, y: pos.y };
                } else if (i == 2) { // BOTTOM RIGHT
                    bottom_right = { x: pos.x, y: pos.y };
                } else if (i == 3) { // BOTTOM LEFT
                    bottom_left = { x: pos.x, y: pos.y };
                }

                if (xcount.indexOf(pos.x) == -1) {
                    xcount.push(pos.x);
                }
                if (ycount.indexOf(pos.y) == -1) {
                    ycount.push(pos.y);
                }

                i++;
            }
            ctx.lineTo(fpos.x + 1, fpos.y + 1);
            ctx.closePath();
            ctx.fill();
            // console.log("COUNT", xcount.length, ycount.length);
            // TODO: Mengarsir
            // ctx.beginPath();
            // ctx.moveTo(xpos, ypos + bigBoxSize);
            // ctx.lineTo(xpos + smallBoxSize/2, ypos + bigBoxSize - smallBoxSize/2);
            // ctx.stroke();
        }
        // Class FIS = pit dan fissure sealant
        function FIS(vertices, options) {
            this.name = 'FIS';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#ed3bed' }, options);
            return this;
        }
        FIS.prototype.render = function (ctx) {
            ctx.fillStyle = this.options.fillStyle;
            ctx.beginPath();

            var vertices = this.vertices.concat([]);
            var fpos = vertices.shift();
            ctx.moveTo(fpos.x + 1, fpos.y + 1);

            var pos;
            while (vertices.length > 0) {
                pos = vertices.shift();
                if (pos) {
                    ctx.lineTo(pos.x + 1, pos.y + 1);
                }
            }
            ctx.lineTo(fpos.x + 1, fpos.y + 1);
            ctx.closePath();
            ctx.fill();
        }
        // Class NVT = SEGITIGA DIBAWAH (seperti Akar) = gigi non-vital
        function NVT(vertices, options) {
            this.name = 'NVT';
            this.vertices = vertices;
            this.options = $.extend({ strokeStyle: '#333', height: 25 }, options);
            return this;
        }
        NVT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x) + 1;
            var x2 = parseFloat(this.vertices[1].x) + 1;
            var y1 = parseFloat(this.vertices[0].y) + 1;
            var y2 = parseFloat(this.vertices[1].y) + 1;
            var size = x2 - x1;
            var height = parseFloat(this.options.height);

            ctx.strokeStyle = this.options.strokeStyle;
            ctx.beginPath();
            ctx.moveTo(x1 + size / 4, y2);
            ctx.lineTo(x1 + size / 2, y2 + height);
            ctx.lineTo(x2 - size / 4, y2);
            ctx.closePath();
            ctx.stroke();
        }
        // Class RCT = SEGITIGA DIBAWAH (seperti Akar) filled = Perawatan Saluran Akar
        function RCT(vertices, options) {
            this.name = 'RCT';
            this.vertices = vertices;
            this.options = $.extend({ strokeStyle: '#333', fillStyle: '#333', height: 25 }, options);
            return this;
        }
        RCT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x) + 1;
            var x2 = parseFloat(this.vertices[1].x) + 1;
            var y1 = parseFloat(this.vertices[0].y) + 1;
            var y2 = parseFloat(this.vertices[1].y) + 1;
            var size = x2 - x1;
            var height = parseFloat(this.options.height);

            ctx.strokeStyle = this.options.strokeStyle;
            ctx.fillStyle = this.options.fillStyle;
            ctx.beginPath();
            ctx.moveTo(x1 + size / 4, y2);
            ctx.lineTo(x1 + size / 2, y2 + height);
            ctx.lineTo(x2 - size / 4, y2);
            ctx.closePath();
            ctx.fill();
            ctx.stroke();
        }
        // Class NON = gigi tidak ada, tidak diketahui ada atau tidak ada. (non)
        function NON(vertices, options) {
            this.name = 'NON';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#555', fontsize: 12 }, options);
            return this;
        }
        NON.prototype.render = function (ctx) {
            var x = parseFloat(this.vertices[0].x);
            var y = parseFloat(this.vertices[0].y);
            var fontsize = parseInt(this.options.fontsize);

            ctx.fillStyle = '#000';
            ctx.font = "bold " + fontsize + "px Algerian";
            ctx.textBaseline = "bottom";
            ctx.textAlign = "left";
            ctx.fillText('   NON', x, y);
        }
        // Class UNE = Un-Erupted (une)
        function UNE(vertices, options) {
            this.name = 'UNE';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#555', fontsize: 12 }, options);
            return this;
        }
        UNE.prototype.render = function (ctx) {
            var x = parseFloat(this.vertices[0].x);
            var y = parseFloat(this.vertices[0].y);
            var fontsize = parseInt(this.options.fontsize);

            ctx.fillStyle = '#000';
            ctx.font = "bold " + fontsize + "px Algerian";
            ctx.textBaseline = "bottom";
            ctx.textAlign = "left";
            ctx.fillText('   UNE', x, y);
        }
        // Class PRE = Partial-Erupt (pre)
        function PRE(vertices, options) {
            this.name = 'PRE';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#555', fontsize: 12 }, options);
            return this;
        }
        PRE.prototype.render = function (ctx) {
            var x = parseFloat(this.vertices[0].x);
            var y = parseFloat(this.vertices[0].y);
            var fontsize = parseInt(this.options.fontsize);

            ctx.fillStyle = '#000';
            ctx.font = "bold " + fontsize + "px Algerian";
            ctx.textBaseline = "bottom";
            ctx.textAlign = "left";
            ctx.fillText('   PRE', x, y);
        }
        // Class ANO = Anomali (ano), Pegshaped, micro, fusi, etc
        function ANO(vertices, options) {
            this.name = 'ANO';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#555', fontsize: 12 }, options);
            return this;
        }
        ANO.prototype.render = function (ctx) {
            var x = parseFloat(this.vertices[0].x);
            var y = parseFloat(this.vertices[0].y);
            var fontsize = parseInt(this.options.fontsize);

            ctx.fillStyle = '#000';
            ctx.font = "bold " + fontsize + "px Algerian";
            ctx.textBaseline = "bottom";
            ctx.textAlign = "left";
            ctx.fillText('   ANO', x, y);
        }
        // Class CARIES = Caries = Tambalan sementara (car)
        function CARIES(vertices, options) {
            this.name = 'CARIES';
            this.vertices = vertices;
            this.options = $.extend({ strokeStyle: '#333' }, options);
            return this;
        }
        CARIES.prototype.render = function (ctx) {
            ctx.strokeStyle = this.options.strokeStyle;
            ctx.lineWidth = 4;
            ctx.beginPath();

            var vertices = this.vertices.concat([]);
            var fpos = vertices.shift();
            ctx.moveTo(fpos.x, fpos.y);

            var pos;
            while (vertices.length > 0) {
                pos = vertices.shift();
                if (pos) {
                    ctx.lineTo(pos.x, pos.y);
                }
            }
            ctx.lineTo(fpos.x, fpos.y);
            ctx.closePath();
            ctx.stroke();
        }
        // Class CFR = fracture (cfr) (Tanda '#' di tengah" gigi)
        function CFR(vertices, options) {
            this.name = 'CFR';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#555' }, options);
            return this;
        }
        CFR.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);
            var boxSize = x2 - x1;
            var fontsize = parseInt(boxSize);

            var x = x1 + boxSize / 2;
            var y = y1 + boxSize / 2;

            ctx.fillStyle = '#000';
            ctx.font = "bold " + fontsize + "px Algerian";
            ctx.textBaseline = "middle";
            ctx.textAlign = "center";
            ctx.fillText('#', x, y);
        }
        // Class FMC = Full metal crown pada gigi vital (fmc)
        function FMC(vertices, options) {
            this.name = 'FMC';
            this.vertices = vertices;
            this.options = $.extend({ strokeStyle: '#333' }, options);
            return this;
        }
        FMC.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x) + 1;
            var y1 = parseFloat(this.vertices[0].y) + 1;
            var x2 = parseFloat(this.vertices[1].x) + 1;
            var y2 = parseFloat(this.vertices[1].y) + 1;
            var vertices = [
                { x: x1, y: y1 },
                { x: x2, y: y1 },
                { x: x2, y: y2 },
                { x: x1, y: y2 }
            ];

            ctx.strokeStyle = this.options.strokeStyle;
            ctx.lineWidth = 6;
            ctx.beginPath();

            var fpos = vertices.shift();
            ctx.moveTo(fpos.x, fpos.y);

            var pos;
            while (vertices.length > 0) {
                pos = vertices.shift();
                if (pos) {
                    ctx.lineTo(pos.x, pos.y);
                }
            }
            ctx.lineTo(fpos.x, fpos.y);
            ctx.closePath();
            ctx.stroke();
        }
        // Class POC = Porcelain crown pada gigi vital (poc)
        function POC(vertices, options) {
            this.name = 'POC';
            this.vertices = vertices;
            this.options = $.extend({ strokeStyle: '#333' }, options);
            return this;
        }
        POC.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x) + 1;
            var y1 = parseFloat(this.vertices[0].y) + 1;
            var x2 = parseFloat(this.vertices[1].x) + 1;
            var y2 = parseFloat(this.vertices[1].y) + 1;
            var vertices = [
                { x: x1, y: y1 },
                { x: x2, y: y1 },
                { x: x2, y: y2 },
                { x: x1, y: y2 }
            ];

            ctx.strokeStyle = this.options.strokeStyle;
            ctx.lineWidth = 6;
            ctx.beginPath();

            var fpos = vertices.shift();
            ctx.moveTo(fpos.x, fpos.y);

            var pos;
            while (vertices.length > 0) {
                pos = vertices.shift();
                if (pos) {
                    ctx.lineTo(pos.x, pos.y);
                }
            }
            ctx.lineTo(fpos.x, fpos.y);
            ctx.closePath();
            ctx.stroke();

            // Draw Lines
            ctx.lineWidth = 1;
            for (var xpos = x1; xpos < x2; xpos += ((x2 - x1) / 15)) {
                xpos = Math.min(xpos, x2);

                ctx.beginPath();
                ctx.moveTo(xpos, y1);
                ctx.lineTo(xpos, y2);
                ctx.stroke();
            }
        }
        // Class RRX = Sisa Akar (rrx)
        function RRX(vertices, options) {
            this.name = 'RRX';
            this.vertices = vertices;
            this.options = $.extend({ strokeStyle: '#333' }, options);
            return this;
        }
        RRX.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x) + 1;
            var y1 = parseFloat(this.vertices[0].y) + 1;
            var x2 = parseFloat(this.vertices[1].x) + 1;
            var y2 = parseFloat(this.vertices[1].y) + 1;
            var bigBoxSize = x2 - x1;
            var smallBoxSize = bigBoxSize / 2;
            var lines = [
                {
                    x1: x1 + smallBoxSize / 3, y1: y1 - smallBoxSize / 2,
                    x2: x1 + smallBoxSize, y2: y2 + smallBoxSize / 2
                },
                {
                    x1: x1 + smallBoxSize, y1: y2 + smallBoxSize / 2,
                    x2: x1 + smallBoxSize * 2, y2: y1 - smallBoxSize
                }
            ];

            ctx.strokeStyle = this.options.strokeStyle;
            ctx.lineWidth = 4;
            var line;
            for (var i = 0; i < lines.length; i++) {
                line = lines[i];
                ctx.beginPath();
                ctx.moveTo(line.x1, line.y1);
                ctx.lineTo(line.x2, line.y2);
                ctx.stroke();
            }
        }
        // Class MIS = Gigi hilang (mis)
        function MIS(vertices, options) {
            this.name = 'MIS';
            this.vertices = vertices;
            this.options = $.extend({ strokeStyle: '#333' }, options);
            return this;
        }
        MIS.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x) + 1;
            var y1 = parseFloat(this.vertices[0].y) + 1;
            var x2 = parseFloat(this.vertices[1].x) + 1;
            var y2 = parseFloat(this.vertices[1].y) + 1;
            var bigBoxSize = x2 - x1;
            var smallBoxSize = bigBoxSize / 2;
            var lines = [
                {
                    x1: x1 + smallBoxSize * .5, y1: y1 - smallBoxSize / 2,
                    x2: x1 + smallBoxSize * 1.5, y2: y2 + smallBoxSize / 2
                },
                {
                    x1: x1 + smallBoxSize * 1.5, y1: y1 - smallBoxSize / 2,
                    x2: x1 + smallBoxSize * .5, y2: y2 + smallBoxSize / 2
                }
            ];

            ctx.strokeStyle = this.options.strokeStyle;
            ctx.lineWidth = 4;
            var line;
            for (var i = 0; i < lines.length; i++) {
                line = lines[i];
                ctx.beginPath();
                ctx.moveTo(line.x1, line.y1);
                ctx.lineTo(line.x2, line.y2);
                ctx.stroke();
            }
        }
        // Class IPX = Implant + Porcelain crown (ipx - poc)
        function IPX(vertices, options) {
            this.name = 'IPX';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#555', fontsize: 12 }, options);
            return this;
        }
        IPX.prototype.render = function (ctx) {
            var x = parseFloat(this.vertices[0].x);
            var y = parseFloat(this.vertices[0].y);
            var fontsize = parseInt(this.options.fontsize);

            ctx.fillStyle = '#000';
            ctx.font = "bold " + fontsize + "px Algerian";
            ctx.textBaseline = "bottom";
            ctx.textAlign = "left";
            ctx.fillText('   IPX', x, y);
        }
        // Class FRM_ACR = Partial Denture/ Full Denture
        function FRM_ACR(vertices, options) {
            this.name = 'FRM_ACR';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: '#555', fontsize: 12 }, options);
            return this;
        }
        FRM_ACR.prototype.render = function (ctx) {
            var x = parseFloat(this.vertices[0].x) + (parseFloat(this.vertices[1].x) - parseFloat(this.vertices[0].x)) / 2;
            var y = parseFloat(this.vertices[0].y) + (parseFloat(this.vertices[1].x) - parseFloat(this.vertices[0].x)) / 8 - (parseFloat(this.vertices[1].x) - parseFloat(this.vertices[0].x)) / 8;
            var fontsize = parseInt(this.options.fontsize);

            ctx.fillStyle = '#000';
            ctx.font = "bold " + fontsize + "px Algerian";
            ctx.textBaseline = "bottom";
            ctx.textAlign = "center";
            ctx.fillText('   PRD/FLD', x, y);
        }
        // Class Bridge = BRIDGE
        function BRIDGE(startVert, endVert, options) {
            this.name = 'BRIDGE';
            this.startVert = startVert;
            this.endVert = endVert;
            this.options = $.extend({ strokeStyle: '#555' }, options);
            return this;
        }
        BRIDGE.prototype.render = function (ctx) {
            var vert0, vert1;
            if (this.startVert) {
                vert0 = {
                    x1: parseFloat(this.startVert[0].x),
                    y1: parseFloat(this.startVert[0].y),
                    x2: parseFloat(this.startVert[1].x),
                    y2: parseFloat(this.startVert[1].y),
                };
                vert0.size = vert0.x2 - vert0.x1;
                vert0.cx = vert0.x2 - vert0.size / 2;
                vert0.cy = vert0.y2 - vert0.size / 2;
            }

            if (this.endVert) {
                vert1 = {
                    x1: parseFloat(this.endVert[0].x),
                    y1: parseFloat(this.endVert[0].y),
                    x2: parseFloat(this.endVert[1].x),
                    y2: parseFloat(this.endVert[1].y)
                };
                vert1.size = vert1.x2 - vert1.x1;
                vert1.cx = vert1.x2 - vert1.size / 2;
                vert1.cy = vert1.y2 - vert1.size / 2;
            }

            // Draw Bridge in vert0 |
            if (vert0) {
                ctx.strokeStyle = this.options.strokeStyle;
                ctx.lineWidth = 6;
                ctx.beginPath();
                ctx.moveTo(vert0.cx, vert0.y1);
                ctx.lineTo(vert0.cx, vert0.y1 - vert0.size / 4);
                ctx.stroke();
            }

            // Draw Bridge in vert1 |
            if (vert1) {
                ctx.strokeStyle = this.options.strokeStyle;
                ctx.lineWidth = 6;
                ctx.beginPath();
                ctx.moveTo(vert1.cx, vert1.y1);
                ctx.lineTo(vert1.cx, vert1.y1 - vert1.size / 4);
                ctx.stroke();
            }

            // JOIN BRIDGE
            if (vert0 && vert1) {
                var lor = (vert1.cx - vert0.cx) > 0 ? 1 : -1
                ctx.strokeStyle = this.options.strokeStyle;
                ctx.lineWidth = 6;
                ctx.beginPath();
                ctx.moveTo(vert0.cx - 3 * lor, vert0.y1 - vert0.size / 4);
                ctx.lineTo(vert1.cx + 3 * lor, vert1.y1 - vert1.size / 4);
                ctx.stroke();
            }
        }
        // Class HAPUS
        function HAPUS(vertices, options) {
            this.name = 'HAPUS';
            this.vertices = vertices;
            this.options = $.extend({ fillStyle: 'rgba(200, 200, 200, 0.8)' }, options);
            return this;
        }
        HAPUS.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x) + 1;
            var y1 = parseFloat(this.vertices[0].y) + 1;
            var x2 = parseFloat(this.vertices[1].x) + 1;
            var y2 = parseFloat(this.vertices[1].y) + 1;
            var x = x1;
            var y = y1;
            var size = x2 - x1;

            ctx.beginPath();
            ctx.fillStyle = this.options.fillStyle;
            ctx.rect(x, y, size, size);
            ctx.fill();
        }
        // ARROWS
        // Class ARROW_TOP_LEFT
        function ARROW_TOP_LEFT(vertices, options) {
            this.name = 'ARROW_TOP_LEFT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        ARROW_TOP_LEFT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 4;
            fromy = y1 - 10;
            tox = fromx - 25;
            toy = fromy;

            // fromx = 50;
            // fromy = 20;
            // tox = 25;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            var angle = Math.atan2(toy - fromy, tox - fromx);

            ctx.beginPath();
            ctx.moveTo(fromx, fromy);
            ctx.lineTo(tox, toy);
            ctx.strokeStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();

            //starting a new path from the head of the arrow to one of the sides of the point
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //path from the side point of the arrow, to the other side point
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));

            //path from the side point back to the tip of the arrow, and then again to the opposite side point
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //draws the paths created above
            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();
            ctx.fill();
        }

        // Class ARROW_TOP_RIGHT
        function ARROW_TOP_RIGHT(vertices, options) {
            this.name = 'ARROW_TOP_RIGHT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        ARROW_TOP_RIGHT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x1 + (x2 - x1) / 4;
            fromy = y1 - 10;
            tox = fromx + 25;
            toy = fromy;

            // fromx = 60;
            // fromy = 20;
            // tox = 90;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            var angle = Math.atan2(toy - fromy, tox - fromx);

            ctx.beginPath();
            ctx.moveTo(fromx, fromy);
            ctx.lineTo(tox, toy);
            ctx.strokeStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();

            //starting a new path from the head of the arrow to one of the sides of the point
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //path from the side point of the arrow, to the other side point
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));

            //path from the side point back to the tip of the arrow, and then again to the opposite side point
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //draws the paths created above
            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();
            ctx.fill();
        }

        // Class ARROW_TOP_TURN_LEFT
        function ARROW_TOP_TURN_LEFT(vertices, options) {
            this.name = 'ARROW_TOP_TURN_LEFT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        ARROW_TOP_TURN_LEFT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x1 + (x2 - x1) / 4;
            fromy = y1 - 10;
            tox = fromx + 10;
            toy = fromy;

            // fromx = 180;
            // fromy = 20;
            // tox = 190;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.arc(tox, fromy, 5, 1.5 * Math.PI, 0.5 * Math.PI);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(tox, fromy - 5);
            ctx.lineTo(fromx, fromy - 5);
            ctx.stroke();

            var angle = Math.atan2(toy - fromy, tox - fromx);

            toy = toy - 5;
            fromx = fromx - 5;
            ctx.beginPath();
            ctx.moveTo(fromx, toy);
            ctx.lineTo(fromx + headlen * Math.cos(angle + Math.PI / 7), toy + headlen * Math.sin(angle + Math.PI / 7));
            ctx.lineTo(fromx + headlen * Math.cos(angle - Math.PI / 7), toy + headlen * Math.sin(angle - Math.PI / 7));
            ctx.lineTo(fromx, toy);
            ctx.lineTo(fromx + headlen * Math.cos(angle + Math.PI / 7), toy + headlen * Math.sin(angle - Math.PI / 7));
            ctx.stroke();
            ctx.fill();
        }

        // Class ARROW_TOP_TURN_RIGHT
        function ARROW_TOP_TURN_RIGHT(vertices, options) {
            this.name = 'ARROW_TOP_TURN_RIGHT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        ARROW_TOP_TURN_RIGHT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 2;
            fromy = y1 - 10;
            tox = fromx + 10;
            toy = fromy;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.arc(fromx, fromy, 5, 0.38 * Math.PI, 1.5 * Math.PI);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(fromx, fromy - 5);
            ctx.lineTo(tox, fromy - 5);
            ctx.stroke();

            var angle = Math.atan2(toy - fromy, tox - fromx);

            toy = toy - 5;
            tox = tox + 5;
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.stroke();
            ctx.fill();
        }

        // Class ARROW_BOTTOM_LEFT
        function ARROW_BOTTOM_LEFT(vertices, options) {
            this.name = 'ARROW_BOTTOM_LEFT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        ARROW_BOTTOM_LEFT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 4;
            fromy = y2 + 10;
            tox = fromx - 25;
            toy = fromy;

            // fromx = 50;
            // fromy = 20;
            // tox = 25;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            var angle = Math.atan2(toy - fromy, tox - fromx);

            ctx.beginPath();
            ctx.moveTo(fromx, fromy);
            ctx.lineTo(tox, toy);
            ctx.strokeStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();

            //starting a new path from the head of the arrow to one of the sides of the point
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //path from the side point of the arrow, to the other side point
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));

            //path from the side point back to the tip of the arrow, and then again to the opposite side point
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //draws the paths created above
            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();
            ctx.fill();
        }

        // Class ARROW_BOTTOM_RIGHT
        function ARROW_BOTTOM_RIGHT(vertices, options) {
            this.name = 'ARROW_BOTTOM_RIGHT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        ARROW_BOTTOM_RIGHT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x1 + (x2 - x1) / 4;
            fromy = y2 + 10;
            tox = fromx + 25;
            toy = fromy;

            // fromx = 60;
            // fromy = 20;
            // tox = 90;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            var angle = Math.atan2(toy - fromy, tox - fromx);

            ctx.beginPath();
            ctx.moveTo(fromx, fromy);
            ctx.lineTo(tox, toy);
            ctx.strokeStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();

            //starting a new path from the head of the arrow to one of the sides of the point
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //path from the side point of the arrow, to the other side point
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));

            //path from the side point back to the tip of the arrow, and then again to the opposite side point
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //draws the paths created above
            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();
            ctx.fill();
        }

        // Class ARROW_BOTTOM_TURN_LEFT
        function ARROW_BOTTOM_TURN_LEFT(vertices, options) {
            this.name = 'ARROW_BOTTOM_TURN_LEFT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        ARROW_BOTTOM_TURN_LEFT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 2;
            fromy = y2 + 10;
            tox = fromx - 10;
            toy = fromy + 5;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.arc(fromx, fromy, 5, 1.5 * Math.PI, 0.5 * Math.PI);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(fromx, toy);
            ctx.stroke();

            var angle = Math.atan2(toy - fromy, tox);

            toy = toy;
            tox = tox - 5;
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox + headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));
            ctx.lineTo(tox + headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox + headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));
            ctx.stroke();
            ctx.fill();
        }

        // Class ARROW_BOTTOM_TURN_RIGHT
        function ARROW_BOTTOM_TURN_RIGHT(vertices, options) {
            this.name = 'ARROW_BOTTOM_TURN_RIGHT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        ARROW_BOTTOM_TURN_RIGHT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 2;
            fromy = y2 + 10;
            tox = fromx + 10;
            toy = fromy + 5;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.arc(fromx, fromy, 5, 0.38 * Math.PI, 1.5 * Math.PI);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(fromx, toy);
            ctx.lineTo(tox, toy);
            ctx.stroke();

            var angle = Math.atan2(toy - fromy, tox);

            toy = toy;
            tox = tox + 5;
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.stroke();
            ctx.fill();
        }

        // Class BRIDGE_LEFT
        function BRIDGE_LEFT(vertices, options) {
            this.name = 'BRIDGE_LEFT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        BRIDGE_LEFT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x1 + (x2 - x1) / 4;
            fromy = y1 - 5;
            tox = fromx + 10;
            toy = fromy;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.moveTo(tox, fromy);
            ctx.lineTo(fromx - 16, fromy);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(tox, fromy);
            ctx.lineTo(tox, fromy + 5);
            ctx.stroke();
        }

        // Class BRIDGE_RIGHT
        function BRIDGE_RIGHT(vertices, options) {
            this.name = 'BRIDGE_RIGHT';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        BRIDGE_RIGHT.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 2;
            fromy = y1 - 10;
            tox = fromx + 10;
            toy = fromy;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.moveTo(tox - 10, fromy + 5);
            ctx.lineTo(fromx + 26, fromy + 5);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(tox - 10, fromy + 5);
            ctx.lineTo(tox - 10, fromy + 10);
            ctx.stroke();
        }

        // Class BRIDGE_JOIN
        function BRIDGE_JOIN(vertices, options) {
            this.name = 'BRIDGE_JOIN';
            this.vertices = vertices;
            this.options = $.extend({}, options);
            return this;
        }
        BRIDGE_JOIN.prototype.render = function (ctx) {
            var x1 = parseFloat(this.vertices[0].x);
            var y1 = parseFloat(this.vertices[0].y);
            var x2 = parseFloat(this.vertices[1].x);
            var y2 = parseFloat(this.vertices[1].y);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 4;
            fromy = y1 - 10;
            tox = fromx - 25;
            toy = fromy;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.moveTo(fromx + 15, fromy + 5);
            ctx.lineTo(tox - 11, toy + 5);

            ctx.stroke();
        }


        // Class Odontogram
        function Odontogram(jqEl, settings) {
            this.jquery = jqEl;
            this.canvas = jqEl.get(0);
            this.context = jqEl.get(0).getContext('2d');
            this.settings = settings;
            this.mode = ODONTOGRAM_MODE_DEFAULT;
            this.hoverGeoms = [];
            this.geometry = {};
            this.active_geometry = null; // Selected Geometry

            this.teeth = {}; // Menyimpan Coordinate Gigi dengan key: x1:y1;x2:y2;cx:cy

            this._drawBackground();
            return this;
        }

        Odontogram.prototype.setMode = function (mode) {
            this.mode = mode;

            return this;
        };

        Odontogram.prototype._drawBackground = function () {
            var canvas = this.canvas;
            var ctx = this.context;

            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); // Clears the canvas

            var width = ctx.canvas.width;
            var height = ctx.canvas.height;

            var pl = 10,
                pr = 10,
                pt = 30,
                pb = 10,
                gap_per = 10,
                gap_bag = 30;

            var bigBoxSize = (width - (pl + pt + (gap_per * 16) + gap_bag)) / 16;
            var smallBoxSize = bigBoxSize / 2;

            // Numbers
            var numbers = [
                '18', '17', '16', '15', '14', '13', '12', '11', '21', '22', '23', '24', '25', '26', '27', '28',
                '55', '54', '53', '52', '51', '61', '62', '63', '64', '65',
                '85', '84', '83', '82', '81', '71', '72', '73', '74', '75',
                '48', '47', '46', '45', '44', '43', '42', '41', '31', '32', '33', '34', '35', '36', '37', '38'
            ];

            var xpos, ypos;
            var sec = 0;
            var num;
            var x1, x2, y1, y2, cx, cy;
            var key;
            for (var y = 0; y < 4; y++) {
                sec = 0;
                for (var x = 0; x < 16; x++) {
                    if (x % 8 == 0 && x != 0) sec++;
                    // else sec = 0;

                    if ((y % 3 != 0) &&
                        (x < 8 ? (x % 8) - 2 <= 0 : (x % 8) >= 5)) continue;

                    xpos = x * bigBoxSize + (pl) + x * gap_per + (sec * gap_bag);
                    ypos = y * bigBoxSize + pt + (pt * y);

                    // Big Box
                    ctx.beginPath();
                    ctx.lineWidth = "2";
                    ctx.strokeStyle = "#555";
                    ctx.rect(xpos, ypos, bigBoxSize, bigBoxSize);
                    ctx.stroke();

                    // Small Box
                    ctx.beginPath();
                    ctx.lineWidth = "2";
                    ctx.strokeStyle = "#555";
                    ctx.rect(xpos + smallBoxSize / 2, ypos + smallBoxSize / 2, smallBoxSize, smallBoxSize);
                    ctx.stroke();

                    // Lines
                    //// Top Left
                    ctx.beginPath();
                    ctx.moveTo(xpos, ypos);
                    ctx.lineTo(xpos + smallBoxSize / 2, ypos + smallBoxSize / 2);
                    ctx.stroke();
                    //// Top Right
                    ctx.beginPath();
                    ctx.moveTo(xpos + bigBoxSize, ypos);
                    ctx.lineTo(xpos + bigBoxSize - smallBoxSize / 2, ypos + smallBoxSize / 2);
                    ctx.stroke();
                    //// Bottom Left
                    ctx.beginPath();
                    ctx.moveTo(xpos, ypos + bigBoxSize);
                    ctx.lineTo(xpos + smallBoxSize / 2, ypos + bigBoxSize - smallBoxSize / 2);
                    ctx.stroke();
                    //// Bottom Right
                    ctx.beginPath();
                    ctx.moveTo(xpos + bigBoxSize, ypos + bigBoxSize);
                    ctx.lineTo(xpos + bigBoxSize - smallBoxSize / 2, ypos + bigBoxSize - smallBoxSize / 2);
                    ctx.stroke();

                    // Numbers
                    num = numbers.shift();
                    ctx.font = "12px Arial";
                    ctx.textBaseline = "bottom";
                    ctx.textAlign = "center";
                    ctx.fillText(num, xpos + bigBoxSize / 2, ypos + bigBoxSize * 1.4);

                    x1 = xpos; y1 = ypos;
                    x2 = xpos + bigBoxSize; y2 = ypos + bigBoxSize;
                    cx = xpos + bigBoxSize / 2; cy = ypos + bigBoxSize / 2;
                    key = x1 + ':' + y1 + ';' + x2 + ':' + y2 + ';' + cx + ':' + cy;
                    this.teeth[key] = {
                        num: num,
                        bigBoxSize: bigBoxSize,
                        smallBoxSize: smallBoxSize,
                        x1: x1,
                        y1: y1,
                        x2: x2,
                        y2: y2,
                        cx: cx,
                        cy: cy,
                        // Coords shapes (top left, top right, bottom left, bottom right)
                        top: {
                            tl: { x: xpos, y: ypos },
                            tr: { x: xpos + bigBoxSize, y: ypos },
                            br: { x: xpos + bigBoxSize - smallBoxSize / 2, y: ypos + smallBoxSize / 2 },
                            bl: { x: xpos + smallBoxSize / 2, y: ypos + smallBoxSize / 2 }
                        },
                        right: {
                            tl: { x: xpos + bigBoxSize - smallBoxSize / 2, y: ypos + smallBoxSize / 2 },
                            tr: { x: xpos + bigBoxSize, y: ypos },
                            br: { x: xpos + bigBoxSize, y: ypos + bigBoxSize },
                            bl: { x: xpos + bigBoxSize - smallBoxSize / 2, y: ypos + bigBoxSize - smallBoxSize / 2 }
                        },
                        bottom: {
                            tl: { x: xpos + smallBoxSize / 2, y: ypos + bigBoxSize - smallBoxSize / 2 },
                            tr: { x: xpos + bigBoxSize - smallBoxSize / 2, y: ypos + bigBoxSize - smallBoxSize / 2 },
                            br: { x: xpos + bigBoxSize, y: ypos + bigBoxSize },
                            bl: { x: xpos, y: ypos + bigBoxSize }
                        },
                        left: {
                            tl: { x: xpos, y: ypos },
                            tr: { x: xpos + smallBoxSize / 2, y: ypos + smallBoxSize / 2 },
                            br: { x: xpos + smallBoxSize / 2, y: ypos + bigBoxSize - smallBoxSize / 2 },
                            bl: { x: xpos, y: ypos + bigBoxSize }
                        },
                        middle: {
                            tl: { x: xpos + smallBoxSize / 2, y: ypos + smallBoxSize / 2 },
                            tr: { x: xpos + bigBoxSize - smallBoxSize / 2, y: ypos + smallBoxSize / 2 },
                            br: { x: xpos + bigBoxSize - smallBoxSize / 2, y: ypos + bigBoxSize - smallBoxSize / 2 },
                            bl: { x: xpos + smallBoxSize / 2, y: ypos + bigBoxSize - smallBoxSize / 2 }
                        }
                    }
                }
            }

            var me = this;
            var img = new Image();
            img.src = this.getDataURL();
            img.onload = function () {
                me.background = {
                    image: img,
                    x: 1,
                    y: 1,
                    w: img.naturalWidth,
                    h: img.naturalHeight
                };

                me.redraw();
            }
        }

        // TOP
        function top_leftArrow(ctx, coord) {
            var x1 = parseFloat(coord.x1);
            var y1 = parseFloat(coord.y1);
            var x2 = parseFloat(coord.x2);
            var y2 = parseFloat(coord.y2);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 4;
            fromy = y1 - 10;
            tox = fromx - 25;
            toy = fromy;

            // fromx = 50;
            // fromy = 20;
            // tox = 25;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            var angle = Math.atan2(toy - fromy, tox - fromx);

            ctx.beginPath();
            ctx.moveTo(fromx, fromy);
            ctx.lineTo(tox, toy);
            ctx.strokeStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();

            //starting a new path from the head of the arrow to one of the sides of the point
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //path from the side point of the arrow, to the other side point
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));

            //path from the side point back to the tip of the arrow, and then again to the opposite side point
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //draws the paths created above
            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();
            ctx.fill();
        }
        function top_rightArrow(ctx, coord) {
            var x1 = parseFloat(coord.x1);
            var y1 = parseFloat(coord.y1);
            var x2 = parseFloat(coord.x2);
            var y2 = parseFloat(coord.y2);

            var fromx, fromy, tox, toy;
            fromx = x1 + (x2 - x1) / 4;
            fromy = y1 - 10;
            tox = fromx + 25;
            toy = fromy;

            // fromx = 60;
            // fromy = 20;
            // tox = 90;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            var angle = Math.atan2(toy - fromy, tox - fromx);

            ctx.beginPath();
            ctx.moveTo(fromx, fromy);
            ctx.lineTo(tox, toy);
            ctx.strokeStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();

            //starting a new path from the head of the arrow to one of the sides of the point
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //path from the side point of the arrow, to the other side point
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));

            //path from the side point back to the tip of the arrow, and then again to the opposite side point
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //draws the paths created above
            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();
            ctx.fill();
        }
        function top_turnLeftArrow(ctx, coord) {
            var x1 = parseFloat(coord.x1);
            var y1 = parseFloat(coord.y1);
            var x2 = parseFloat(coord.x2);
            var y2 = parseFloat(coord.y2);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 2;
            fromy = y1 - 10;
            tox = fromx + 10;
            toy = fromy;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.arc(fromx, fromy, 5, 0.38 * Math.PI, 1.5 * Math.PI);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(fromx, fromy - 5);
            ctx.lineTo(tox, fromy - 5);
            ctx.stroke();

            var angle = Math.atan2(toy - fromy, tox - fromx);

            toy = toy - 5;
            tox = tox + 5;
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.stroke();
            ctx.fill();

            //starting a new path from the head of the arrow to one of the sides of the point
            // ctx.beginPath();
            // ctx.moveTo(tox, toy);
            // ctx.lineTo(tox-headlen*Math.cos(angle-Math.PI/7),toy-headlen*Math.sin(angle-Math.PI/7));

            //path from the side point of the arrow, to the other side point
            // ctx.lineTo(tox-headlen*Math.cos(angle+Math.PI/7),toy-headlen*Math.sin(angle+Math.PI/7));

            //path from the side point back to the tip of the arrow, and then again to the opposite side point
            // ctx.lineTo(tox, toy);
            // ctx.lineTo(tox-headlen*Math.cos(angle-Math.PI/7),toy-headlen*Math.sin(angle-Math.PI/7));

            //draws the paths created above
            // ctx.strokeStyle = "#000000";
            // ctx.lineWidth = lineWidth;
            // ctx.stroke();
        }
        function top_turnRightArrow(ctx, coord) {
            var x1 = parseFloat(coord.x1);
            var y1 = parseFloat(coord.y1);
            var x2 = parseFloat(coord.x2);
            var y2 = parseFloat(coord.y2);

            var fromx, fromy, tox, toy;
            fromx = x1 + (x2 - x1) / 4;
            fromy = y1 - 10;
            tox = fromx + 10;
            toy = fromy;

            // fromx = 180;
            // fromy = 20;
            // tox = 190;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.arc(tox, fromy, 5, 1.5 * Math.PI, 0.5 * Math.PI);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(tox, fromy - 5);
            ctx.lineTo(fromx, fromy - 5);
            ctx.stroke();

            var angle = Math.atan2(toy - fromy, tox - fromx);

            toy = toy - 5;
            fromx = fromx - 5;
            ctx.beginPath();
            ctx.moveTo(fromx, toy);
            ctx.lineTo(fromx + headlen * Math.cos(angle + Math.PI / 7), toy + headlen * Math.sin(angle + Math.PI / 7));
            ctx.lineTo(fromx + headlen * Math.cos(angle - Math.PI / 7), toy + headlen * Math.sin(angle - Math.PI / 7));
            ctx.lineTo(fromx, toy);
            ctx.lineTo(fromx + headlen * Math.cos(angle + Math.PI / 7), toy + headlen * Math.sin(angle - Math.PI / 7));
            ctx.stroke();
            ctx.fill();
        }
        // BOTTOM
        function bottom_leftArrow(ctx, coord) {
            var x1 = parseFloat(coord.x1);
            var y1 = parseFloat(coord.y1);
            var x2 = parseFloat(coord.x2);
            var y2 = parseFloat(coord.y2);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 4;
            fromy = y2 + 10;
            tox = fromx - 25;
            toy = fromy;

            // fromx = 50;
            // fromy = 20;
            // tox = 25;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            var angle = Math.atan2(toy - fromy, tox - fromx);

            ctx.beginPath();
            ctx.moveTo(fromx, fromy);
            ctx.lineTo(tox, toy);
            ctx.strokeStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();

            //starting a new path from the head of the arrow to one of the sides of the point
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //path from the side point of the arrow, to the other side point
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));

            //path from the side point back to the tip of the arrow, and then again to the opposite side point
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //draws the paths created above
            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();
            ctx.fill();
        }

        function bottom_rightArrow(ctx, coord) {
            var x1 = parseFloat(coord.x1);
            var y1 = parseFloat(coord.y1);
            var x2 = parseFloat(coord.x2);
            var y2 = parseFloat(coord.y2);

            var fromx, fromy, tox, toy;
            fromx = x1 + (x2 - x1) / 4;
            fromy = y2 + 10;
            tox = fromx + 25;
            toy = fromy;

            // fromx = 60;
            // fromy = 20;
            // tox = 90;
            // toy = 20;

            var headlen = 10;
            var lineWidth = 2;

            var angle = Math.atan2(toy - fromy, tox - fromx);

            ctx.beginPath();
            ctx.moveTo(fromx, fromy);
            ctx.lineTo(tox, toy);
            ctx.strokeStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();

            //starting a new path from the head of the arrow to one of the sides of the point
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //path from the side point of the arrow, to the other side point
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));

            //path from the side point back to the tip of the arrow, and then again to the opposite side point
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));

            //draws the paths created above
            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;
            ctx.stroke();
            ctx.fill();
        }

        function bottom_turnLeftArrow(ctx, coord) {
            var x1 = parseFloat(coord.x1);
            var y1 = parseFloat(coord.y1);
            var x2 = parseFloat(coord.x2);
            var y2 = parseFloat(coord.y2);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 2;
            fromy = y2 + 10;
            tox = fromx + 10;
            toy = fromy + 5;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.arc(fromx, fromy, 5, 0.38 * Math.PI, 1.5 * Math.PI);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(fromx, toy);
            ctx.lineTo(tox, toy);
            ctx.stroke();

            var angle = Math.atan2(toy - fromy, tox);

            toy = toy;
            tox = tox + 5;
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.lineTo(tox - headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox - headlen * Math.cos(angle - Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.stroke();
            ctx.fill();
        }

        function bottom_turnRightArrow(ctx, coord) {
            var x1 = parseFloat(coord.x1);
            var y1 = parseFloat(coord.y1);
            var x2 = parseFloat(coord.x2);
            var y2 = parseFloat(coord.y2);

            var fromx, fromy, tox, toy;
            fromx = x2 - (x2 - x1) / 2;
            fromy = y2 + 10;
            tox = fromx - 10;
            toy = fromy + 5;

            var headlen = 10;
            var lineWidth = 2;

            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000";
            ctx.lineWidth = lineWidth;

            ctx.beginPath();
            ctx.arc(fromx, fromy, 5, 1.5 * Math.PI, 0.5 * Math.PI);
            ctx.stroke();

            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(fromx, toy);
            ctx.stroke();

            var angle = Math.atan2(toy - fromy, tox);

            toy = toy;
            tox = tox - 5;
            ctx.beginPath();
            ctx.moveTo(tox, toy);
            ctx.lineTo(tox + headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));
            ctx.lineTo(tox + headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle - Math.PI / 7));
            ctx.lineTo(tox, toy);
            ctx.lineTo(tox + headlen * Math.cos(angle + Math.PI / 7), toy - headlen * Math.sin(angle + Math.PI / 7));
            ctx.stroke();
            ctx.fill();
        }

        Odontogram.prototype.redraw = function () {
            var canvas = this.canvas;
            var ctx = this.context;

            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); // Clears the canvas

            if (this.background) { // Background
                ctx.drawImage(this.background.image, this.background.x, this.background.y, ctx.canvas.width, ctx.canvas.height);
            }

            // Draw Hover Geom
            var hoverGeoms;
            for (var i = 0; i < this.hoverGeoms.length; i++) {
                hoverGeoms = convertGeom(this.hoverGeoms[i], this.mode);
                hoverGeoms.render(ctx);
            }


            // Draw Geometry
            var geoms;
            for (var keyCoord in this.geometry) {
                geoms = this.geometry[keyCoord];
                for (var x in geoms) {
                    geoms[x].render(ctx);
                }
            }

            if (this.active_geometry) {
                this.active_geometry.render(ctx);
            }

            return this;
        };

        Odontogram.prototype.setGeometry = function (geometry) {
            for (var keyCoord in geometry) {
                for (var i = 0; i < geometry[keyCoord].length; i++) {
                    geometry[keyCoord][i] = convertGeomFromObject(geometry[keyCoord][i]);
                }
            }

            this.geometry = geometry;

            this.redraw();
        }

        const search = (key, value, obj) => {
            for (let k in obj) {
                if (obj[k][key] == value) {
                    return [k, obj[k]];
                }
            }
            return null;
        }

        Odontogram.prototype.setGeometryByPos = function (data) {
            let geometry = {};
            for (d of data) {
                if (!d.code || !d.pos) continue;
                if (d.pos.includes('-')) {
                    [pos, sub] = d.pos.split('-');
                    const t = search('num', pos, this.teeth);
                    let s;
                    if (sub == 'L') s = t[1].left
                    else if (sub == 'R') s = t[1].right
                    else if (sub == 'B') s = t[1].bottom
                    else if (sub == 'T') s = t[1].top
                    else if (sub == 'M') s = t[1].middle

                    if (!geometry[t[0]]) geometry[t[0]] = []

                    geometry[t[0]].push({
                        name: d.code,
                        pos: d.pos,
                        vertices: [s.bl, s.br, s.tr, s.tl]
                    })
                } else {
                    const t = search('num', d.pos, this.teeth);
                    if (!geometry[t[0]]) geometry[t[0]] = []
                    geometry[t[0]].push({
                        name: d.code,
                        pos: d.pos,
                        vertices: [
                            { x: t[1].x1, y: t[1].y1 },
                            { x: t[1].x2, y: t[1].y2 }
                        ]
                    })
                }
            }
            this.setGeometry(geometry);
            return geometry;
        }

        Odontogram.prototype.getDataURL = function () {
            return this.canvas.toDataURL();
        }

        $.fn.odontogram = function (mode, arg1, arg2, arg3, arg4) {
            var instance = this.data('odontogram');
            switch (mode) {
                case 'init': // Arg1 is options
                    if (this.prop('nodeName') !== "CANVAS") {
                        throw Error('Odontogram must be valid `CANVAS`.');
                    }

                    if (instance != null) {
                        throw Error("can't reinitialize odontogram.");
                    }

                    return initialize(this, arg1);
                case 'setMode':
                    instance.active_geometry = null;
                    checkOdontogram(this, mode);
                    setMode(this, arg1);
                    break;
                case 'redraw':
                    checkOdontogram(this, mode);
                    redraw(this);
                    break;
                case 'getDataURL':
                    checkOdontogram(this, mode);
                    return instance.getDataURL();
                    break;
                case 'setGeometry':
                    checkOdontogram(this, mode);
                    instance.setGeometry(arg1);
                    break;
                // DLL
            }

            return this;
        }

        function initialize($this, options) {
            var settings = $.extend({}, $.fn.odontogram.defaults, options);

            var canvas = $this.get(0);

            $this.prop('height', settings.height)
                .prop('width', settings.width)
                .css('width', settings.width)
                .css('height', settings.height);

            canvas.width = parseFloat(settings.width);
            canvas.height = parseFloat(settings.height);

            var instance = new Odontogram($this, settings);

            $this.data('odontogram', instance);

            $this
                .on('mousemove', _on_mouse_move)
                .on('click', _on_mouse_click);

            return instance;
        }

        function setMode($this, mode) {
            // TODO
            // switch (mode) {
            //     default:
            //         throw Error("Odontogram invalid mode `" + mode + "`");
            // }
            var instance = $this.data('odontogram');
            instance.setMode(mode);
        }

        function redraw($this) {
            var instance = $this.data('odontogram');
            instance.redraw();
        }

        function checkOdontogram($this, mode) {
            if ($this.data('odontogram') == null || !($this.data('odontogram') instanceof Odontogram)) {
                throw Error('`' + mode + '` must be valid Odontogram object.');
            }
        }

        // HELPERS
        // Convert Geometry to Specific Mode (geometry = Polygon)
        function convertGeom(geometry, mode) {
            var newGeometry;
            switch (mode) {
                case ODONTOGRAM_MODE_AMF:
                    newGeometry = new AMF(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_COF:
                    newGeometry = new COF(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_FIS:
                    newGeometry = new FIS(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_NVT:
                    newGeometry = new NVT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_RCT:
                    newGeometry = new RCT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_NON:
                    newGeometry = new NON(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_UNE:
                    newGeometry = new UNE(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_PRE:
                    newGeometry = new PRE(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_ANO:
                    newGeometry = new ANO(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_CARIES:
                    newGeometry = new CARIES(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_CFR:
                    newGeometry = new CFR(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_FMC:
                    newGeometry = new FMC(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_POC:
                    newGeometry = new POC(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_RRX:
                    newGeometry = new RRX(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_MIS:
                    newGeometry = new MIS(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_IPX:
                    newGeometry = new IPX(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_FRM_ACR:
                    newGeometry = new FRM_ACR(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_BRIDGE:
                    newGeometry = new BRIDGE(geometry[0], geometry[1]);
                    break;
                case ODONTOGRAM_MODE_HAPUS:
                    newGeometry = new HAPUS(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_ARROW_TOP_LEFT:
                    newGeometry = new ARROW_TOP_LEFT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_ARROW_TOP_RIGHT:
                    newGeometry = new ARROW_TOP_RIGHT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_ARROW_TOP_TURN_LEFT:
                    newGeometry = new ARROW_TOP_TURN_LEFT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_ARROW_TOP_TURN_RIGHT:
                    newGeometry = new ARROW_TOP_TURN_RIGHT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_ARROW_BOTTOM_LEFT:
                    newGeometry = new ARROW_BOTTOM_LEFT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_ARROW_BOTTOM_RIGHT:
                    newGeometry = new ARROW_BOTTOM_RIGHT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_LEFT:
                    newGeometry = new ARROW_BOTTOM_TURN_LEFT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_RIGHT:
                    newGeometry = new ARROW_BOTTOM_TURN_RIGHT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_BRIDGE_LEFT:
                    newGeometry = new BRIDGE_LEFT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_BRIDGE_RIGHT:
                    newGeometry = new BRIDGE_RIGHT(geometry.vertices);
                    break;
                case ODONTOGRAM_MODE_BRIDGE_JOIN:
                    newGeometry = new BRIDGE_JOIN(geometry.vertices);
                    break;
                default:
                    newGeometry = geometry;
                    break;
            }
            newGeometry.pos = geometry.pos;

            return newGeometry;
        }

        function convertGeomFromObject(geometry) {
            var newGeom = null;
            switch (geometry.name) {
                case 'Polygon':
                    newGeom = new Polygon(geometry.vertices, geometry.options);
                    break;
                case 'AMF':
                    newGeom = new AMF(geometry.vertices, geometry.options);
                    break;
                case 'COF':
                    newGeom = new COF(geometry.vertices, geometry.options);
                    break;
                case 'FIS':
                    newGeom = new FIS(geometry.vertices, geometry.options);
                    break;
                case 'NVT':
                    newGeom = new NVT(geometry.vertices, geometry.options);
                    break;
                case 'RCT':
                    newGeom = new RCT(geometry.vertices, geometry.options);
                    break;
                case 'NON':
                    newGeom = new NON(geometry.vertices, geometry.options);
                    break;
                case 'UNE':
                    newGeom = new UNE(geometry.vertices, geometry.options);
                    break;
                case 'PRE':
                    newGeom = new PRE(geometry.vertices, geometry.options);
                    break;
                case 'ANO':
                    newGeom = new ANO(geometry.vertices, geometry.options);
                    break;
                case 'CARIES':
                    newGeom = new CARIES(geometry.vertices, geometry.options);
                    break;
                case 'CFR':
                    newGeom = new CFR(geometry.vertices, geometry.options);
                    break;
                case 'FMC':
                    newGeom = new FMC(geometry.vertices, geometry.options);
                    break;
                case 'POC':
                    newGeom = new POC(geometry.vertices, geometry.options);
                    break;
                case 'RRX':
                    newGeom = new RRX(geometry.vertices, geometry.options);
                    break;
                case 'MIS':
                    newGeom = new MIS(geometry.vertices, geometry.options);
                    break;
                case 'IPX':
                    newGeom = new IPX(geometry.vertices, geometry.options);
                    break;
                case 'FRM_ACR':
                    newGeom = new FRM_ACR(geometry.vertices, geometry.options);
                    break;
                case 'BRIDGE':
                    newGeom = new BRIDGE(geometry.startVert, geometry.endVert, geometry.options);
                    break;
                case 'ARROW_TOP_LEFT':
                    newGeom = new ARROW_TOP_LEFT(geometry.vertices, geometry.options);
                    break;
                case 'ARROW_TOP_RIGHT':
                    newGeom = new ARROW_TOP_RIGHT(geometry.vertices, geometry.options);
                    break;
                case 'ARROW_TOP_TURN_LEFT':
                    newGeom = new ARROW_TOP_TURN_LEFT(geometry.vertices, geometry.options);
                    break;
                case 'ARROW_TOP_TURN_RIGHT':
                    newGeom = new ARROW_TOP_TURN_RIGHT(geometry.vertices, geometry.options);
                    break;
                case 'ARROW_BOTTOM_LEFT':
                    newGeom = new ARROW_BOTTOM_LEFT(geometry.vertices, geometry.options);
                    break;
                case 'ARROW_BOTTOM_RIGHT':
                    newGeom = new ARROW_BOTTOM_RIGHT(geometry.vertices, geometry.options);
                    break;
                case 'ARROW_BOTTOM_TURN_LEFT':
                    newGeom = new ARROW_BOTTOM_TURN_LEFT(geometry.vertices, geometry.options);
                    break;
                case 'ARROW_BOTTOM_TURN_RIGHT':
                    newGeom = new ARROW_BOTTOM_TURN_RIGHT(geometry.vertices, geometry.options);
                    break;
                case 'BRIDGE_LEFT':
                    newGeom = new BRIDGE_LEFT(geometry.vertices, geometry.options);
                    break;
                case 'BRIDGE_RIGHT':
                    newGeom = new BRIDGE_RIGHT(geometry.vertices, geometry.options);
                    break;
                case 'BRIDGE_JOIN':
                    newGeom = new BRIDGE_JOIN(geometry.vertices, geometry.options);
                    break;
                case 'HAPUS':
                    newGeom = new HAPUS(geometry.vertices, geometry.options);
                    break;
            }

            newGeom.pos = geometry.pos;

            return newGeom;
        }

        //// Check Hover On Teeth (return Geom)
        function getHoverShapeOnTeeth(mouse, teeth) {
            var geoms = [];
            for (var key in teeth) {
                switch (key) {
                    case 'middle':
                    case 'top':
                    case 'bottom':
                    case 'left':
                    case 'right':
                        if (isPolyIntersect(teeth[key], { mouse: mouse })) {
                            geoms.push({ name: key, coord: teeth[key] });
                        }
                        break;
                }
            }

            var polygonOpt = {
                fillStyle: 'rgba(55, 55, 55, 0.2)'
            };
            var polygons = [];
            var vertices;
            for (var i = 0; i < geoms.length; i++) {
                vertices = [];
                for (var key in geoms[i].coord) {
                    vertices.push(geoms[i].coord[key]);
                }
                const pol = new Polygon(vertices, polygonOpt);
                pol.name = geoms[i].name;
                polygons.push(pol);
            }

            return polygons;
        }

        function isRectIntersect(rectA, rectB) {
            return rectA.x1 < rectB.x2 && rectA.x2 > rectB.x1 &&
                rectA.y1 < rectB.y2 && rectA.y2 > rectB.y1;
        }

        function isPolyIntersect(polyA, polyB) {
            var polyAVertices = getPolyVertices(polyA);
            var polyBVertices = getPolyVertices(polyB);

            // Sementara Menggunakan Rectangle Collision
            if (polyAVertices.length == 4 && polyBVertices.length == 1) {
                var rectA = {
                    x1: polyAVertices[0].x,
                    x2: polyAVertices[1].x,
                    y1: polyAVertices[0].y,
                    y2: polyAVertices[2].y
                };
                var rectB = {
                    x1: polyBVertices[0].x,
                    x2: polyBVertices[0].x,
                    y1: polyBVertices[0].y,
                    y2: polyBVertices[0].y
                }

                return isRectIntersect(rectA, rectB);
            }

            return true;
        }

        function getPolyVertices(poly) {
            var vertices = [];
            for (var key in poly) {
                vertices.push(poly[key]);
            }
            return vertices;
        }

        function parseKeyCoord(key) {
            var x1, x2, y1, y2, cx, cy;
            var keyChunks, temp;

            keyChunks = key.split(';');
            for (var i = 0; i < 3; i++) {
                temp = keyChunks[i].split(':');
                if (i == 0) {
                    x1 = temp[0];
                    y1 = temp[1];
                } else if (i == 1) {
                    x2 = temp[0];
                    y2 = temp[1];
                } else {
                    cx = temp[0];
                    cy = temp[1];
                }
            }

            return {
                x1: x1, y1: y1,
                x2: x2, y2: y2,
                cx: cx, cy: cy
            };
        }

        // Menggabungkan, jika ada bentuk yang tidak sesuai maka akan dihapus atau diganti.
        function joinShapeTeeth(geoms1, geoms2) {
            var geometry = $.extend(true, {}, geoms1);
            var geom1, geom2;
            for (var keyCoord in geoms2) {
                geom1 = geoms1[keyCoord];
                geom2 = geoms2[keyCoord];
                if (geom1 == null) {
                    geometry[keyCoord] = geom2;
                } else {
                    geometry[keyCoord] = _joinShapeTeeth(geom1, geom2);
                }
            }

            return geometry;
        }

        // Rules :..(
        function _joinShapeTeeth(geoms1, geoms2) {
            var geom1, geom2;
            var geometry = [];
            for (var y = 0; y < geoms2.length; y++) {
                geom2 = geoms2[y];
                geometry = [geom2];
                for (var x = 0; x < geoms1.length; x++) {
                    geom1 = geoms1[x];
                    switch (true) {
                        case geom2 instanceof AMF:
                            switch (true) {
                                case geom1 instanceof AMF:
                                case geom1 instanceof RCT:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof COF:
                            switch (true) {
                                case geom1 instanceof COF:
                                case geom1 instanceof RCT:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof FIS:
                            switch (true) {
                                case geom1 instanceof FIS:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof NVT:
                            switch (true) {
                                case geom1 instanceof NVT:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof RCT:
                            switch (true) {
                                case geom1 instanceof AMF:
                                case geom1 instanceof COF:
                                case geom1 instanceof POC:
                                case geom1 instanceof FMC:
                                case geom1 instanceof BRIDGE:
                                case geom1 instanceof BRIDGE_LEFT:
                                case geom1 instanceof BRIDGE_RIGHT:
                                case geom1 instanceof BRIDGE_JOIN:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                            break;
                        case geom2 instanceof NON:
                            switch (true) {
                                case geom1 instanceof NON:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof UNE:
                            switch (true) {
                                case geom1 instanceof UNE:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof PRE:
                            switch (true) {
                                case geom1 instanceof PRE:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof ANO:
                            switch (true) {
                                case geom1 instanceof ANO:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof CARIES:
                            switch (true) {
                                case geom1 instanceof CARIES:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof CFR:
                            //
                            break;
                        case geom2 instanceof FMC:
                            switch (true) {
                                case geom1 instanceof RCT:
                                case geom1 instanceof MIS:
                                case geom1 instanceof BRIDGE:
                                case geom1 instanceof BRIDGE_LEFT:
                                case geom1 instanceof BRIDGE_RIGHT:
                                case geom1 instanceof BRIDGE_JOIN:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof POC:
                            switch (true) {
                                case geom1 instanceof POC:
                                case geom1 instanceof IPX:
                                case geom1 instanceof RCT:
                                case geom1 instanceof MIS:
                                case geom1 instanceof BRIDGE:
                                case geom1 instanceof BRIDGE_LEFT:
                                case geom1 instanceof BRIDGE_RIGHT:
                                case geom1 instanceof BRIDGE_JOIN:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof RRX:
                            // 
                            break;
                        case geom2 instanceof MIS:
                            switch (true) {
                                case geom1 instanceof POC:
                                case geom1 instanceof FMC:
                                case geom1 instanceof FRM_ACR:
                                case geom1 instanceof BRIDGE:
                                case geom1 instanceof BRIDGE_LEFT:
                                case geom1 instanceof BRIDGE_RIGHT:
                                case geom1 instanceof BRIDGE_JOIN:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof IPX:
                            switch (true) {
                                case geom1 instanceof POC:
                                case geom1 instanceof BRIDGE:
                                case geom1 instanceof BRIDGE_LEFT:
                                case geom1 instanceof BRIDGE_RIGHT:
                                case geom1 instanceof BRIDGE_JOIN:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof FRM_ACR:
                            switch (true) {
                                case geom1 instanceof MIS:
                                case geom1 instanceof BRIDGE:
                                case geom1 instanceof BRIDGE_LEFT:
                                case geom1 instanceof BRIDGE_RIGHT:
                                case geom1 instanceof BRIDGE_JOIN:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof BRIDGE:
                            switch (true) {
                                case geom1 instanceof POC:
                                case geom1 instanceof FMC:
                                case geom1 instanceof FRM_ACR:
                                case geom1 instanceof RCT:
                                case geom1 instanceof MIS:
                                case geom1 instanceof IPX:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof BRIDGE_LEFT:
                            switch (true) {
                                case geom1 instanceof POC:
                                case geom1 instanceof FMC:
                                case geom1 instanceof FRM_ACR:
                                case geom1 instanceof RCT:
                                case geom1 instanceof MIS:
                                case geom1 instanceof IPX:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof BRIDGE_RIGHT:
                            switch (true) {
                                case geom1 instanceof POC:
                                case geom1 instanceof FMC:
                                case geom1 instanceof FRM_ACR:
                                case geom1 instanceof RCT:
                                case geom1 instanceof MIS:
                                case geom1 instanceof IPX:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        case geom2 instanceof BRIDGE_JOIN:
                            switch (true) {
                                case geom1 instanceof POC:
                                case geom1 instanceof FMC:
                                case geom1 instanceof FRM_ACR:
                                case geom1 instanceof RCT:
                                case geom1 instanceof MIS:
                                case geom1 instanceof IPX:
                                    geometry.push(geom1);
                                    break;
                            }
                            break;
                        default:
                            console.log("DEFAULT[POLYGON]");
                            break;
                    }
                }
            }

            return geometry;
        }

        function getMouse(evt) {
            var offsetX, offsetY;
            if (typeof evt.offsetX != 'undefined') {
                offsetX = evt.offsetX;
                offsetY = evt.offsetY;
            } else if (typeof evt.layerX != 'undefined') {
                offsetX = evt.layerX;
                offsetY = evt.layerY;
            }

            return { 'x': offsetX, 'y': offsetY };
        }


        // Handlers
        function _on_mouse_move(e) {
            var mouse = getMouse(e);
            var $this = $(e.target);
            var instance = $this.data('odontogram');

            instance.hoverGeoms = [];

            var teeth, coord, hoverGeoms;
            for (var keyCoord in instance.teeth) {
                teeth = instance.teeth[keyCoord];
                coord = parseKeyCoord(keyCoord);

                switch (instance.mode) {
                    case ODONTOGRAM_MODE_NVT: // Kotak
                    case ODONTOGRAM_MODE_RCT:
                    case ODONTOGRAM_MODE_NON:
                    case ODONTOGRAM_MODE_UNE:
                    case ODONTOGRAM_MODE_PRE:
                    case ODONTOGRAM_MODE_ANO:
                    case ODONTOGRAM_MODE_CFR:
                    case ODONTOGRAM_MODE_FMC:
                    case ODONTOGRAM_MODE_POC:
                    case ODONTOGRAM_MODE_RRX:
                    case ODONTOGRAM_MODE_MIS:
                    case ODONTOGRAM_MODE_IPX:
                    case ODONTOGRAM_MODE_FRM_ACR:
                    case ODONTOGRAM_MODE_HAPUS:
                    case ODONTOGRAM_MODE_ARROW_TOP_LEFT:
                    case ODONTOGRAM_MODE_ARROW_TOP_RIGHT:
                    case ODONTOGRAM_MODE_ARROW_TOP_TURN_LEFT:
                    case ODONTOGRAM_MODE_ARROW_TOP_TURN_RIGHT:
                    case ODONTOGRAM_MODE_ARROW_BOTTOM_LEFT:
                    case ODONTOGRAM_MODE_ARROW_BOTTOM_RIGHT:
                    case ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_LEFT:
                    case ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_RIGHT:
                    case ODONTOGRAM_MODE_BRIDGE_LEFT:
                    case ODONTOGRAM_MODE_BRIDGE_RIGHT:
                    case ODONTOGRAM_MODE_BRIDGE_JOIN:
                        if (isRectIntersect(coord, { x1: mouse.x, y1: mouse.y, x2: mouse.x, y2: mouse.y })) {
                            hoverGeoms = [{
                                vertices: [
                                    { x: coord.x1, y: coord.y1 },
                                    { x: coord.x2, y: coord.y2 }
                                ]
                            }];

                            instance.hoverGeoms = instance.hoverGeoms.concat(hoverGeoms);
                        }
                        break;
                    case ODONTOGRAM_MODE_BRIDGE:
                        if (isRectIntersect(coord, { x1: mouse.x, y1: mouse.y, x2: mouse.x, y2: mouse.y })) {
                            hoverGeoms = [
                                { x: coord.x1, y: coord.y1 },
                                { x: coord.x2, y: coord.y2 }
                            ];

                            if (instance.active_geometry) {
                                instance.hoverGeoms = [
                                    [instance.active_geometry.startVert, hoverGeoms]
                                ];
                            } else {
                                instance.hoverGeoms = [
                                    [hoverGeoms, null]
                                ];
                            }
                        }
                        break;
                    default: // Setiap Bagian
                        if (isRectIntersect(coord, { x1: mouse.x, y1: mouse.y, x2: mouse.x, y2: mouse.y })) {
                            hoverGeoms = getHoverShapeOnTeeth(mouse, teeth);

                            instance.hoverGeoms = instance.hoverGeoms.concat(hoverGeoms);
                        }
                        break;
                }

            }

            if (instance.hoverGeoms.length > 0) {
                $this.css('cursor', 'pointer');
                if (instance.mode == ODONTOGRAM_MODE_HAPUS) {
                    $this.css('cursor', 'move');
                }
            } else {
                $this.css('cursor', 'default');
            }

            instance.redraw();
        }

        function _on_mouse_click(e) {
            var mouse = getMouse(e);
            var $this = $(e.target);
            var instance = $this.data('odontogram');

            if (instance.mode == ODONTOGRAM_MODE_DEFAULT) return;

            var teeth, coord;
            var tempGeoms = {};
            var temp;
            for (var keyCoord in instance.teeth) {
                teeth = instance.teeth[keyCoord];
                coord = parseKeyCoord(keyCoord);

                switch (instance.mode) {
                    case ODONTOGRAM_MODE_NVT: // Kotak
                    case ODONTOGRAM_MODE_RCT:
                    case ODONTOGRAM_MODE_NON:
                    case ODONTOGRAM_MODE_UNE:
                    case ODONTOGRAM_MODE_PRE:
                    case ODONTOGRAM_MODE_ANO:
                    case ODONTOGRAM_MODE_CFR:
                    case ODONTOGRAM_MODE_FMC:
                    case ODONTOGRAM_MODE_POC:
                    case ODONTOGRAM_MODE_RRX:
                    case ODONTOGRAM_MODE_MIS:
                    case ODONTOGRAM_MODE_IPX:
                    case ODONTOGRAM_MODE_FRM_ACR:
                    case ODONTOGRAM_MODE_HAPUS:
                    case ODONTOGRAM_MODE_ARROW_TOP_LEFT:
                    case ODONTOGRAM_MODE_ARROW_TOP_RIGHT:
                    case ODONTOGRAM_MODE_ARROW_TOP_TURN_LEFT:
                    case ODONTOGRAM_MODE_ARROW_TOP_TURN_RIGHT:
                    case ODONTOGRAM_MODE_ARROW_BOTTOM_LEFT:
                    case ODONTOGRAM_MODE_ARROW_BOTTOM_RIGHT:
                    case ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_LEFT:
                    case ODONTOGRAM_MODE_ARROW_BOTTOM_TURN_RIGHT:
                    case ODONTOGRAM_MODE_BRIDGE_LEFT:
                    case ODONTOGRAM_MODE_BRIDGE_RIGHT:
                    case ODONTOGRAM_MODE_BRIDGE_JOIN:
                        if (isRectIntersect(coord, { x1: mouse.x, y1: mouse.y, x2: mouse.x, y2: mouse.y })) {
                            tempGeoms[keyCoord] = [convertGeom({
                                vertices: [
                                    { x: coord.x1, y: coord.y1 },
                                    { x: coord.x2, y: coord.y2 }
                                ],
                                pos: teeth.num
                            }, instance.mode)];
                        }
                        break;
                    case ODONTOGRAM_MODE_BRIDGE:
                        if (isRectIntersect(coord, { x1: mouse.x, y1: mouse.y, x2: mouse.x, y2: mouse.y })) {
                            tempGeoms[keyCoord] = [];
                            if (instance.active_geometry) {
                                instance.active_geometry = convertGeom([
                                    instance.active_geometry.startVert,
                                    [
                                        { x: coord.x1, y: coord.y1 },
                                        { x: coord.x2, y: coord.y2 }
                                    ]
                                ], instance.mode);

                                tempGeoms[keyCoord].push(instance.active_geometry);
                                instance.active_geometry = null;
                            } else {
                                instance.active_geometry = convertGeom([
                                    [
                                        { x: coord.x1, y: coord.y1 },
                                        { x: coord.x2, y: coord.y2 }
                                    ],
                                    null
                                ], instance.mode);
                            }
                        }
                        break;
                    default: // Setiap Bagian
                        if (isRectIntersect(coord, { x1: mouse.x, y1: mouse.y, x2: mouse.x, y2: mouse.y })) {
                            tempGeoms[keyCoord] = [];
                            temp = getHoverShapeOnTeeth(mouse, teeth);
                            for (var i = 0; i < temp.length; i++) {
                                temp[i].pos = teeth.num + '-' + temp[i].name.charAt(0).toUpperCase();
                                tempGeoms[keyCoord].push(convertGeom(temp[i], instance.mode));
                            }
                        }
                        break;
                }

            }

            if (instance.mode == ODONTOGRAM_MODE_HAPUS) {
                for (var keyCoord in tempGeoms) {
                    delete instance.geometry[keyCoord];
                }
            } else {
                instance.geometry = joinShapeTeeth(instance.geometry, tempGeoms);
            }

            $this.trigger('change', instance.geometry);
            instance.redraw();
        }

        $.fn.odontogram.defaults = {
            width: "800px",
            height: "480px"
        }

        function modRemove(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

    });
</script>

<script>
    jQuery(document).ready(function($) {
        var odontogram = $("#odontogram").odontogram('init', {
        width: "800px",
        height: "300px"
    });

    var odontogramPos = <?php echo $pasien->odontogram ? $pasien->odontogram : '[]'; ?>;
    $("#odontogram").data('odontogram').setGeometryByPos(odontogramPos);
    $('#odontogram').on('change', function (_, geometry) {
        var tempOdontogramPos = [];
        for (var i = 0; i < Object.keys(geometry).length; i++) {
            Object.values(geometry)[i][0]['code'] = Object.values(geometry)[i][0]['name'];
            tempOdontogramPos.push(Object.values(geometry)[i][0]);
        }
        const result = tempOdontogramPos.map(({vertices,options,name,...rest}) => ({...rest}));
        odontogramPos = result;
        document.getElementById('odontogramValue').value = JSON.stringify(odontogramPos);
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
    $("#ODONTOGRAM_MODE_BRIDGE_LEFT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_BRIDGE_LEFT);
    })
    $("#ODONTOGRAM_MODE_BRIDGE_RIGHT").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_BRIDGE_RIGHT);
    })
    $("#ODONTOGRAM_MODE_BRIDGE_JOIN").click(function () {
        $("#odontogram").odontogram('setMode', ODONTOGRAM_MODE_BRIDGE_JOIN);
    })

    $("#download").click(function (_, geometry) {
            console.log(geometry)
    })
    });
</script>

<script>
    function addRekam() { 
       var element_gigi = $("#element_gigi").val();
       var tindakan = $("#tindakan").val();
       var diagnosa = $("#diagnosa").val()
       var kondisi_gigi = $("#kondisi_gigi").val();

       if(kondisi_gigi=="" || tindakan=="" || diagnosa==""){
            alert("Form Wajib Dipilih")
       }else{
            
            var markup = '<tr>'+
                    '<td>'+element_gigi+
                        '<input type="hidden" name="element_gigi[]" value="'+element_gigi+'"/>'+
                    '</td>'+
                    '<td>'+kondisi_gigi+
                        '<input type="hidden" name="pemeriksaan[]" value="'+kondisi_gigi+'"/>'+
                    '</td>'+
                    '<td>'+diagnosa+
                        '<input type="hidden" name="diagnosa[]" value="'+diagnosa+'"/>'+
                    '</td>'+
                    '<td>'+tindakan+
                        '<input type="hidden" name="tindakan[]" value="'+tindakan+'"/>'+
                    '</td>'+
                    
                    '<td style="width: 80px">'+
                        // '<button type="button" class="btn btn-danger btnDelete">Hapus</button>'+
                        '<a href="#" class="btn btn-danger shadow btn-xs sharp btnDelete"><i class="fa fa-trash"></i></a>'+
                    '</td>'+
                    '</tr>';

             $("#table-tindakan tbody").append(markup);
       }
       
     }
     $(function () {
        var table = $('#icd-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            paging:true,
            select: false,
            pageLength: 5,
            lengthChange:false ,
            ajax: "{{ route('icd.data') }}",
            columns: [
                {data: 'action', name: 'action'},
                {data: 'code', name: 'code'},
                {data: 'name_id', name: 'name_id'}
            ]
        });

        $(document).on("click", ".pilihIcd", function () {
            var diagnosa_id = $(this).data('id');
            var rekam_id = $("#rekam_id").val();
            var pasien_id = $("#pasien_id").val();
            var token = '{{csrf_token()}}';
            $("#diagnosa").val(diagnosa_id);
            $("#addDiagnosa").modal('hide');            
        });

        $(".delete").click(function() {
                var id = $(this).attr('r-id');
                var name = $(this).attr('r-name');
                var link = $(this).attr('r-link');

                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = link;
                }
            });
        });
     });
</script>
@endsection