@extends('layouts.manager')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Kandidat</h4>
                            <a href="/tambah_kandidat" class="btn btn-primary btn-round ml-auto">
                                Tambah Kandidat
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        {{-- <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header no-bd">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                            New</span> 
                                            <span class="fw-light">
                                                Row
                                            </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small">Create a new row using this form, make sure you fill them all</p>
                                        <form>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Name</label>
                                                        <input id="addName" type="text" class="form-control" placeholder="fill name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pr-0">
                                                    <div class="form-group form-group-default">
                                                        <label>Position</label>
                                                        <input id="addPosition" type="text" class="form-control" placeholder="fill position">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default">
                                                        <label>Office</label>
                                                        <input id="addOffice" type="text" class="form-control" placeholder="fill office">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kandidat as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->username}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>
                                                <a class="btn" href="/kirim_email"><i class="icon-envelope"></i></a>
                                                <div class="input-group">
                                                    <input type="text" class="form-control ml-2" value="{{$user_referral}}" id="myInput">
                                                    <button class="btn btn-primary" onclick="myFunction()">Salin code</button>
                                                </div>
                                                <div class="input-group">
                                                    <form action="/kirim_email" method="post">
                                                        @csrf
                                                        <label class="mr-2" for="">Kepada : </label>
                                                        <input type="email" name="kirim_email" value="{{$item->email}}" class="form-control" id="email">
                                                        <button class="btn btn-primary mr-3" type="submit">Bagikan</button>
                                                    </form>
                                                </div>
                                                {{-- <a href=""></a> --}}
                                                {{-- <div class="form-button-action">
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div> --}}
                                            </td>
                                        </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            // Get the text field
            var copyText = document.getElementById("myInput");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            swal("kode telah disalin");
        }
    </script>

@endsection