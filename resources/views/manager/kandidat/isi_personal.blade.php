@extends('layouts.script')

@section('content')
    @include('sweetalert::alert')
    <div class="container">        
        <div class="card mb-4">
            <div class="card-header mx-auto">
                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('personal')}}">Personal</a>
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
                        <a class="nav-link" href="{{route('permission')}}">Permission</a>
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
                    <h6 class="text-center mb-4">Indonesia</h6>
                    <form action="" method="POST">
                        @csrf
                        <div class="" id="personal_biodata">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">PERSONAL BIO DATA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$user->name}}" name="nama" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Panggilan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nama_panggilan}}" placeholder="Maksimal 20 kata" name="nama_panggilan" id="inputPassword6" class="form-control @error('nama_panggilan') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                    @error('nama_panggilan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jenis Kelamin</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="jenis_kelamin" required class="form-select" id="">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="M" @if ($kandidat->jenis_kelamin == "M") selected @endif>Laki-laki</option>
                                        <option value="F" @if ($kandidat->jenis_kelamin == "F") selected @endif>perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tempat & Tanggal Lahir</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Masukkan Tempat Lahir" value="{{$kandidat->tmp_lahir}}" name="tmp_lahir" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                                <div class="col-md-4">
                                    @if ($kandidat->tgl_lahir !== null)
                                        <input type="date" required value="{{$kandidat->tgl_lahir}}" name="tgl_lahir" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    @else
                                        <input type="date" required value="{{date('Y-m-d')}}" name="tgl_lahir" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No Telepon</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$user->no_telp}}" name="no_telp" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Agama</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="agama" class="form-select" id="">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="islam" @if ($kandidat->agama == "islam") selected @endif>Islam</option>
                                        <option value="kristen" @if ($kandidat->agama == "kristen") selected @endif>Kristen</option>
                                        <option value="katolik" @if ($kandidat->agama == "katolik") selected @endif>Katolik</option>
                                        <option value="hindu" @if ($kandidat->agama == "hindu") selected @endif>Hindu</option>
                                        <option value="buddha" @if ($kandidat->agama == "buddha") selected @endif>Buddha</option>
                                        <option value="konghucu" @if ($kandidat->agama == "konghucu") selected @endif>Konghucu</option>
                                        <option value="aliran_kepercayaan" @if ($kandidat->agama == "aliran_kepercayaan") selected @endif>Aliran Kepercayaan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Berat & Tinggi Badan</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" value="{{$kandidat->berat}}" placeholder="Masukkan berat badan" name="berat" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" value="{{$kandidat->tinggi}}" placeholder="Masukkan tinggi badan" name="tinggi" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" value="{{$user->email}}" name="email" value="" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Status Tempat Kerja</label>
                                </div>
                                <div class="col-md-2">
                                    <select name="penempatan" class="form-select" id="">
                                        <option value="dalam negeri" @if ($kandidat->penempatan == "dalam negeri")
                                            selected
                                        @endif>Dalam Negeri</option>
                                        <option value="luar negeri" @if ($kandidat->penempatan == "luar negeri")
                                            selected
                                        @endif>Luar Negeri</option>
                                    </select>
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