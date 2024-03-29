<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Kandidat;
use App\Models\Pembayaran;
use App\Models\Akademi;
use App\Models\Negara;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\PengalamanKerja;
use App\Models\Pekerjaan;
use App\Models\Notification;
use App\Models\Perusahaan;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function login()
    {
        return view('manager/manager_access');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'no_telp' => 'required'
        ]);

        $manager = User::where(['email'=>$request->email, 'no_telp'=>$request->no_telp, 'type'=>3])->first();
        if($manager){
            Auth::login($manager);
            return redirect()->route('manager');
        } else {
            return redirect()->back()->with('error', 'Email atau no telp salah');
        }
    }

    public function index()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->where('type','like',3)->first();
        return view('manager/manager_home',compact('manager'));
    }

    public function suratIzin()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        return view('/manager/kandidat/surat_izin',compact('manager'));
    }

    public function buatSuratIzin()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $negara = Negara::all();
        return view('manager/kandidat/buat_surat_izin',compact('manager','negara'));
    }

    public function simpanSuratIzin(Request $request)
    {
        // dd($request);
        $provinsi = Provinsi::where('id',$request->provinsi_id)->first('provinsi');
        $kota = Kota::where('id',$request->kota_id)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();
        
        $provinsiPerizin = Provinsi::where('id',$request->provinsi_perizin)->first();
        $kotaPerizin = Kota::where('id',$request->kota_perizin)->first();
        $kecamatanPerizin = Kecamatan::where('id',$request->kecamatan_perizin)->first();
        $kelurahanPerizin = Kelurahan::where('id',$request->kelurahan_perizin)->first();
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp
        ]);

        $id = $user->id;
        $userId = \Hashids::encode($id.$request->no_telp);

        User::where('id',$id)->update([
            'referral_code' => $userId
        ]);

        Kandidat::create([
            'id' => $id,
            'nama' => $request->nama,
            'referral_code' => $userId,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'nama_panggilan'=>$request->nama_panggilan,
            'jenis_kelamin'=>$request->jk,
            'tmp_lahir'=>$request->tmp_lahir,
            'tgl_lahir'=>$request->tgl_lahir,
            'agama'=>$request->agama,
            'negara_id'=>$request->negara_id,
            'nik'=>$request->nik,
            'provinsi'=>$provinsi->provinsi,
            'kabupaten'=>$kota->kota,
            'kecamatan'=>$kecamatan->kecamatan,
            'kelurahan'=>$kelurahan->kelurahan,
            'dusun'=>$request->dusun,
            'rt'=>$request->rt,
            'rw'=>$request->rw,
            'nama_perizin'=>$request->nama_perizin,
            'nik_perizin'=>$request->nik_perizin,
            'no_telp_perizin'=>$request->no_telp_perizin,
            'tmp_lahir_perizin'=>$request->tmp_lahir_perizin,
            'tgl_lahir_perizin'=>$request->tgl_lahir_perizin,
            'provinsi_perizin'=>$provinsiPerizin->provinsi,
            'kabupaten_perizin'=>$kotaPerizin->kota,
            'kecamatan_perizin'=>$kecamatanPerizin->kecamatan,
            'kelurahan_perizin'=>$kelurahanPerizin->kelurahan,
            'dusun_perizin'=>$request->dusun,
            'rt_perizin'=>$request->rt_perizin,
            'rw_perizin'=>$request->rw_perizin,
            'hubungan_perizin'=>$request->hubungan_perizin,
            'negara_perizin'=>"Indonesia"
        ]);
        return redirect('/manager/surat_izin')->with('success', 'Data berhasil ditambahkan');
    }

    public function lihatProfil($id)
    {
        $manager = Auth::user();
        $negara = Negara::join(
            'kandidat','ref_negara.negara_id','=','kandidat.negara_id'
        )->first();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $tgl_user = Carbon::create($kandidat->tgl_lahir)->isoFormat('D MMM Y');
        $usia = Carbon::parse($kandidat->tgl_lahir)->age;
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
        $pengalamanKerja = PengalamanKerja::where('id_kandidat',$id)->first();
        return view('manager/kandidat/lihat_profil',compact(
            'kandidat',
            'negara',
            'tgl_user',
            'usia',
            'periode_awal1',
            'periode_akhir1',
            'periode_awal2',
            'periode_akhir2',
            'periode_awal3',
            'periode_akhir3',
            'manager',
            'pengalamanKerja',
        ));
    }

    public function dalam_negeri()
    {
        $manager = Auth::user();
        $kandidat = Kandidat::where('penempatan',"dalam negeri")->get();
        return view('manager/penempatan/dalam_negeri',compact('kandidat','manager'));
    }
    public function luar_negeri()
    {
        $manager = Auth::user();
        $kandidat = Kandidat::where('penempatan',"luar negeri")->get();
        return view('manager/penempatan/luar_negeri',compact('kandidat','manager'));
    }


    public function isi_personal($id)
    {
        $timeNow = Carbon::now();
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $user = User::where('referral_code',$kandidat->referral_code)->first();
        return view('manager/kandidat/isi_personal',compact('timeNow','user','kandidat'));
    }

    public function simpan_personal(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_panggilan' => 'required|max:20',
            'email' => 'required',
        ]);
        $usia = Carbon::parse($request->tgl_lahir)->age;
        Kandidat::where('id_kandidat',$id)->update([
            'nama' => $request->nama,
            'nama_panggilan' => $request->nama_panggilan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_telp' => $request->no_telp,
            'agama' => $request->agama,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'email' => $request->email,
            'penempatan' => $request->penempatan,
            'usia'=> $usia,
        ]);
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        // dd($kandidat);
        if($kandidat->penempatan == "dalam negeri")
            {
                Kandidat::where('id_kandidat',$id)->update([
                    'negara_id' => 2
                ]);
            } else {
                Kandidat::where('id_kandidat',$id)->update([
                    'negara_id' => null,
                ]);
            }

        $userId = Kandidat::where('id_kandidat',$id)->first();
        User::where('referral_code', $userId->referral_code)->update([
            'name' => $request->nama,
            'no_telp' => $request->no_telp,
            'email' => $request->email
        ]);

        return redirect('/lihat_profil/'.$id);
    }

    public function isi_document($id)
    {
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        $kota = Kota::all();
        $provinsi = Provinsi::all();
        $negara = Negara::all();
        return view('manager/kandidat/isi_document',compact('kandidat','kelurahan','kecamatan','kota','provinsi','negara'));
    }

    public function simpan_document(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat', $id)->first();    
        // cek foto ktp
        if($request->file('foto_ktp') !== null){
            $ktp = $kandidat->nama.time().'.'.$request->foto_ktp->extension();  
            $request->foto_ktp->move(public_path('/gambar/Kandidat/KTP'), $ktp);
        } else {
            if($kandidat->foto_ktp !== null){
                $ktp = $kandidat->foto_ktp;
            } else {
                $ktp = null;
            }
        }
        // cek foto kk
        if ($request->file('foto_kk') !== null) {    
            $kk = $kandidat->nama.time().'.'.$request->foto_kk->extension();  
            $request->foto_kk->move(public_path('/gambar/Kandidat/KK'), $kk);
        } else {
            if ($kandidat->foto_kk !== null) {
                $kk = $kandidat->foto_kk;
            } else {
                $kk = null;
            }
        }
        // cek foto set badan
        if($request->file('foto_set_badan') !== null){
            $set_badan = $kandidat->nama.time().'.'.$request->foto_set_badan->extension();  
            $request->foto_set_badan->move(public_path('/gambar/Kandidat/Set_badan'), $set_badan);
        } else {
            if ($kandidat->foto_set_badan !== null) {
                $set_badan = $kandidat->foto_set_badan;   
            } else {
                $set_badan = null;    
            }
        }
        // cek foto 4x6
        if($request->file('foto_4x6') !== null){
            $foto_4x6 = $kandidat->nama.time().'.'.$request->foto_4x6->extension();  
            $request->foto_4x6->move(public_path('/gambar/Kandidat/4x6'), $foto_4x6);
        } else {
            if ($kandidat->foto_4x6 !== null) {
                $foto_4x6 = $kandidat->foto_4x6;
            } else {
                $foto_4x6 = null;
            }
        }
        // cek foto ket lahir
        if($request->file('foto_ket_lahir') !== null){
            $ket_lahir = $kandidat->nama.time().'.'.$request->foto_ket_lahir->extension();  
            $request->foto_ket_lahir->move(public_path('/gambar/Kandidat/Ket_lahir'), $ket_lahir);
        } else {
            if ($kandidat->foto_ket_lahir !== null) {
                $ket_lahir = $kandidat->foto_ket_lahir;    
            } else {
                $ket_lahir = null;
            }
        }
        // cek foto ijazah
        if($request->file('foto_ijazah') !== null){
            $ijazah = $kandidat->nama.time().'.'.$request->foto_ijazah->extension();  
            $request->foto_ijazah->move(public_path('/gambar/Kandidat/Ijazah'), $ijazah);            
        } else {
            if ($kandidat->foto_ijazah !== null) {
                $ijazah = $kandidat->foto_ijazah;
            } else {
                $ijazah = null;                   
            }
        }

        if ($ktp !== null) {
            $foto_ktp = $ktp;
        } else {
            $foto_ktp = null;
        }
        
        if ($kk !== null) {
            $foto_kk = $kk;
        } else {
            $foto_kk = null;
        }
        
        if ($set_badan !== null) {
            $foto_set_badan = $set_badan;
        } else {
            $foto_set_badan = null;
        }
        
        if ($foto_4x6 !== null) {
            $photo_4x6 = $foto_4x6;
        } else {
            $photo_4x6 = null;
        }
        
        if ($ket_lahir !== null) {
            $foto_ket_lahir = $ket_lahir;
        } else {
            $foto_ket_lahir = null;
        }
        
        if ($ijazah !== null) {
            $foto_ijazah = $ijazah;
        } else {
            $foto_ijazah = null;
        }
        

        $provinsi = Provinsi::where('id',$request->provinsi_id)->first();
        $kota = Kota::where('id',$request->kota_id)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_id)->first();
        $kelurahan = kelurahan::where('id',$request->kelurahan_id)->first();

        Kandidat::where('id_kandidat',$id)->update([
            'nik' => $request->nik,
            'pendidikan' => $request->pendidikan,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'dusun' => $request->dusun,
            'kelurahan' => $kelurahan->kelurahan,
            'kecamatan' => $kecamatan->kecamatan,
            'kabupaten' => $kota->kota,
            'provinsi' => $provinsi->provinsi,
            'stats_negara' => "Indonesia",
            'foto_ktp' => 
            $foto_ktp,
            'foto_kk' => 
            $foto_kk,
            'foto_set_badan' => 
            $foto_set_badan,
            'foto_4x6' => 
            $photo_4x6,
            'foto_ket_lahir' =>
            $foto_ket_lahir,
            'foto_ijazah' => 
            $foto_ijazah,
            'stats_nikah' => $request->stats_nikah
        ]);
        if ($request->stats_nikah !== "Single") {
            return redirect('/lihat_profil/'.$id);
        } else {
            return redirect('/lihat_profil/'.$id);

        }        
    }

    public function isi_family($id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        if ($kandidat->stats_nikah == null) {
            return redirect('/lihat_profil/'.$id);
        } elseif($kandidat->stats_nikah !== "Single") {
            return view('manager/kandidat/isi_family',compact('kandidat'));    
        } else {
            return redirect('/lihat_profil/'.$id);
        }
    }

    public function simpan_family(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        // cek buku nikah
        if($request->file('foto_buku_nikah') !== null){
            $buku_nikah = $kandidat->nama.time().'.'.$request->foto_buku_nikah->extension();  
            $request->foto_buku_nikah->move(public_path('/gambar/Kandidat/Buku Nikah'), $buku_nikah);
        } else {
            if($kandidat->foto_buku_nikah !== null){
                $buku_nikah = $kandidat->foto_buku_nikah;
            } else {
                $buku_nikah = null;
            }
        }
        if($request->file('foto_cerai')){
            $cerai = $kandidat->nama.time().'.'.$request->foto_cerai->extension();  
            $request->foto_cerai->move(public_path('/gambar/Kandidat/Cerai'), $cerai);
        } else {
            if($kandidat->foto_cerai !== null){
                $cerai = $kandidat->foto_buku_nikah;
            } else {
                $cerai = null;
            }
        }
        if($request->file('foto_kematian_pasangan')){
            $kematian_pasangan = $kandidat->nama.time().'.'.$request->foto_kematian_pasangan->extension();  
            $request->foto_kematian_pasangan->move(public_path('/gambar/Kandidat/Kematian Pasangan'), $kematian_pasangan);
        } else {
            if($kandidat->foto_kematian_pasangan !== null){
                $kematian_pasangan = $kandidat->foto_buku_nikah;
            } else {
                $kematian_pasangan = null;
            }
        }
        
        if($buku_nikah !== null){
            $foto_buku_nikah = $buku_nikah;
        } else {
            $foto_buku_nikah = null;
        }
        
        if($cerai !== null){
            $foto_cerai = $cerai;
        } else {
            $foto_cerai = null;
        }

        if($kematian_pasangan !== null){
            $foto_kematian_pasangan = $kematian_pasangan;
        } else {
            $foto_kematian_pasangan = null;
        }

        Kandidat::where('id_kandidat', $id)->update([
            'foto_buku_nikah' => $foto_buku_nikah,
            'nama_pasangan' => $request->nama_pasangan,
            'umur_pasangan' => $request->umur_pasangan,
            'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
            'jml_anak_lk' => $request->jml_anak_lk,
            'umur_anak_lk' => $request->umur_anak_lk,
            'jml_anak_pr' => $request->jml_anak_pr,
            'umur_anak_pr' => $request->umur_anak_pr,
            'foto_cerai' => $foto_cerai,
            'foto_kematian_pasangan' => $foto_kematian_pasangan,
        ]);
        return redirect('/lihat_profil/'.$id);
    }

    public function isi_vaksin($id)
    {
        $kandidat = Kandidat::where('id_kandidat', $id)->first(); 
        return view('manager/kandidat/isi_vaksinasi',['kandidat'=>$kandidat]);
    }

    public function simpan_vaksin(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        // cek vaksin1
        if($request->file('sertifikat_vaksin1') !== null){
            $sertifikat_vaksin1 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin1->extension();  
            $request->sertifikat_vaksin1->move(public_path('/gambar/Kandidat/Vaksin Pertama'), $sertifikat_vaksin1);
        } else {
            if($kandidat->sertifikat_vaksin1 !== null){
                $sertifikat_vaksin1 = $kandidat->sertifikat_vaksin1;
            } else {
                $sertifikat_vaksin1 = null;
            }
        }
        // cek vaksin2
        if($request->file('sertifikat_vaksin2') !== null){
            $sertifikat_vaksin2 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin2->extension();  
            $request->sertifikat_vaksin2->move(public_path('/gambar/Kandidat/Vaksin Kedua'), $sertifikat_vaksin2);    
        } else {
            if($kandidat->sertifikat_vaksin2 !== null){
                $sertifikat_vaksin2 = $kandidat->sertifikat_vaksin2;
            } else {
                $sertifikat_vaksin2 = null;
            }
        }
        // cek vaksin3
        if($request->file('sertifikat_vaksin3') !== null){
            $sertifikat_vaksin3 = $kandidat->nama.time().'.'.$request->sertifikat_vaksin3->extension();  
            $request->sertifikat_vaksin3->move(public_path('/gambar/Kandidat/Vaksin Ketiga'), $sertifikat_vaksin3);
        } else {
            if($kandidat->sertifikat_vaksin3 !== null){
                $sertifikat_vaksin3 = $kandidat->sertifikat_vaksin3;
            } else {
                $sertifikat_vaksin3 = null;
            }
        }
        
        if($sertifikat_vaksin1 !== null){
            $foto_sertifikat_vaksin1 = $sertifikat_vaksin1;
        } else {
            $foto_sertifikat_vaksin1 = null;
        }

        if($sertifikat_vaksin2 !== null){
            $foto_sertifikat_vaksin2 = $sertifikat_vaksin2;
        } else {
            $foto_sertifikat_vaksin2 = null;
        }

        if($sertifikat_vaksin3 !== null){
            $foto_sertifikat_vaksin3 = $sertifikat_vaksin3;
        } else {
            $foto_sertifikat_vaksin3 = null;
        }

        Kandidat::where('id_kandidat', $id)->update([
            'vaksin1' => $request->vaksin1,
            'no_batch_v1' => $request->no_batch_v1,
            'tgl_vaksin1' => $request->tgl_vaksin1,
            'sertifikat_vaksin1' => 
            // null ,
            $foto_sertifikat_vaksin1,
            'vaksin2' => $request->vaksin2,
            'no_batch_v2' => $request->no_batch_v2,
            'tgl_vaksin2' => $request->tgl_vaksin2,
            'sertifikat_vaksin2' => 
            // null,
            $foto_sertifikat_vaksin2,
            'vaksin3' => $request->vaksin3,
            'no_batch_v3' => $request->no_batch_v3,
            'tgl_vaksin3' => $request->tgl_vaksin3,
            'sertifikat_vaksin3' => 
            // null,
            $foto_sertifikat_vaksin3
        ]);
        return redirect('/lihat_profil/'.$id);
    }

    public function isi_parent($id)
    {
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        return view('manager/kandidat/isi_parent',['kandidat'=>$kandidat]);
    }

    public function simpan_parent(Request $request,$id)
    {
        Kandidat::where('id_kandidat', $id)->update([
            'nama_ayah' => $request->nama_ayah,
            'umur_ayah' => $request->umur_ayah,
            'nama_ibu' => $request->nama_ibu,
            'umur_ibu' => $request->umur_ibu,
            'jml_sdr_lk' => $request->jml_sdr_lk,
            'jml_sdr_pr' => $request->jml_sdr_pr,
            'anak_ke' => $request->anak_ke
        ]);

        $ket = 1;
        if ($ket == $request->confirm) {
            return redirect('/lihat_profil/'.$id);
        } else {
            return redirect('/lihat_profil/'.$id);
        }        
    }

    public function isi_company($id)
    {
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        return view('manager/kandidat/isi_company', ['kandidat'=>$kandidat]);
    }

    public function simpan_company(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        //video1
        if($request->file('video_kerja1') !== null){
            $validated = $request->validate([
                'video_kerja1' => 'mimes:mp4,mov,ogg,qt | max:2000',
            ]);
            $video_kerja1 = $request->file('video_kerja1');
            $video_kerja1->move('Video/Kandidat/Pengalaman Kerja1',$video_kerja1->getClientOriginalName());
            $simpan_kerja1 = $video_kerja1->getClientOriginalName();
            dd($simpan_kerja1);
        } else {
            if($kandidat->video_kerja1 !== null){
                $simpan_kerja1 = $kandidat->video_kerja1;
            } else {
                $simpan_kerja1 = null;
            }
        }
        //video2
        if ($request->file('video_kerja2') !== null){
            $validated = $request->validate([
                'video_kerja2' => 'mimes:mp4,mov,ogg,qt | max:2000',
            ]);
            $video_kerja2 = $request->file('video_kerja2');
            $video_kerja2->move('Video/Kandidat/Pengalaman Kerja2',$video_kerja2->getClientOriginalName());
            $simpan_kerja2 = $video_kerja2->getClientOriginalName();
        } else {
            if($kandidat->video_kerja2 !== null){
                $simpan_kerja2 = $kandidat->video_kerja2;
            } else {
                $simpan_kerja2 = null;                 
            }
        }
        //video3
        if ($request->file('video_kerja3') !== null){
            $validated = $request->validate([
                'video_kerja3' => 'mimes:mp4,mov,ogg,qt | max:20000',
            ]);
            $video_kerja3 = $request->file('video_kerja3');
            $video_kerja3->move('Video/Kandidat/Pengalaman Kerja3',$video_kerja3->getClientOriginalName());
            $simpan_kerja3 = $video_kerja3->getClientOriginalName();
        } else {
            if($kandidat->video_kerja3 !== null){
                $simpan_kerja3 = $kandidat->video_kerja3;                   
            } else {
                $simpan_kerja3 = null;
            }
        }
        //cek_video1
        if($simpan_kerja1 !== null){
            $video1 = $simpan_kerja1;
        } else {
            $video1 = null;
        }
        //cek_video2
        if($simpan_kerja2 !== null){
            $video2 = $simpan_kerja2;
        } else {
            $video2 = null;
        }
        // cek_video3
        if($simpan_kerja3 !== null){
            $video3 = $simpan_kerja3;
        } else {
            $video3 = null;
        }

        Kandidat::where('id_kandidat', $id)->update([
            'nama_perusahaan1' => $request->nama_perusahaan1,
            'alamat_perusahaan1' => $request->alamat_perusahaan1,
            'jabatan1' => $request->jabatan1,
            'periode_awal1' => $request->periode_awal1,
            'periode_akhir1' => $request->periode_akhir1,
            'alasan1' => $request->alasan1,
            'video_kerja1' => $video1,
            'nama_perusahaan2' => $request->nama_perusahaan2,
            'alamat_perusahaan2' => $request->alamat_perusahaan2,
            'jabatan2' => $request->jabatan2,
            'periode_awal2' => $request->periode_awal2,
            'periode_akhir2' => $request->periode_akhir2,
            'alasan2' => $request->alasan2,
            'video_kerja2' => $video2,
            'nama_perusahaan3' => $request->nama_perusahaan3,
            'alamat_perusahaan3' => $request->alamat_perusahaan3,
            'jabatan3' => $request->jabatan3,
            'periode_awal3' => $request->periode_awal3,
            'periode_akhir3' => $request->periode_akhir3,
            'alasan3' => $request->alasan3,
            'video_kerja3' => $video3,
        ]);

        $pengalaman_kerja = PengalamanKerja::create([
            'id_kandidat'=>$kandidat->id_kandidat,
            'pengalaman_kerja'=>$request->jabatan1.','.$request->jabatan2.','.$request->jabatan3,
        ]);
        return redirect('/lihat_profil/'.$id);
    }

    public function isi_permission($id)
    {
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        return view('manager/kandidat/isi_permission',compact('kandidat','provinsi','kecamatan','kelurahan','kota'));
    }

    public function simpan_permission(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        // cek foto ktp izin
        if($request->file('foto_ktp_izin') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $ktp_izin = $kandidat->nama.time().'.'.$request->foto_ktp_izin->extension();
            $request->foto_ktp_izin->move(public_path('/gambar/Kandidat/KTP Perizin'), $ktp_izin);
        } else {
            if($kandidat->foto_ktp_izin !== null){
                $ktp_izin = $kandidat->foto_ktp_izin;                
            } else {
                $ktp_izin = null;    
            }
        }

        if ($ktp_izin !== null) {
            $foto_ktp_izin = $ktp_izin;
        } else {
            $foto_ktp_izin = null;
        }
        
        $provinsi = Provinsi::where('id',$request->provinsi_perizin)->first();
        $kota = Kota::where('id',$request->kota_perizin)->first();
        $kecamatan = Kecamatan::where('id',$request->kecamatan_perizin)->first();
        $kelurahan = Kelurahan::where('id',$request->kelurahan_perizin)->first();

        Kandidat::where('id_kandidat', $id)->update([
            'nama_perizin' => $request->nama_perizin,
            'nik_perizin' => $request->nik_perizin,
            'no_telp_perizin' => $request->no_telp_perizin,
            'tmp_lahir_perizin' => $request->tmp_lahir_perizin,
            'tgl_lahir_perizin' => $request->tgl_lahir_perizin,
            'alamat_perizin' => $request->alamat_perizin,
            'rt_perizin' => $request->rt_perizin,
            'rw_perizin' => $request->rw_perizin,
            'dusun_perizin' => $request->dusun_perizin,
            'kelurahan_perizin' => $kelurahan->kelurahan,
            'kecamatan_perizin' => $kecamatan->kecamatan,
            'kabupaten_perizin' => $kota->kota,
            'provinsi_perizin' => $provinsi->provinsi,
            'negara_perizin' => "Indonesia",
            'foto_ktp_izin' => 
            $foto_ktp_izin,
            'hubungan_perizin' => $request->hubungan_perizin
        ]);

            return redirect('/lihat_profil/'.$id);
    }

    public function isi_paspor($id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        return view('manager/kandidat/isi_paspor',compact('kandidat'));
    }

    public function simpan_paspor(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        if($request->file('foto_paspor') !== null){
            // $this->validate($request, [
            //     'foto_ktp_izin' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            // ]);
            $paspor = $kandidat->nama.time().'.'.$request->foto_paspor->extension();  
            $request->foto_paspor->move(public_path('/gambar/Kandidat/Paspor'), $paspor);
        } else {
            if($kandidat->foto_paspor !== null){
                $paspor = $kandidat->foto_paspor;                
            } else {
                $paspor = null;    
            }
        }

        if ($paspor !== null) {
            $foto_paspor = $paspor;
        } else {
            $foto_paspor = null;
        }

        Kandidat::where('id_kandidat',$id)->update([
            'no_paspor'=>$request->no_paspor,
            'tgl_terbit_paspor'=>$request->tgl_terbit_paspor,
            'tgl_akhir_paspor'=>$request->tgl_akhir_paspor,
            'tmp_paspor'=>$request->tmp_paspor,
            'foto_paspor'=>$foto_paspor,
        ]);
        if ($kandidat->penempatan == "luar negeri") {
            return redirect('/lihat_profil/'.$id);
        } else {
            return redirect('/lihat_profil/'.$id);
        }
    }

    public function isi_placement($id)
    {
        $kandidat = Kandidat::where('id_kandidat', $id)->first();
        $negara = Negara::where('negara_id','not like',2)->get();
        if ($kandidat->penempatan == "luar negeri"){
            return view('manager/kandidat/isi_placement',compact('negara','kandidat'));
        }
        return redirect('/lihat_profil/'.$id);
    }

    public function simpan_placement(Request $request,$id)
    {
        Kandidat::where('id_kandidat', $id)->update([
            'negara_id' => $request->negara_id,
            'jabatan_kandidat' => $request->jabatan_kandidat,
            'kontrak' => $request->kontrak,
        ]);
        return redirect('/lihat_profil/'.$id);
    }

    public function isi_job($id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        $umur = Carbon::parse($kandidat->tgl_lahir)->age;
            $pekerjaan = Pekerjaan::join(
                'ref_negara', 'pekerjaan.negara_id','=','ref_negara.negara_id'
            )
            ->where('pekerjaan.negara_id',$kandidat->negara_id)
            ->where('pekerjaan.syarat_umur','>=',$umur)
            ->get();
        return view('manager/kandidat/isi_job',compact('pekerjaan','kandidat'));
    }

    public function simpan_job(Request $request,$id)
    {
        $kandidat = Kandidat::where('id_kandidat',$id)->first();
        Kandidat::where('id_kandidat',$id)->update([
            'id_pekerjaan'=> $request->id_pekerjaan
        ]);
        return redirect('/lihat_profil/'.$id);
    }

    public function pembayaranKandidat()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::join(
            'kandidat','pembayaran.id_kandidat','=','kandidat.id_kandidat'
        )
        ->where('stats_pembayaran',"belum dibayar")->get();
        return view('manager/kandidat/pembayaran',compact('manager','pembayaran'));
    }

    public function cekPembayaranKandidat($id){
        $manager = Auth::user();
        $pembayaran = Pembayaran::where('id_pembayaran',$id)->first();
        return view('manager/kandidat/cek_pembayaran',compact('manager','pembayaran'));
    }

    public function cekConfirmKandidat($id)
    {
        Pembayaran::where('id_pembayaran',$id)->update([
            'stats_pembayaran'=>"sudah dibayar"
        ]);
        return redirect('manager/pembayaran/kandidat');
    }

    public function pembayaranPerusahaan()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::join(
            'perusahaan', 'pembayaran.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('pembayaran.stats_pembayaran',"belum dibayar")->get();
        return view('manager/perusahaan/pembayaran',compact('manager','pembayaran'));
    }

    public function cekPembayaranPerusahaan($id)
    {
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        $pembayaran = Pembayaran::join(
            'perusahaan', 'pembayaran.id_perusahaan','=','perusahaan.id_perusahaan'
        )
        ->where('pembayaran.id_pembayaran',$id)->first();
        return view('manager/perusahaan/cek_pembayaran',compact('manager','pembayaran'));
    }

    public function cekConfirmPerusahaan(Request $request, $id)
    {
        $auth = Auth::user();
        $manager = User::where('type',3)->first();
        $pembayaran = Pembayaran::where('id_pembayaran',$id)->update([
            'stats_pembayaran'=>$request->stats_pembayaran
        ]);
        $perusahaan = Perusahaan::join(
            'pembayaran','perusahaan.id_perusahaan','=','pembayaran.id_perusahaan'
        )
        ->where('pembayaran.id_pembayaran',$id)->first();
        $notify = Notification::create([
            'pengirim_notifikasi'=>"Admin",
            'isi'=>"Selamat pembayaran anda telah selesai",
            'id_perusahaan'=>$perusahaan->id_perusahaan,
        ]);
        return redirect('/manager/pembayaran/perusahaan');
    }

    public function riwayatKandidat()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::where('stats_pembayaran',"sudah dibayar")->where('type','like',0)->get();
        return view('manager/riwayat_pembayaran_kandidat',compact('manager','pembayaran'));
    }

    public function riwayatPerusahaan()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->first();
        $pembayaran = Pembayaran::where('stats_pembayaran',"sudah dibayar")->where('type','like',2)->get();
        return view('manager/riwayat_pembayaran_perusahaan',compact('manager','pembayaran'));        
    }

    public function akademi()
    {
        $id = Auth::user();
        $manager = User::where('referral_code',$id->referral_code)->where('type','like',3)->first();
        $akademi = Akademi::all();
        return view('manager/akademi/list_akademi',compact('manager','akademi'));
    }
}