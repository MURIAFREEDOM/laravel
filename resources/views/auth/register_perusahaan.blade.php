@extends('layouts.laman')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="/register/perusahaan">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="name" class="">{{ __('Nama Perusahaan') }}</label>
                            </div>
                            <div class="col">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="nib" class="">{{ __('No. NIB') }}</label>
                            </div>
                            <div class="col">
                                <input id="nib" type="text" class="form-control @error('nib') is-invalid @enderror" name="nib" value="{{ old('nib') }}" required autocomplete="nib" autofocus>
                                @error('nib')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="email" class="">{{ __('Email Address') }}</label>
                            </div>
                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <a href="/login/perusahaan" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
