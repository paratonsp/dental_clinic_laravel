<?php

namespace App\Http\Controllers;

use App\Models\Rekam;
use App\Models\Pasien;
use App\Models\Tindakan;
use App\Models\RekamGigi;
use App\Models\MetodePembayaran;

use Illuminate\Http\Request;


class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role_display();
        $pembayaran = Rekam::latest()
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
                    ->whereIn('status',[4,5])
                    ->paginate(10);
        return view('pembayaran.index',compact('pembayaran'));
    }

    public function detail(Request $request, $id)
    {
        $rekam = Rekam::find($id);
        $pasien = Pasien::find($rekam->pasien_id);
        $rekam_gigi = RekamGigi::leftJoin('tindakan', function ($join) {
                        $join->on('tindakan.kode', '=', 'rekam_gigi.tindakan');
                    })
                    ->where('rekam_gigi.rekam_id', $id)
                    ->get();
        $biaya_tindakan = 0;

        foreach ($rekam_gigi as $key => $value) {
            $biaya_tindakan = $biaya_tindakan + $value->harga;
        }

        $metode_pembayaran = MetodePembayaran::all();

        return view('pembayaran.detail-pembayaran',compact('pasien','rekam','rekam_gigi','biaya_tindakan','metode_pembayaran'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'biaya_tindakan' => 'required',
            'biaya_pemeriksaan' => 'required',
            'total_biaya' => 'required',
            'metode_pembayaran' => 'required'
        ]);

        $request->request->add(['status' => 5]);
        $rekam = Rekam::find($id);
        $rekam->update($request->all());
        return redirect()->route('pembayaran.detail',$rekam->id)->with('sukses','Berhasil diperbaharui');


    }
}
