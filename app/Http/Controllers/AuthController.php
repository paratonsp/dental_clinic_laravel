<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Pasien;


class AuthController extends Controller
{
    public function page_login()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }else{
           return redirect('/dashboard');
        }
    }

    public function registration()
    {
        if (!Auth::check()) {
            return view('auth.registrasi');
        }else{
           return redirect('/dashboard');
        }
    }

    public function auth(Request $request)
    {

        $credentials = $request->only('phone', 'password');

        if(Auth::attempt($credentials)){
    		return redirect('/dashboard')->with('sukses','Selamat, Anda berhasil masuk aplikasi');
    	}else{
    		return redirect('/')->with('gagal','mohon masukkan password dengan benar');
    	}
    }

    public function regist(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'phone' => 'required',
            'jk' => 'required',
            'no_rm' => 'required|unique:pasien',
            'password' => 'required',
        ]);

        try {
            $pasien = Pasien::create([
                'nama' => $request->nama,
                'no_hp' => $request->phone,
                'cara_bayar' => 'Umum/Mandiri',
                'jk' => $request->jk,
                'no_rm' => $request->no_rm,
            ]);

            $user = User::create([
                'name' => $request->nama,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'role' => 5,
                'pasien_id' => $pasien->id,
                'status' => 1
            ]);
            


            DB::commit();
            $credentials = $request->only('phone', 'password');
            if (Auth::attempt($credentials)) {
                return redirect('/dashboard')->with('sukses','Selamat, Anda berhasil registrasi');
            } else {
                return redirect('/')->with('gagal','mohon masuk sekali lagi');
            }
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return redirect('/registrasi')->with('gagal','mohon masukkan data dengan benar');
        }
        DB::rollBack();
        return redirect('/registrasi')->with('gagal','mohon masukkan data dengan benar');
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/');
    }
   
    public function password_baru($id)
    {
        $user = User::find($id);
        // dd($user);
        return view('newpassword',['user'=>$user,'id'=>$id]);
    }
    public function updatepassword(Request $request, $id)
    {
        $this->validate($request,[
            'password' => 'required|min:6',
            'password_konfirm' => 'required_with:password|same:password|min:6'
        ]);
      
        $password = bcrypt($request->password);
        User::where('id', $id)->update(['password' => $password,
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        return redirect()->route('petugas')->with('sukses','Selamat, password anda sudah diperbaharui');
    }
}
