@extends('layout.apps')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <h2 class="text-black font-w600">Jadwal Dokter {{$data->nama}}</h2>
                    <br>
                    <form action="" method="POST">
                    {{ csrf_field() }}
                        @foreach ($hari as $item)
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{$item->hari}}</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jam[]" id="jam" multiple>
                                        @foreach ($jam as $item)
                                            <option value="{{$item->jam}}">{{$item->jam}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <h2 class="text-black font-w600">Jadwal Libur Dokter {{$data->nama}}</h2>
                    <br>
                    <form action="" method="POST">
                    {{ csrf_field() }}
                    </form>
                    <br>
                    <div class="table-responsive card-table"> 
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($libur as $key=>$row)
                                    <tr>
                                        <td>{{$row->tanggal}}</td>
                                        <td>{{$row->jam}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('select').selectpicker();
    });
</script>
@endsection