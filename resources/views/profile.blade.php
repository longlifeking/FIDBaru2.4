@extends('layout.mainlayout')
@section('title','Edit Pengguna')
@section('name')
@endsection
@section('content')
<div id="app">
    <div class="main-wrapper">
        <div class="main-content">
            <div class="container">
                <form method="post" action="{{ route('update.akun', $Profileall->slug) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card mt-5">
                        <div class="card-header">
                            <h3>Edit Pengguna</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div class="alert-title">
                                        <h4>Whoops!</h4>
                                    </div>
                                    There are some problems with your input.
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Nama Akun</label>
                                <input type="text" class="form-control" name="username" value="{{ $Profileall->username }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Handphone</label>
                                <input type="text" class="form-control" name="phonenumber" value="{{ $Profileall->phonenumber }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="address" value="{{ $Profileall->address }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $Profileall->email }}">
                            </div>
                         </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="update-password/{{$Profileall->slug}}"><button class="btn btn-secondary" type="button">Update Password</button></a> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection