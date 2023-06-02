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
                        <a class="nav-link active" href="{{route('parent')}}">Parent</a>
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
                    <h6 class="text-center mb-5">Indonesia</h6>
                    <form action="" method="POST">
                        @csrf
                        <div class="" id="parent">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">Data Orang Tua / Wali</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Ayah</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nama_ayah}}" name="nama_ayah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Umur Ayah</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="{{$kandidat->umur_ayah}}" name="umur_ayah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Ibu</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nama_ibu}}" name="nama_ibu" class="form-control" id="">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Umur Ibu</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" value="{{$kandidat->umur_ayah}}" name="umur_ibu" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jumlah Saudara Laki-laki</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <small class="col">saudara di luar pendaftar. Contoh: jika pendaftar adalah laki-laki, maka total bersaudara laki-laki dikurangi satu. namun jika pendaftar perempuan, maka ditulis jumlah saudara laki laki.</small>
                                    </div>
                                    <input type="number" value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jumlah Saudara Perempuan</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <small class="col">saudara di luar pendaftar. Contoh: jika pendaftar adalah perempuan, maka total bersaudara perempuan dikurangi satu. namun jika pendaftar laki laki, maka ditulis jumlah saudara perempuan.</small>
                                    </div>
                                    <input type="number" value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Anak Ke</label>
                                </div>
                                <div class="col-md-2">
                                    @if ($kandidat->anak_ke == null)
                                        <input type="number" value="{{1}}" class="form-control" name="anak_ke" required>
                                    @else
                                        <input type="number" value="{{$kandidat->anak_ke}}" name="anak_ke" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">                                        
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Apakah Anda Pernah memiliki Pengalaman Kerja?</label>
                                </div>
                                <div class="col-md-2">
                                    <select name="confirm" class="form-select" id="">
                                        <option value="0">Tidak</option>
                                        <option value="1" @if ($kandidat->nama_perusahaan1 !== null)
                                            selected
                                        @endif>Ya</option>
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