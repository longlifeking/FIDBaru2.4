@extends('layout.mainlayout')
@section('title','Hapus AFE')
@section('name')
@endsection
@section('content')
<div>
    <h2>Apakah anda akan Menghapus Dokument AFE ini {{ $afe_all->judul_afe}}</h2>
    <div class="mt-5 d-flex justify-content-start">
        <form action="/afe-destroy/{{$afe_all->slug}}" method="POST" class="me-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Setuju</button>
        </form>
        <a href="/Pengguna" class="btn btn-primary">Tidak</a>
    </div>
</div>
@endsection