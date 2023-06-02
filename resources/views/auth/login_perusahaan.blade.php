@extends('layouts.laman')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Login</h4>
                </div>
                <div class="card-body">
                    <form action="/login/perusahaan" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="exampleInputEmail1">Masukkan No NIB</label>
                                </div>
                                <div class="col">
                                    <input name="nib" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="exampleInputPassword1">Masukkan Email</label>
                                </div>
                                <div class="col">
                                    <input name="email" type="email" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                        </div>
                        <div class="my-4">Belum punya akun? <a href="/register/perusahaan">Register yuk!!</a></div>
                        <a href="/laman" class="btn btn-secondary float-left ml-2">Kembali</a>
                        <button type="submit" class="btn btn-primary float-right mr-2">Masuk</button>
                    </form> 
                </div>
            </div>
           
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
