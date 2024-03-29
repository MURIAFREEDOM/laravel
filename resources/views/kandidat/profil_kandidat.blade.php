@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header rounded-top bg-primary">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center text-light"><b class="bold" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid white">bio data Profil</b></div>
                        <h6 class="text-center text-light" style="line-height:20px; text-transform:uppercase;">{{$negara->negara}}</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" style="line-height:20px">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4"><b class="bold">NO. REGISTER</b></div>
                            <div class="col-sm-6"><b class="bold">: {{$kandidat->jenis_kelamin.$negara->kode_negara}}_{{$kandidat->id_kandidat+800}}</b></div>                
                        </div>
                    </div>
                </div>
                <div class="row ml-5 mt-3 mb-3"><b class="bold">PERSONAL BIO DATA</b></div>
                <div class ="row" style="line-height:20px">
                    <div class="col-sm-9">
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">NAMA LENGKAP</b>
                            </div>
                            <div class="col-sm-6">
                                <b class="bold">: {{$kandidat->nama}}</b>
                            </div>        
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">JENIS KELAMIN</b>
                            </div>
                            <div class="col-sm-5">: 
                                @if ($kandidat->jenis_kelamin == "M")
                                    <b class="bold">Laki-Laki</b>
                                @else
                                    <b class="bold">Perempuan</b>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">TEMPAT / TANGGAL LAHIR</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->tmp_lahir}}, {{$tgl_user}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Usia</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$usia}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Tinggi / Berat Badan</b>
                            </div>
                            <div class="col-sm-6">
                                <b class="bold">: {{$kandidat->tinggi}} cm, {{$kandidat->berat}} kg</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Pendidikan</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->pendidikan}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Asal</b>
                            </div>
                            <div class="col-sm-6">
                                <b class="bold">: Dsn. {{$kandidat->dusun}}, RT/RW : 0{{$kandidat->rt}}/0{{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                            </div>
                        </div>                                
                    </div>
                    <div class="col-md-3">
                        @if ($kandidat->foto_set_badan !== null)
                            <img class="float-right img" src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" width="150" height="150" alt="">
                        @else
                            <img class="float-right img" src="/gambar/default_user.png" width="150" height="150" alt="">
                        @endif
                    </div>
                </div>
                <div class="row mt-5" style="line-height:15px">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <b class="bold">Pengalaman Kerja</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info text-center">
                                                <thead>
                                                <tr class="" style="font-size:10px;">
                                                    <th style="width: 1px;"><b class="bold">No</b></th>
                                                    <th style="width: 1px;"><b class="bold">Nama Perusahaan</b></th>
                                                    <th style="width: 1px;"><b class="bold">Alamat Perusahaan</b></th>
                                                    <th style="width: 1px;"><b class="bold">Jabatan</b></th>
                                                    <th><b class="bold">Periode</b></th>
                                                    <th style="width: 1px"><b class="bold">Alasan Berhenti</b></th>
                                                    <th><b class="bold">Pratinjau Video</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th><b class="bold">1st</b></th>
                                                        <td><b class="bold">{{$kandidat->nama_perusahaan1}}</b></td>
                                                        <td><b class="bold">{{$kandidat->alamat_perusahaan1}}</b></td>
                                                        <td><b class="bold">{{$kandidat->jabatan1}}</b></td>
                                                        <td><b class="bold">{{$periode_awal1}} - {{$periode_akhir1}}</b></td>
                                                        <td><b class="bold">{{$kandidat->alasan1}}</b></td>
                                                        @if ($kandidat->video_kerja1 !== null)
                                                            <td>
                                                                <button type="button" style="font-size: 10px; font-weight:bold;" class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja1">
                                                                    See Video
                                                                </button>
                                                            </td>                                                    
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th><b class="bold">2nd</b></th>
                                                        <td><b class="bold">{{$kandidat->nama_perusahaan2}}</b></td>
                                                        <td><b class="bold">{{$kandidat->alamat_perusahaan2}}</b></td>
                                                        <td><b class="bold">{{$kandidat->jabatan2}}</b></td>
                                                        <td><b class="bold">{{$periode_awal2}} - {{$periode_akhir2}}</b></td>
                                                        <td><b class="bold">{{$kandidat->alasan2}}</b></td>
                                                        @if ($kandidat->video_kerja2 !== null)
                                                            <td>
                                                                <button type="button" style="font-size: 10px; font-weight:bold; " class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja2">
                                                                    See Video
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th><b class="bold">3rd</b></th>
                                                        <td><b class="bold">{{$kandidat->nama_perusahaan3}}</b></td>
                                                        <td><b class="bold">{{$kandidat->alamat_perusahaan3}}</b></td>
                                                        <td><b class="bold">{{$kandidat->jabatan3}}</b></td>
                                                        <td><b class="bold">{{$periode_awal3}} - {{$periode_akhir3}}</b></td>
                                                        <td><b class="bold">{{$kandidat->alasan3}}</b></td>
                                                        @if ($kandidat->video_kerja3 !== null)
                                                        <td>
                                                            <button type="button" style="font-size: 10px; font-weight:bold; " class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja3">
                                                                See Video
                                                            </button>
                                                        </td>    
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-success" href="/output_izin_waris">Cetak Surat Izin & Ahli waris</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>        
    <!-- Modal -->
    <div class="modal fade" id="video_kerja1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="ratio ratio-4x3">
                        <video width="400" controls>
                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja1/{{$kandidat->video_kerja1}}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="video_kerja2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="ratio ratio-4x3">
                        <video width="400" controls>
                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja2/{{$kandidat->video_kerja2}}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="video_kerja3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="ratio ratio-4x3">
                        <video width="400" controls>
                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja3/{{$kandidat->video_kerja3}}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@endsection