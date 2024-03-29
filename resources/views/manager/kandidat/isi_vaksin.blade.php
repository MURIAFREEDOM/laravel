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
                        <a class="nav-link active" href="{{route('vaksin')}}">Vaksin</a>
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
                    <h6 class="text-center mb-5">Indonesia</h6>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="vaksinasi">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">VAKSINASI COVID-19</h6> 
                                </div>
                            </div>
                            <div class="" id="vaksin1">
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Nama Vaksin Pertama</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="vaksin1" class="form-select" id="">
                                            <option value="">-- Pilih Nama Vaksin --</option>
                                            <option value="ASTRA ZENECA" @if ($kandidat->vaksin1 == "ASTRA ZENECA") selected @endif>ASTRA ZENECA</option>
                                            <option value="PFIZER" @if ($kandidat->vaksin1 == "PFIZER") selected @endif>PFIZER</option>
                                            <option value="SINOVAC" @if ($kandidat->vaksin1 == "SINOVAC") selected @endif>SINOVAC</option>
                                            <option value="SINOPHARM" @if ($kandidat->vaksin1 == "SINOPHARM") selected @endif>SINOPHARM</option>
                                            <option value="CORONAVAC" @if ($kandidat->vaksin1 == "CORONAVAC") selected @endif>CORONAVAC</option>
                                            <option value="MODERNA" @if ($kandidat->vaksin1 == "MODERNA") selected @endif>MODERNA</option>
                                            <option value="JOHNSONS & JOHNSONS" @if ($kandidat->vaksin1 == "JOHNSONS & JOHNSONS") selected @endif>JOHNSONS & JOHNSONS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Batch ID Pertama</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="">Berikut contoh nomor Batch ID yang terdapat di sertifikat vaksin anda : </label><img class="mb-1" src="/gambar/batch_id.jpg" alt="">
                                        <input type="text" value="{{$kandidat->no_batch_v1}}" name="no_batch_v1" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Tanggal Vaksin Pertama</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" value="{{$kandidat->tgl_vaksin1}}" name="tgl_vaksin1" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Sertifikat Vaksin</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->sertifikat_vaksin1 == "")
                                            <input type="file" value="{{$kandidat->sertifikat_vaksin1}}" name="sertifikat_vaksin1" class="form-control" accept="image/*">                                            
                                        @elseif ($kandidat->sertifikat_vaksin1 !== null)
                                            <img src="/gambar/Kandidat/Vaksin Pertama/{{$kandidat->sertifikat_vaksin1}}" width="120" height="150" alt="">
                                            <input type="file" value="{{$kandidat->sertifikat_vaksin1}}" name="sertifikat_vaksin1" class="form-control" accept="image/*">                                            
                                        @else
                                            <input type="file" value="{{$kandidat->sertifikat_vaksin1}}" name="sertifikat_vaksin1" class="form-control" accept="image/*">                                            
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr class="">    
                            <div class="" id="vaksin2">
                                <div class="row my-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Nama Vaksin Kedua</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="vaksin2" class="form-select" id="">
                                            <option value="">-- Pilih Nama Vaksin --</option>
                                            <option value="ASTRA ZENECA" @if ($kandidat->vaksin2 == "ASTRA ZENECA") selected @endif>ASTRA ZENECA</option>
                                            <option value="PFIZER" @if ($kandidat->vaksin2 == "PFIZER") selected @endif>PFIZER</option>
                                            <option value="SINOVAC" @if ($kandidat->vaksin2 == "SINOVAC") selected @endif>SINOVAC</option>
                                            <option value="SINOPHARM" @if ($kandidat->vaksin2 == "SINOPHARM") selected @endif>SINOPHARM</option>
                                            <option value="CORONAVAC" @if ($kandidat->vaksin2 == "CORONAVAC") selected @endif>CORONAVAC</option>
                                            <option value="MODERNA" @if ($kandidat->vaksin2 == "MODERNA") selected @endif>MODERNA</option>
                                            <option value="JOHNSONS & JOHNSONS" @if ($kandidat->vaksin2 == "JOHNSONS & JOHNSONS") selected @endif>JOHNSONS & JOHNSONS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Batch ID Kedua</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="">Berikut contoh nomor Batch ID yang terdapat di sertifikat vaksin anda : </label><img class="mb-1" src="/gambar/batch_id.jpg" alt="">
                                        <input type="text" value="{{$kandidat->no_batch_v2}}" name="no_batch_v2" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Tanggal Vaksin Kedua</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" value="{{$kandidat->tgl_vaksin2}}" name="tgl_vaksin2" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Sertifikat Vaksin</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->sertifikat_vaksin2 == "")
                                            <input type="file" name="sertifikat_vaksin2" class="form-control" accept="image/*">                                            
                                        @elseif ($kandidat->sertifikat_vaksin2 !== null)
                                            <img src="/gambar/Kandidat/Vaksin Kedua/{{$kandidat->sertifikat_vaksin2}}" width="120" height="150" alt="">
                                            <input type="file" name="sertifikat_vaksin2" class="form-control" accept="image/*">                                            
                                        @else
                                            <input type="file" name="sertifikat_vaksin2" class="form-control" accept="image/*">                                            
                                        @endif
                                    </div>
                                </div>
                                <hr>    
                                {{-- <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Apakah anda sudah vaksin ketiga?</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="" class="form-select" id="">
                                            <option value=""><button type="button" id="btn_B">Belum</button></option>
                                            <option value=""><button type="button" id="btn_S" @if ($kandidat->vaksin3 == $kandidat->vaksin3)selected @endif>Sudah</button></option>
                                        </select>
                                    </div>
                                </div>     --}}
                            </div>
                            <div class="" id="vaksin3">
                                <div class="row my-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Nama Vaksin Ketiga</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="vaksin3" class="form-select" id="">
                                            <option value="">-- Pilih Nama Vaksin --</option>
                                            <option value="ASTRA ZENECA" @if ($kandidat->vaksin2 == "ASTRA ZENECA") selected @endif>ASTRA ZENECA</option>
                                            <option value="PFIZER" @if ($kandidat->vaksin2 == "PFIZER") selected @endif>PFIZER</option>
                                            <option value="SINOVAC" @if ($kandidat->vaksin2 == "SINOVAC") selected @endif>SINOVAC</option>
                                            <option value="SINOPHARM" @if ($kandidat->vaksin2 == "SINOPHARM") selected @endif>SINOPHARM</option>
                                            <option value="CORONAVAC" @if ($kandidat->vaksin2 == "CORONAVAC") selected @endif>CORONAVAC</option>
                                            <option value="MODERNA" @if ($kandidat->vaksin2 == "MODERNA") selected @endif>MODERNA</option>
                                            <option value="JOHNSONS & JOHNSONS" @if ($kandidat->vaksin2 == "JOHNSONS & JOHNSONS") selected @endif>JOHNSONS & JOHNSONS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Batch ID Ketiga</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="">Berikut contoh nomor Batch ID yang terdapat di sertifikat vaksin anda : </label><img class="mb-1" src="/gambar/batch_id.jpg" alt="">
                                        <input type="text" value="{{$kandidat->no_batch_v3}}" name="no_batch_v3" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Tanggal Vaksin Ketiga</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" value="{{$kandidat->tgl_vaksin3}}" name="tgl_vaksin3" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Sertifikat Vaksin</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->sertifikat_vaksin3 == "")
                                            <input type="file" name="sertifikat_vaksin3" class="form-control" accept="image/*">                                            
                                        @elseif ($kandidat->sertifikat_vaksin3 !== null)
                                            <img src="/gambar/Kandidat/Vaksin Ketiga/{{$kandidat->sertifikat_vaksin3}}" width="120" height="150" alt="">
                                            <input type="file" name="sertifikat_vaksin3" class="form-control" accept="image/*">                                            
                                        @else
                                            <input type="file" name="sertifikat_vaksin3" class="form-control" accept="image/*">                                            
                                        @endif
                                    </div>
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