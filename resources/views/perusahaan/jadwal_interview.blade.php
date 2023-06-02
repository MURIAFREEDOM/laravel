@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Jadwal Interview
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        @foreach ($interview as $item)
                            <div class="col-6">                        
                                <div class="card">
                                    <div class="card-header">
                                        <b>{{$item->nama_kandidat}}</b>
                                    </div>
                                    <div class="card-body">
                                        <input type="datetime-local" name="jadwal_interview[]" value="{{$item->jadwal_interview}}" required class="form-control" id="">
                                        <input type="text" hidden name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                                        <input type="text" hidden name="nama[]" value="{{$item->nama_kandidat}}" id="">
                                        <input type="text" hidden name="usia[]" value="{{$item->usia}}" id="">
                                        <input type="text" hidden name="jk[]" value="{{$item->jenis_kelamin}}" id="">
                                        <input type="text" hidden name="pengalaman_kerja[]" value="{{$item->pengalaman_kerja}}" id="">
                                    </div>
                                </div>    
                            </div>
                        @endforeach                        
                    </div>
                    <a href="/perusahaan/interview" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn text-white" style="background-color: green">Simpan</button>
                </form>                
            </div>
        </div>
    </div>
@endsection