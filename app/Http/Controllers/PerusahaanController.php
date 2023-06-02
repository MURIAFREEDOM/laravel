<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perusahaan;
use App\Models\Negara;
use App\Models\Akademi;
use Carbon\Carbon;
use App\models\Provinsi;
use App\models\Kota;
use App\models\Kecamatan;
use App\models\Kelurahan;
use App\models\Interview;
use App\models\PengalamanKerja;
use Illuminate\Support\Facades\Mail;
use App\Models\Pembayaran;
use App\Models\Notification;
use App\Mail\Payment;

class PerusahaanController extends Controller
{
    // DATA PERUSAHAAN //
    public function index()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        $notifikasi = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('perusahaan/index',compact('perusahaan','notifikasi'));
    }

    public function profil()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        $notifikasi = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('perusahaan/profil_perusahaan',compact('perusahaan','notifikasi'));
    }

    public function isi_perusahaan_data()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        return view('perusahaan/isi_perusahaan_data',compact('perusahaan'));
    }

    public function simpan_perusahaan_data(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        if($request->file('foto_perusahaan') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $photo_perusahaan = time().'.'.$request->foto_perusahaan->extension();  
            $request->foto_perusahaan->move(public_path('/gambar/Perusahaan/Perusahaan'), $photo_perusahaan);
        } else {
            if($perusahaan->foto_perusahaan !== null){
                $photo_perusahaan = $perusahaan->foto_perusahaan;                
            } else {
                $photo_perusahaan = null;    
            }
        }

        if($request->file('logo_perusahaan') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $logo = time().'.'.$request->logo_perusahaan->extension();  
            $request->logo_perusahaan->move(public_path('/gambar/Perusahaan/Logo'), $logo);
        } else {
            if($perusahaan->logo_perusahaan !== null){
                $logo = $perusahaan->logo_perusahaan;                
            } else {
                $logo = null;    
            }
        }

        if ($photo_perusahaan !== null) {
            $foto_perusahaan = $photo_perusahaan;
        } else {
            $foto_perusahaan = null;
        }

        if ($logo !== null) {
            $logo_perusahaan = $logo;
        } else {
            $logo_perusahaan = null;
        }

        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();
        Perusahaan::where('referral_code',$id->referral_code)->update([
            'nama_perusahaan'=> $request->nama_perusahaan,
            'no_nib'=>$request->no_nib,
            'nama_pemimpin'=>$request->nama_pemimpin,
            'email_perusahaan'=>$request->email_perusahaan,
            'provinsi'=>$provinsi->provinsi,
            'kota'=>$kota->kota,
            'kecamatan'=>$kecamatan->kecamatan,
            'kelurahan'=>$kelurahan->kelurahan,
            'tmp_negara'=>$request->tmp_negara,
            'no_telp_perusahaan'=>$request->no_telp_perusahaan,
            'foto_perusahaan'=>$foto_perusahaan,
            'logo_perusahaan'=>$logo_perusahaan
        ]);
        return redirect()->route('perusahaan.operator');
    }

    public function isi_perusahaan_operator()
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        return view('perusahaan/isi_perusahaan_operator',compact('perusahaan'));
    }

    public function simpan_perusahaan_operator(Request $request)
    {
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        if($request->file('foto_operator') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $operator = time().'.'.$request->foto_operator->extension();  
            $request->foto_operator->move(public_path('/gambar/Perusahaan/Operator'), $operator);
        } else {
            if($perusahaan->foto_operator !== null){
                $operator = $perusahaan->foto_operator;                
            } else {
                $operator = null;    
            }
        }

        if ($operator !== null) {
            $foto_operetor = $operator;
        } else {
            $foto_operetor = null;
        }

        Perusahaan::where('referral_code',$id->referral_code)->update([
            'nama_operator'=>$request->nama_operator,
            'no_telp_operator'=>$request->no_telp_operator,
            'email_operator'=>$request->email_operator,
            'foto_operator'=>$foto_operetor,
            'company_profile'=>$request->company_profile
        ]);
        return redirect()->route('perusahaan');
    }

    // DATA KANDIDAT //
    public function kandidat()
    {
        $usia = "";
        $jk = "";
        $pendidikan = "";
        $tinggi = "";
        $berat = "";
        $lama_kerja = "";
        $kabupaten = "";
        $provinsi = "";
        $id = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$id->referral_code)->first();
        $notifikasi = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        if ($perusahaan->tmp_negara == "Dalam negeri") {
            $kandidat = Kandidat::
            join(
                'pengalaman_kerja','kandidat.id_kandidat','=','pengalaman_kerja.id_kandidat'
            )
            ->where('kandidat.penempatan',"dalam negeri")
            ->where('kandidat.jenis_kelamin','like',"%".$jk."%")
            ->where('kandidat.usia','>=',$usia)
            ->where('kandidat.pendidikan','like',"%".$pendidikan."%")
            ->where('kandidat.tinggi','>=',"%".$tinggi."%")
            ->where('kandidat.berat','>=',"%".$berat."%")
            ->where('kandidat.kabupaten','like',"%".$kabupaten."%")
            ->where('kandidat.provinsi','like',"%".$provinsi."%")
            ->where('pengalaman_kerja.lama_kerja','like',"%".$lama_kerja."%")
            ->limit(15)->get();
        } else {
            $kandidat = Kandidat::
            join(
                'pengalaman_kerja','kandidat.id_kandidat','=','pengalaman_kerja.id_kandidat'
            )
            ->where('kandidat.penempatan',"luar negeri")
            ->where('kandidat.jenis_kelamin','like',"%".$jk."%")
            ->where('kandidat.usia','>=',$usia)
            ->where('kandidat.pendidikan','like',"%".$pendidikan."%")
            ->where('kandidat.tinggi','>=',"%".$tinggi."%")
            ->where('kandidat.berat','>=',"%".$berat."%")
            ->where('kandidat.kabupaten','like',"%".$kabupaten."%")
            ->where('kandidat.provinsi','like',"%".$provinsi."%")
            ->where('pengalaman_kerja.lama_kerja','like',"%".$lama_kerja."%")
            ->limit(15)->get();
        }
        $isi = $kandidat->count();
        return view('perusahaan/kandidat/kandidat',compact('kandidat','perusahaan','isi','notifikasi'));
    }

    public function cariKandidat(Request $request)
    {
        $usia = $request->usia;
        $jk = $request->jenis_kelamin;
        $pendidikan = $request->pendidikan;
        $tinggi = $request->tinggi;
        $berat = $request->berat;
        $usia = $request->usia;
        $lama_kerja = $request->pengalaman;
        $kabupaten = Kota::where('id',$request->kota_id)->first();
        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        // if($provinsi){
        //     $provinsi = Provinsi::where('id',$request->provinsi_id)->first();            
        // } else {
        //     $provinsi = Provinsi::first();
        // }
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        $notifikasi = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        if ($perusahaan->tmp_negara == "Dalam negeri") {
            $kandidat = Kandidat::
            join(
                'pengalaman_kerja','kandidat.id_kandidat','=','pengalaman_kerja.id_kandidat'
            )
            ->where('kandidat.penempatan',"dalam negeri")
            ->where('kandidat.jenis_kelamin','like',"%".$jk."%")
            ->where('kandidat.usia','>=',"%".$usia."%")
            ->where('kandidat.pendidikan','like',"%".$pendidikan."%")
            ->where('kandidat.tinggi','>=',"%".$tinggi."%")
            ->where('kandidat.berat','>=',"%".$berat."%")
            // ->where('kandidat.kabupaten','like',"%".$kabupaten."%")
            // ->where('kandidat.provinsi','like',"%".$provinsi->provinsi."%")
            ->where('pengalaman_kerja.lama_kerja','like',"%".$lama_kerja."%")
            ->limit(15)->get();
        } else {
            $kandidat = Kandidat::
            join(
                'pengalaman_kerja','kandidat.id_kandidat','=','pengalaman_kerja.id_kandidat'
            )
            ->where('kandidat.penempatan',"luar negeri")
            ->where('kandidat.jenis_kelamin','like',"%".$jk."%")
            ->where('kandidat.usia','>=',"%".$usia."%")
            ->where('kandidat.pendidikan','like',"%".$pendidikan."%")
            ->where('kandidat.tinggi','>=',"%".$tinggi."%")
            ->where('kandidat.berat','<=',"%".$berat."%")
            ->where('kandidat.kabupaten','like',"%".$kabupaten."%")
            ->where('kandidat.provinsi','like',"%".$provinsi."%")
            ->where('pengalaman_kerja.lama_kerja',"%".$lama_kerja."%")
            ->limit(15)->get();
        }
        $isi = $kandidat->count();
        return view('perusahaan/kandidat/pilih_kandidat',compact('jk','perusahaan','kandidat','isi','notifikasi'));
    }

    public function lihatProfilKandidat($id)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $notifikasi = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $pengalamanKerja = PengalamanKerja::join(
            'kandidat','pengalaman_kerja.id_kandidat','=','kandidat.id_kandidat'
        )->first();
        if($perusahaan->tmp_negara == "Dalam negeri"){
            $semua_kandidat = Kandidat::
            where('penempatan','dalam negeri')
            ->where('id_kandidat','not like',$id)->get();
        } else {
            $semua_kandidat = Kandidat::
            where('penempatan','luar negeri')
            ->where('id_kandidat','not like',$id)->get();
        }
        
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $interview = Interview::where('id_kandidat',$kandidat->id_kandidat)->first();
        if ($kandidat->periode_awal1 !== null) {
            $periode_awal1 = Carbon::create($kandidat->periode_awal1)->isoFormat('D MMM Y');
            $periode_akhir1 = Carbon::create($kandidat->periode_akhir1)->isoFormat('D MMM Y');
        } else {
            $periode_awal1 = null;
            $periode_akhir1 = null;
        }
        if ($kandidat->periode_awal2 !== null) {
            $periode_awal2 = Carbon::create($kandidat->periode_awal2)->isoFormat('D MMM Y');
            $periode_akhir2 = Carbon::create($kandidat->periode_akhir2)->isoFormat('D MMM Y');
        } else {
            $periode_awal2 = null;
            $periode_akhir2 = null;
        }
        if ($kandidat->periode_awal3 !== null){
            $periode_awal3 = Carbon::create($kandidat->periode_awal3)->isoFormat('D MMM Y');
            $periode_akhir3 = Carbon::create($kandidat->periode_akhir3)->isoFormat('D MMM Y');    
        } else {
            $periode_awal3 = null;
            $periode_akhir3 = null;
        }
        return view('perusahaan/kandidat/profil_kandidat',compact(
            'kandidat',
            'perusahaan',
            'usia',
            'tgl_user',
            'periode_awal1',
            'periode_akhir1',
            'periode_awal2',
            'periode_akhir2',
            'periode_awal3',
            'periode_akhir3',
            'semua_kandidat',
            'interview',
            'pengalamanKerja',
            'notifikasi',
        ));
    }

    public function pilihKandidat(Request $request)
    {
        $auth = Auth::user();
        $id_kandidat = $request->id_kandidat;
        $usia = $request->usia;
        $jk = $request->jk;
        $nama = $request->nama;
        $pengalaman_kerja = $request->pengalaman_kerja;
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        
        if($id_kandidat == null){
            return redirect('/perusahaan/list/kandidat')->with('error','anda harus memilih minimal 1 kandidat');
        } else {
            for($a = 0; $a < count($id_kandidat); $a++){                
                $input['id_kandidat'] = $id_kandidat[$a];
                $input['nama_kandidat'] = $nama[$a];
                $input['status'] = "pilih";
                $input['usia'] = $usia[$a];
                $input['jenis_kelamin'] = $jk[$a];
                $input['pengalaman_kerja'] = $pengalaman_kerja[$a];
                $input['id_perusahaan'] = $perusahaan->id_perusahaan;
            Interview::create($input);
            }
            
            // $interview = Interview::create([
            //     'id_kandidat'=>$kandidat->id_kandidat,
            //     'nama_kandidat'=>$kandidat->nama,
            //     'status'=>"pilih",
            //     'usia'=>$kandidat->usia,
            //     'jenis_kelamin'=>$kandidat->jenis_kelamin,
            //     'pengalaman_kerja'=>$kandidat->pengalaman_kerja,
            //     'id_perusahaan'=>$perusahaan->id_perusahaan,
            // ]);
        }
        
        return redirect('/perusahaan/interview');
    }

    // DATA INTERVIEW //
    public function JadwalInterview()
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('status',"pilih")->get();
        $notifikasi = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $pilih = null;
        foreach($interview as $item){
            if($item->status == "pilih"){
                $pilih = 1;
            } 
        }
        if($pilih !== null){
            $pilih;
        } else {
            $pilih = null;
        }
        $terjadwal = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('status',"terjadwal")->get();
        $jml_kandidat = $interview->count();
        $biaya = 15000;
        $total = $jml_kandidat * $biaya;
        return view('perusahaan/interview',compact(
            'perusahaan',
            'interview',
            'terjadwal',
            'jml_kandidat',
            'biaya','total',
            'pilih','notifikasi',
        ));
    }

    public function tentukanJadwal()
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->where('status',"pilih")->get();
        $notifikasi = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('perusahaan/jadwal_interview',compact('perusahaan','interview','notifikasi'));
    }

    public function simpanJadwal(Request $request)
    {
        $cek = "2023-5-30";
        $id_kandidat = $request->id_kandidat;
        $nama = $request->nama;
        $usia = $request->usia;
        $jk = $request->jk;
        $jadwal = $request->jadwal_interview;
        $pengalaman_kerja = $request->pengalaman_kerja;
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();        
        $cekJadwal = $cek->format('Y-m-d');
        $time = date('Y-m-d h:m:sa');
        $timeBefore = date('Y-m-d', strtotime('-2 days', strtotime($time)));
        if($request->cekJadwal == $timeBefore){
            return redirect('perusahaan/jadwal_interview')->with('toast_warning','Harap tentukan tanggal 2 hari dari kedepan sekarang');
        } else {
            dd($cekJadwal);
        }
        
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->update([
            'jadwal_interview'=>$request->jadwal_interview,
            'status'=>"terjadwal"
        ]);
        Pembayaran::create([
            'id_perusahaan'=>$perusahaan->id_perusahaan,
            'nama_perusahaan'=>$perusahaan->nama_perusahaan,
            'nib'=>$perusahaan->no_nib,
            'nominal_pembayaran'=>15000 * $interview,
            'stats_pembayaran'=>"belum dibayar",
        ]);

        // $pembayaran = [
        //     'nama_perusahaan'=>$perusahaan->nama_perusahaan,
        //     'nib'=>$perusahaan->no_nib,
        //     'nominal_pembayaran'=>15000,
        // ];
        // Mail::to($perusahaan->email_perusahaan)->send(new Payment($pembayaran));
        return redirect('/perusahaan/interview')->with('success','Tagihan sudah muncul di email anda, silahkan selesaikan pembayaran untuk melanjutkan');
    }

    public function DeleteKandidatInterview($id)
    {
        Interview::where('id_interview',$id)->delete();
        return redirect('/perusahaan/interview');
    }

    public function Payment()
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        $interview = Interview::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        $total = $interview->count();
        $ttlBayar = $total * 15000;
        $notifikasi = Notification::where('id_perusahaan',$perusahaan->id_perusahaan)->get();
        return view('perusahaan/pembayaran',compact('perusahaan','total','ttlBayar','notifikasi'));
    }

    public function paymentCheck(Request $request)
    {
        $auth = Auth::user();
        $perusahaan = Perusahaan::where('referral_code',$auth->referral_code)->first();
        // $this->validate($request, [
        //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
        // ]);
        $pembayaran = $perusahaan->nama_perusahaan.time().'.'.$request->foto_pembayaran->extension();  
        $request->foto_pembayaran->move(public_path('/gambar/Perusahaan/Pembayaran/'.$perusahaan->nama_perusahaan), $pembayaran);
        $pembayaran = Pembayaran::where('id_perusahaan',$perusahaan->id_perusahaan)->update([
            'foto_pembayaran'=>$pembayaran
        ]);
        return redirect('/perusahaan/index')->with('success','Metode pembayaran sedang diproses mohon tunggu');
    }    
}
