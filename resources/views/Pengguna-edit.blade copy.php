@extends('layout.mainlayout')
@section('title','Edit Pengguna')
@section('name')
@endsection
@section('content')
<div id="app">
    <div class="main-wrapper">
        <div class="main-content">
            <div class="container">
                <form method="post" action="{{ route('Pengguna.update', $Penggunaall->slug) }}" enctype="multipart/form-data">
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
                                <input type="text" class="form-control" name="username" value="{{ $Penggunaall->username }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Handphone</label>
                                <input type="text" class="form-control" name="phonenumber" value="{{ $Penggunaall->phonenumber }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="address" value="{{ $Penggunaall->address }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control" name="status" value="{{ $Penggunaall->status }}">
                            </div>
                         </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection