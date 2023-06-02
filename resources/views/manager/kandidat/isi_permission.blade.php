@extends('layouts.script')

@section('content')
    <div class="container">        
        <div class="card mb-5">
            <div class="card-header mx-auto">
                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('personal')}}">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('document')}}">Document</a>
                    </li>
                    <li class="nav-item">
                        @if($kandidat->stats_nikah == null)
                            <a class="nav-link disabled" href="{{route('family')}}">Family</a>
                        @elseif($kandidat->stats_nikah !== "Single")
                            <a class="nav-link" href="{{route('family')}}">Family</a>                          
                        @else
                            <a class="nav-link disabled" href="{{route('family')}}">Family</a>                          
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vaksin')}}">Vaksin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('parent')}}">Parent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('company')}}">Company</a>
                    </li>                          
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('permission')}}">Permission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('paspor')}}">Paspor</a>
                    </li>
                    @if ($kandidat->penempatan == "luar negeri")
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('placement')}}">Placement</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{route('placement')}}">Placement</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('job')}}">Job</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Selesai</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PERSONAL BIO DATA</h4>
                    <h6 class="text-center mb-5">Indonesia</h6>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="perizin">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">Surat Izin OrangTua / Suami / Istri / Wali</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Pemberi Izin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"  value="{{$kandidat->nama_perizin}}" name="nama_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">NIK Perizin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required  value="{{$kandidat->nik_perizin}}" name="nik_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No. Telp / HP</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"  value="{{$kandidat->no_telp_perizin}}" name="no_telp_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tempat Lahir Perizin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"  value="{{$kandidat->tmp_lahir_perizin}}" name="tmp_lahir_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tanggal Lahir Perizin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date"  value="{{$kandidat->tgl_lahir_perizin}}" name="tgl_lahir_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Lengkap Perizin</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="alamat_perizin"  value="{{$kandidat->alamat_perizin}}" class="form-control" id="" cols="" rows=""></input>
                                </div>
                            </div>
                            @livewire('location-permission')
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">RT / RW</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->rt_perizin}}" placeholder="Masukkan RT" name="rt_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->rw_perizin}}" placeholder="Masukkan RW" name="rw_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto KTP Pemberi Izin</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ktp_izin == "")
                                        <input type="file" class="form-control"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($kandidat->foto_ktp_izin !== null)
                                        <img src="/gambar/Kandidat/KTP Perizin/{{$kandidat->foto_ktp_izin}}" width="120" height="150" alt="">
                                        <input type="file" class="form-control"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" class="form-control"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Hubungan Pemberi Izin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control"  name="hubungan_perizin" placeholder="Masukkan hubungan. contoh: ayah, ibu, suami, anak, dll." value="{{$kandidat->hubungan_perizin}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection