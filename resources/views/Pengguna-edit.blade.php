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
                                <label class="form-label">No Handphone</label>
                                <input type="text" class="form-control" name="phonenumber" value="{{ $Penggunaall->phonenumber }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="address" value="{{ $Penggunaall->address }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $Penggunaall->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status User</label>
                                <select class="form-select" name="status_id" aria-label="Default select example">
                                  <option selected disabled value="">Status User</option>
                                  <option value="1" {{ $Penggunaall->status_id == 1 ? 'selected' : '' }}>Non-active</option>
                                  <option value="2" {{ $Penggunaall->status_id == 2 ? 'selected' : '' }}>Active</option>
                                </select>
                              </div>
                            
                              <div class="mb-3">
                                <label class="form-label">Roles Pengguna</label>
                                <select class="form-select" name="role_id" aria-label="Default select example">
                                  <option selected disabled value="">Status User</option>
                                  <option value="1" {{ $Penggunaall->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                  <option value="2" {{ $Penggunaall->role_id == 2 ? 'selected' : '' }}>Pengunjung</option>
                                  <option value="3" {{ $Penggunaall->role_id == 3 ? 'selected' : '' }}>Pekerja</option>
                                </select>
                              </div>

                         </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="/user-password/{{$Penggunaall->slug}}"><button class="btn btn-secondary" type="button">Update Password</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection