<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Rekam;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()->role_display()=="Admin"){
            return view('dashboard.admin');
        }else if(auth()->user()->role_display()=="Pendaftaran"){
            return view('dashboard.registrasi');
        }else if(auth()->user()->role_display()=="Dokter"){
            return view('dashboard.dokter');
        }else if(auth()->user()->role_display()=="Apotek"){
            return view('dashboard.obat');
        }else if(auth()->user()->role_display()=="Pasien"){

            $pasien_id = auth()->user()->pasien_id;
            $pasien = Pasien::find($pasien_id);
            $rekamLatest = Rekam::latest()
                                    ->where('status','!=',5)
                                    ->where('pasien_id',$pasien_id)
                                    ->first();
    
            $rekams = Rekam::latest()
                        ->where('pasien_id',$pasien_id)
                        ->when($request->keyword, function ($query) use ($request) {
                            $query->where('tgl_rekam', 'LIKE', "%{$request->keyword}%");
                        })
                        ->when($request->poli, function ($query) use ($request) {
                            $query->where('poli', 'LIKE', "%{$request->poli}%");
                        })
                        ->paginate(5);
    
            return view('dashboard.pasien',compact('pasien','rekams','rekamLatest'));
        }
    }
}
