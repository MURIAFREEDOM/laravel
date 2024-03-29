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
                        <a class="nav-link active" href="{{route('job')}}">Job</a>
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
                                <div class="col-md-12">
                                    <div class="card" style="">
                                        <div class="card-header">
                                            <h6 class="ms-5">Data Pekerjaan</h6> 
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="POST">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-head-bg-primary table-bordered-bd-primary">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Pekerjaan</th>
                                                                <th>Syarat Umur</th>
                                                                <th>Syarat Kelamin</th>
                                                                <th>Pilihan Pekerjaan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pekerjaan as $item)
                                                                <tr>
                                                                    @if ($item->syarat_kelamin == $kandidat->jenis_kelamin)
                                                                        <td>{{$item->nama_pekerjaan}}</td>
                                                                        <td>{{$item->syarat_umur}}</td>
                                                                        <td>Laki-laki</td>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" value="{{$item->id_pekerjaan}}" type="radio" name="id_pekerjaan" id="flexRadioDefault1">
                                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    @elseif($item->syarat_kelamin == $kandidat->jenis_kelamin)
                                                                        <td>{{$item->nama_pekerjaan}}</td>
                                                                        <td>{{$item->syarat_umur}}</td>
                                                                        <td>Perempuan</td>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" value="{{$item->id_pekerjaan}}" type="radio" name="id_pekerjaan" id="flexRadioDefault1">
                                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    @elseif($item->syarat_kelamin == "MF")
                                                                        <td>{{$item->nama_pekerjaan}}</td>
                                                                        <td>{{$item->syarat_umur}}</td>
                                                                        <td>Laki-laki & Perempuan</td>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" value="{{$item->id_pekerjaan}}" type="radio" name="id_pekerjaan" id="flexRadioDefault1">
                                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    @endif                                                                
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                                            </form>            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection