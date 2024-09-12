<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekam;
use App\Models\Pasien;
use App\Models\Poli;


class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role_display();
        $rekams = Rekam::latest()
                    ->select('rekam.*')
                    ->leftJoin('pasien', function($join) {
                        $join->on('rekam.pasien_id', '=', 'pasien.id');
                    })
                    ->when($request->keyword, function ($query) use ($request) {
                        $query->where('rekam.tgl_rekam', 'LIKE', "%{$request->keyword}%")
                                ->orwhere('rekam.cara_bayar', 'LIKE', "%{$request->keyword}%")
                                ->orwhere('pasien.nama', 'LIKE', "%{$request->keyword}%")
                                ->orwhere('pasien.no_bpjs', 'LIKE', "%{$request->keyword}%")
                                ->orwhere('pasien.no_rm', 'LIKE', "%{$request->keyword}%");
                    })
                    ->when($role, function ($query) use ($role,$user){
                        if($role=="Dokter"){
                            $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                            $query->where('dokter_id', '=', $dokterId);
                        }
                    })
                    ->when($request->tab, function ($query) use ($request) {
                        if(auth()->user()->role_display()=="Dokter" && $request->tab==5){
                            $query->whereIn('status', [3,4,5]);
                        }else{
                            if($request->tab==5){
                                $query->whereIn('status',[4,5]);
                            }else{
                                $query->where('status', '=', "$request->tab");
                            }
                        }
                    })
                    ->paginate(10);
        return view('pembayaran.index',compact('rekams'));
    }

    public function detail(Request $request,$pasien_id,$id)
    {
        $pasien = Pasien::find($pasien_id);

        $rekams = Rekam::latest()
                    ->where('id',$id)
                    ->first();
                    
        $poli = Poli::where('status',1)->get();

        return view('pembayaran.detail',compact('pasien','rekams','poli'));
    }
}
