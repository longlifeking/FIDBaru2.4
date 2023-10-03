@extends('layout.mainlayout')
@section('title','Hapus Pengguna')
@section('name')
@endsection
@section('content')
<div>
    <h2>Apakah anda akan Menghapus Akun ini {{ $Penggunaall->username }}</h2>
    <div class="mt-5 d-flex justify-content-start">
        <form action="/Pengguna-Destroy/{{$Penggunaall->slug}}" method="POST" class="me-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Setuju</button>
        </form>
        <a href="/Pengguna" class="btn btn-primary">Tidak</a>
    </div>
</div>
@endsection