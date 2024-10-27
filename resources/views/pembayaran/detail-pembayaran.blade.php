@extends('layout.apps')
@section('content')
<div class="form-head align-items-center d-flex mb-sm-4 mb-3">
    <div class="mr-auto">
        <h2 class="text-black font-w600">Pembayaran</h2>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-sm-12 col-sm-5 col-lg-5">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="fs-20 text-black mb-0">Detail Pasien</h4>
                        <div class="dropdown">
                            RM#  {{$pasien->no_rm}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="media mb-4 align-items-center">
                            <div class="media-body">
                                <input type="hidden" id="pasien_id" value="{{$pasien->id}}">
                                <input type="hidden" id="rekam_id" value="{{$rekam ? $rekam->id : '' }}">

                                <h3 class="fs-18 font-w600 mb-1"><a href="javascript:void(0)"
                                        class="text-black">{{$pasien->nama}}</a></h3>
                                <h4 class="fs-14 font-w600 mb-1">{{$pasien->tmp_lahir.", ".$pasien->tgl_lahir}}</h4>
                                @php
                                    $b_day = \Carbon\Carbon::parse($pasien->tgl_lahir); // Tanggal Lahir
                                    $now = \Carbon\Carbon::now();
                                @endphp
                                <h4 class="fs-14 font-w600 mb-1">{{"Usia : ".$b_day->diffInYears($now) }}</h4>
                                
                                <h4 class="fs-14 font-w600 mb-1">{{$pasien->jk.", ".$pasien->status_menikah}}</h4>
                                <span class="fs-14">{{$pasien->alamat_lengkap}}</span>
                                <span class="fs-14">{{$pasien->keluhan.", ".$pasien->kecamatan.", ".$pasien->kabupaten.", ".$pasien->kewarganegaraan}}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-sm-7 col-lg-7">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="fs-20 text-black mb-0">Info Pasien</h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            
                            <div class="col-xl-12 col-xxl-6 col-sm-6">
                                <div class="d-flex mb-3 align-items-center">
                                    <span class="fs-12 col-6 p-0 text-black">
                                        <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="19" height="19" fill="#5F74BF"/>
                                        </svg>
                                        No HP
                                    </span>
                                    <div class="col-8 p-0">
                                        <p>{{$pasien->no_hp}}</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex mb-3 align-items-center">
                                    <span class="fs-12 col-6 p-0 text-black">
                                        <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="19" height="19" fill="#5FBF91"/>
                                        </svg>
                                        Pembayaran
                                    </span>
                                    <div class="col-8 p-0">
                                        <p>{{$rekam->cara_bayar}}</p>
                                        <p>{{$pasien->no_bpjs}}</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-3 align-items-center">
                                    <span class="fs-12 col-6 p-0 text-black">
                                        <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="19" height="19" fill="#5F74BF"/>
                                        </svg>
                                        Alergi
                                    </span>
                                    <div class="col-8 p-0">
                                        <p>{{$pasien->alergi}}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="fs-12 col-6 p-0 text-black">
                                        <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="19" height="19" fill="#5FBF91"/>
                                        </svg>
                                        File General
                                    </span>
                                    <div class="col-8 p-0">
                                        @if ($pasien->general_uncent != null)
                                        <a style="width: 120px"
                                        class="btn-rounded btn-info btn-xs " href="{{$pasien->getGeneralUncent()}}" 
                                        target="__BLANK" view>Lihat Data</a>

                                        @else 
                                        Belum Tersedia
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{Route('pembayaran.update',$rekam->id)}}" method="POST">
                        {{ csrf_field() }}
                        <h3 class="text-black font-w600">Tindakan</h3>
                        <br>
                        @foreach ($rekam_gigi as $item)
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">- {{$item->nama}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$item->harga}}" disabled>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><strong>Total Biaya Tindakan:</strong></label>
                            <div class="col-sm-9">
                                <input type="text" name="biaya_tindakan" id="biaya_tindakan" class="form-control" value="{{$biaya_tindakan}}" readonly>
                            </div>
                        </div>
                        <br><hr><br>
                        <h3 class="text-black font-w600">Pemeriksaan</h3>
                        <br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Biaya Pemeriksaan:</label>
                            <div class="col-sm-9">
                                <input type="text" name="biaya_pemeriksaan" id="biaya_pemeriksaan" class="form-control" value="{{$rekam->biaya_pemeriksaan}}">
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Total Biaya:</label>
                            <div class="col-sm-9">
                                <input type="text" name="total_biaya" id="total_biaya" class="form-control" value="{{$rekam->total_biaya}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Cara Bayar*</label>
                            <div class="col-sm-3">
                                <select name="cara_bayar" id="cara_bayar" required class="form-control">
                                    <option value=""></option>
                                    <option value="Umum/Mandiri" {{$rekam->cara_bayar=="Umum/Mandiri" ? 'selected' : ''}}>Umum/Mandiri</option>
                                    <option value="Jaminan Kesehatan" {{$rekam->cara_bayar=="Jaminan Kesehatan" ? 'selected' : ''}}>Jaminan Kesehatan</option>
                                </select>
                            </div>
                            <label class="col-sm-3 col-form-label">Metode Pembayaran*</label>
                            <div class="col-sm-3">
                                <select name="metode_pembayaran" id="metode_pembayaran" required class="form-control">
                                <option value=""></option>
                                @foreach ($metode_pembayaran as $item)
                                    <option value="{{$item->id}}" {{$rekam->metode_pembayaran==$item->id ? 'selected' : ''}}>{{$item->nama}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
        $().ready( function () {
            $("#biaya_pemeriksaan").on('change keydown paste input', function(){
                updateTotalBiaya();
            });

            function updateTotalBiaya() {
                var biaya_tindakan = parseInt(document.getElementById("biaya_tindakan").value);
                var biaya_pemeriksaan = parseInt(document.getElementById("biaya_pemeriksaan").value);
                var total_biaya = biaya_tindakan + biaya_pemeriksaan;
                document.getElementById("total_biaya").value = total_biaya;
            }

        } );
    </script>
@endsection