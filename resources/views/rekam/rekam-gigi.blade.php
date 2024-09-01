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
                    <table class="table" style="width: 100%">
                    <tbody>
                        
                        <tr>
                            <td align="center">
                                <!-- <canvas id="odontogram" style="margin-top: 15px;">
                                    Browser anda tidak support canvas, silahkan update browser anda.
                                </canvas> -->
                            </td>
                        </tr>
                    </tbody>
                    </table>
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
                                                        <option value="{{$item->kode}}">{{$item->kode}} || {{$item->nama}}</option>
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
<link rel="stylesheet" href="{{asset('odontograma/css/jquery.svg.css')}}">
<link rel="stylesheet" href="{{asset('odontograma/css/odontograma.css')}}">

@endsection
@section('script')
<script src="{{asset('odontograma/js/modernizr-2.0.6.min.js')}}"></script>
{{-- <script defer src="{{asset('odontograma/js/jquery-1.7.1.min.js')}}"></script> --}}

<script defer src="{{asset('odontograma/js/plugins.js')}}"></script>

<script defer src="{{asset('odontograma/js/jquery-ui-1.8.17.custom.min.js')}}"></script>

<script defer src="{{asset('odontograma/js/jquery.tmpl.j')}}s"></script>
<script defer src="{{asset('odontograma/js/knockout-2.0.0.js')}}"></script>
<script defer src="{{asset('odontograma/js/jquery.svg.min.js')}}"></script>  
<script defer src="{{asset('odontograma/js/jquery.svggraph.min.js')}}"></script>  
{{-- <script defer src="{{asset('odontograma/js/odontograma.js')}}"></script> --}}
<script defer src="{{asset('odontograma/js/odontogram.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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