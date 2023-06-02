@extends('layouts.manager')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-secondary" href="/manager/buat_surat_izin">Buat Surat izin dan ahli waris</a>                
            </div>
        </div>
    </div>
@endsection