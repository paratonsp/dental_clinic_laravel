@extends('layout.apps')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" >
                    <div class="form-group col-lg-6" style="float: left">
                        <!-- <a href="{{Route('rekam.add')}}" class="btn btn-primary mr-3">+Rekam Medis Baru</a>  -->
                    </div>
                    <div class="form-group col-lg-6" style="float: right">
                        <form method="get" action="{{ url()->current() }}">
                            <div class="input-group">
                                <input type="text" class="form-control gp-search"
                                 name="keyword" value="{{request('keyword')}}" placeholder="Cari" value="" autocomplete="off">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default no-border btn-sm gp-search">
                                    <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>                    
                </ul>

                <div class="table-responsive card-table"> 
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pasien</th>
                                <th>Poli &<br>Dokter</th>
                                <th>Cara Bayar</th>
                                <th>Total Biaya (Rp)</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekams as $key=>$row)
                                <tr>
                                    <td align="center">{{ $rekams->firstItem() + $key }}</td>
                                    <td>{{$row->no_rekam}}<br/>{{$row->tgl_rekam}}</td>
                                    <td><a href="{{Route('rekam.detail',$row->pasien_id)}}">{{$row->pasien->nama}}</a></td>
                                    <td>{{$row->poli}}
                                        <br><strong>{{$row->dokter->nama}}</strong>
                                    </td>
                                    <td>{{$row->cara_bayar}}</td>
                                    <td>{{$row->total_biaya}}</td>
                                    <td>{!!$row->status_display()!!}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{Route('pembayaran.detail',['pasien_id'=>$row->pasien_id, 'id'=>$row->id])}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-user-md"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    {{ $rekams->appends(request()->except('page'))->links() }}

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
        $().ready( function () {
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
        } );
    </script>
    
@endsection
