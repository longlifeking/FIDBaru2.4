@extends('layout.mainlayout')
@section('title','Pengguna')
@section('name')
@endsection
@section('content')
<h3>Welcome, To Pengguna Page</h3>
<div class="mt-5 d-flex justify-content-end">
    <a href="#" class="btn btn-primary">Pulihkan Akun</a>
</div>

<div class="row">
    <div class="col-md-12 mb-3 mt-5">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> Data Pengguna
        </div>
        <div class="card-body">
          <div class="table-responsive">
<table id="example" class="table table-striped data-table mt-5" style="width: 100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Password</th>
            <th>Alamat</th>
            <th>Nomer HP</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if ($Penggunaall->isNotEmpty()) <!-- dimana jika tidak kosong -->
            @foreach ($Penggunaall as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->username}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->phonenumber}}</td>
                <td>{{$item->statususer->name_status}}</td>
                <td>
                    <a href="Pengguna-edit/{{$item->slug}}" class="icon"><i class="bi bi-pencil-square"></i></a>
                    <a href="Pengguna-Hapus/{{$item->slug}}" class="icon"><i class="bi bi-trash3-fill"></i></a>
                </td>
            </tr>
            @endforeach
        @else <!-- Jika kosong maka akan menampilkan  -->
            <tr>
                <td class="center" colspan="6"> Tidak Ada Data Pengguna</td>
            </tr>
        @endif
    </tbody>
</table>
          </div>
        </div>
{{-- <div class="mt-5 d-flex justify-content-end"> <!-- Menampilkan Halaman berapa --> --}}
    {{-- <div class="row">{{$Penggunaall->links()}}</div> --}}
</div>


<script src="./js/jquery-3.5.1.js"></script>
<script src="./js/jquery.dataTables.min.js"></script>
<script src="./js/dataTables.bootstrap5.min.js"></script>
<script src="./js/script.js"></script>
@endsection