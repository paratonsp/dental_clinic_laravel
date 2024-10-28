@inject('query', 'App\Models\DashboardQuery')

@extends('layout.apps')
@section('content')
    <div class="form-head d-flex align-items-center mb-sm-4 mb-3">
        <div class="mr-auto">
            <h2 class="text-black font-w600">Dashboard</h2>
        </div>
        <div>
            <a href="{{Route('rekam.addfrompasien', $pasien->id)}}" class="btn btn-primary">
                Buat Janji Dokter <span class="btn-icon-right"><i class="fa fa-clock-o"></i></span>
            </a>
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
                                    <input type="hidden" id="rekam_id" value="{{$rekamLatest ? $rekamLatest->id : '' }}">

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
                                    {{-- <textarea name="analysis" class="form-control" id="editor" cols="30" rows="10"></textarea> --}}
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
                                           @if ($rekamLatest)
                                            <p>{{$rekamLatest->cara_bayar}}</p>
                                            <p>{{$pasien->no_bpjs}}</p>
                                           @else 
                                            <p>{{$pasien->cara_bayar}}</p>
                                            <p>{{$pasien->no_bpjs}}</p>
                                           @endif
                                           
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive card-table"> 
                        <div class="form-group col-lg-12" style="float: right">
                            <form method="get" action="{{ url()->current() }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="fs-20 text-black mb-0">Rekam Medis Pasien</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control gp-search"
                                        name="keyword" value="{{request('keyword')}}" placeholder="Cari tanggal periksa" value="" autocomplete="off">
                                    </div>
                                </div>
                                
                            </form>
        
                        </div>
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Periksa</th>
                                    <th>Dokter</th>
                                    <th>Anamnesa (S)</th>
                                    <th>Pemeriksaan (O)</th>
                                    <th>Diagnosa (A)</th>
                                    <th>Tindakan (P)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekams as $key=>$row)
                                    <tr>
                                        <td>{{ $rekams->firstItem() + $key }}</td>
                                    <td>{{$row->tgl_rekam}} {{$row->jam_rekam}}</td>
                                    <td>{{$row->dokter->nama}}
                                        <br><strong>{{$row->poli}}</strong>
                                    </td>
                                    <td>{{$row->keluhan}}</td>
                                    <td>
                                        @if ($row->poli=="Poli Gigi")
                                            @foreach ($row->gigi() as $item)
                                                <li>Gigi {{$item->elemen_gigi}} : {{$item->pemeriksaan}}</li>
                                            @endforeach
                                        @else 
                                            {!! $row->pemeriksaan !!}
                                          @if ($row->pemeriksaan_file !=null)
                                              <br>
                                              <a target="__BLANK"
                                               href="{{$row->getFilePemeriksaan()}}"> <u style="color:rgb(28, 85, 231);">Lihat Foto</u> </button>
                                          @endif
                                        </td>
                                        @endif
                                    <td>
                                        @if ($row->poli=="Poli Gigi")
                                            @foreach ($row->gigi() as $item)
                                                <li>{{$item->diagnosa.", ".$item->diagnosis->name_id}}</li>
                                            @endforeach
                                        @else 
                                            {{-- {{$row->diagnosa}} --}}
                                                <table>
                                                    @foreach ($row->diagnosa() as $item)
                                                    <tr>
                                                        <td> {{$item->diagnosis->code}}</td>
                                                        <td>
                                                            
                                                        @if (($row->status<=2))
                                                            <a href="{{Route('rekam.diagnosa.delete',$item->id)}}" class="btn btn-danger shadow btn-xs sharp">
                                                                <i class="fa fa-trash"></i>   </a>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">{{$item->diagnosis->name_id}}</td>
                                                    </tr>
                                                    @endforeach

                                                </table>
                                            
                                        @endif
                                    <td>
                                        @if ($row->poli=="Poli Gigi")
                                            @foreach ($row->gigi() as $item)
                                                <li>{{$item->tindak->nama}}</li>
                                            @endforeach
                                        @else 
                                             {!! $row->tindakan !!}
                                             @if ($row->tindakan_file !=null)
                                              <br>
                                              <a target="__BLANK" href="{{$row->getFileTindakan()}}"> <u style="color:rgb(28, 85, 231);">Lihat Foto</u> </button>
                                          @endif
                                    </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing {{$rekams->firstItem()}} to {{$rekams->perPage() * $rekams->currentPage()}} of {{$rekams->total()}} entries</div>
                       {{ $rekams->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection