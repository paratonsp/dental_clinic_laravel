<!DOCTYPE html>
<html lang="id" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dental Clinic</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo.png')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/toastr/css/toastr.min.css')}}">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form" style="background-color: lightskyblue;">
									<div class="text-center mb-3">
                                        <img class="logo-compact" src="{{asset('images/molar-logo.png')}}" alt="" style="max-width: 200px;"> 
                
									</div>
                                    <h3 class="text-center mb-4"><strong>Registrasi Pasien</strong></h3>
                                    <form action="{{Route('regist.auth')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Nama</strong></label>
                                            <input type="text" class="form-control"  placeholder="Nama" value="" required name="nama" id="nama">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Kategori</strong></label>
                                            <select name="code" class="form-control" id="code">
                                                <option value="D">Dewasa</option>
                                                <option value="A">Anak</option>
                                            </select>
                                        </div>
                                        <div class="form-group" hidden>
                                            <label class="mb-1"><strong>No RM</strong></label>
                                            <input type="text" class="form-control" name="no_rm" required value="" id="no_rm">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Jenis Kelamin</strong></label>
                                            <div class="form-check">
                                                <input type="radio" name="jk" class="form-check-input" value="Laki-Laki">
                                                <label class="form-check-label">Laki-Laki</label>     
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" name="jk" class="form-check-input"value="Perempuan">
                                                <label class="form-check-label">Perempuan</label>   
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>No.Telepon</strong></label>
                                            <input type="tel" class="form-control" placeholder="No.Telepon" value="" required name="phone">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control"  placeholder="password" value="" required name="password">
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button type="submit" class="btn text-black btn-primary form-control">Registrasi</button>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <a href="{{Route('login')}}">Sudah punya akun?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('vendor/global/global.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/deznav-init.js')}}"></script>
    <script src="{{asset('vendor/toastr/js/toastr.min.js')}}"></script>

    <script>
        @if(Session::has('sukses'))
            toastr.success("{{Session::get('sukses')}}", "Sukses",{timeOut: 5000})
        @endif
        @if(Session::has('gagal'))
            toastr.error("{{Session::get('gagal')}}", "Gagal",{timeOut: 5000})
        @endif
    </script>
</body>
</html>