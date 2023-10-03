@extends('layout.mainlayout')
@section('title','Hapus FID')
@section('name')
@endsection
@section('content')
<div>
    <h2>Apakah anda akan Menghapus Dokument FID ini {{ $Fid_all->judul }}</h2>
    <div class="mt-5 d-flex justify-content-start">
        <form action="/fid-Destroy/{{$Fid_all->slug}}" method="POST" class="me-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Setuju</button>
        </form>
        <a href="/dashboard" class="btn btn-primary">Tidak</a>
    </div>
</div>
@endsection