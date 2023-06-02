@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b style="text-transform: uppercase">Cek Pembayaran</b>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Nama Perusahaan</b>
                        </div>
                        <div class="col-8">
                            <input type="text" name="nama_perusahaan" class="form-control" value="{{$pembayaran->nama_perusahaan}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">No. NIB</b>
                        </div>
                        <div class="col-8">
                            <input type="text" name="no_nib" class="form-control" value="{{$pembayaran->nib}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Nominal Pembayaran</b>
                        </div>
                        <div class="col-8">
                            <input type="text" name="nominal_pembayaran" class="form-control" value="{{$pembayaran->nominal_pembayaran}}" id="">
                        </div>
                    </div>
                    @if ($pembayaran->foto_pembayaran !== null)
                        <div class="row mb-3">
                            <div class="col-4">
                                <b class="bold">Foto Pembayaran</b>
                            </div>
                            <div class="col-8">
                                @if ($pembayaran->foto_pembayaran !== null)
                                    <img src="/gambar/perusahaan/pembayaran/{{$pembayaran->nama_perusahaan}}/{{$pembayaran->foto_pembayaran}}" width="300" height="300" alt="">                                
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <b class="bold">Status Pembayaran</b>
                            </div>
                            <div class="col-4">
                                @if ($pembayaran->foto_pembayaran !== null)
                                    <select name="stats_pembayaran" class="form-control" id="">
                                        <option value="belum dibayar">Belum dibayar</option>
                                        <option value="sudah dibayar">Sudah dibayar</option>
                                    </select>                                
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">Konfirmasi</button>
                    @else
                        <p>Maaf Perusahaan Ini belum Mengirimkan foto bukti pembayaran</p>
                    @endif                    
                    <a class="btn btn-danger" href="/manager/pembayaran/perusahaan">Batal</a>
                </form>
            </div>
        </div>
    </div>    
@endsection