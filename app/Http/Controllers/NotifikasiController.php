<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kandidat;
use App\Models\Notification;
use App\Models\Pembayaran;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    public function index()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $notif = Notification::where('id_kandidat',$kandidat->id_kandidat)->get();
        $pembayaran = Pembayaran::where('id_kandidat',$kandidat->id_kandidat)->first();
        if($pembayaran !== null){
            if ($pembayaran->stats_pembayaran == "sudah dibayar") {
                return view('kandidat/prioritas/semua_notif',compact('kandidat','pembayaran','notif'));
            } else {
                return view('kandidat/semua_notif',compact('kandidat','notif','pembayaran'));
            }
        } else {
            return view('kandidat/semua_notif',compact('kandidat','notif','pembayaran'));
        }
    }
    public function sendMessage(Request $request)
    {
        Notification::create([
            'id_kandidat'=>$request->id_kandidat,
            'nama'=>$request->nama,
            'pesan'=>$request->pesan
        ]);
        return back();
    }
}
