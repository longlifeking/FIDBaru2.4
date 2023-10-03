@extends('layout.mainlayout')
@section('title','Edit Pengguna')
@section('name')
@endsection
@section('content')
<div id="app">
    <div class="main-wrapper">
      <div class="main-content">
        <div class="container">
          <form method="post" action="{{ route('fid.update', $Fid_all->slug) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
              <div class="card-header">
                <h3>EDIT FID</h3>
              </div>
              <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div>
                @endif
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <div class="alert-title"><h4>Whoops!</h4></div>
                        Ada beberapa masalah dengan input Anda.
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
                      <label for="judul" class="form-label">Judul</label>
                      <input type="text" class="form-control" id="judul" name="judul" value= "{{ $Fid_all->judul }}">
                    </div>
                    <div class="mb-3">
                      <label for="fid" class="form-label">Nilai FID</label>
                      <input type="text" class="form-control" id="nilaifid" name="nilaifid" value= "{{ $Fid_all->nilaifid }}">
                    </div>
                    <div class="mb-3">
                      <label for="fid" class="form-label">Tanggal FID</label>
                      <input type="date" class="form-control col-1" id="tgl" name="tgl" value= "{{ $Fid_all->tgl }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pelaksana</label>
                        <select class="form-select" name="pelaksana_id" aria-label="Default select example">
                            <option value="">Pelaksana FID</option>
                            <option value="1" {{ $Fid_all->pelaksana_id == 1 ? 'selected' : '' }}>PT Pertamina EP</option>
                            <option value="2" {{ $Fid_all->pelaksana_id == 2 ? 'selected' : '' }}>PT. Pertamina Hulu Rokan</option>
                            <option value="3" {{ $Fid_all->pelaksana_id == 3 ? 'selected' : '' }}>PT. Pertamina Hulu Energi (PHE)</option>
                        </select>
                    </div>
                    <div id="ruangLingkupContainer">
                      <div class="mb-3 ruang-lingkup">
                        @foreach ($Fid_all->ruangLingkup as $index => $rl)
                        <div class="mb-3 ruang-lingkup">
                            <label for="ruang-lingkup-{{ $index+1 }}" class="form-label">Ruang Lingkup</label>
                            <input type="text" class="form-control ruang-lingkup-input" name="judulrl[]" id="ruang-lingkup-{{ $index+1 }}" value="{{ $rl->judulrl }}">
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="formFile" class="form-label">File Persetujuan FID</label>
                      <input class="form-control" type="file" name="filepath" id="formFile" id="formFile">
                  </div>                  
                    <button type="button" class="btn btn-success btn-add-ruang-lingkup">Tambah Ruang Lingkup</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                  </form>
                  <script>
                    // Menangani penambahan ruang lingkup
                    document.querySelector('.btn-add-ruang-lingkup').addEventListener('click', function () {
                      var container = document.getElementById('ruangLingkupContainer');
                      var ruangLingkupDiv = document.createElement('div');
                      ruangLingkupDiv.classList.add('mb-3', 'ruang-lingkup');
                      ruangLingkupDiv.innerHTML = `
                        <label for="ruang-lingkup-${container.childElementCount + 1}" class="form-label">Ruang Lingkup</label>
                        <input type="text" class="form-control ruang-lingkup-input" name="judulrl[]"> 
                        <div class = "py-2">
                              <button type="button" class="btn btn-danger btn-remove-ruang-lingkup">Hapus</button>
                        </div> 
                      `;
                      container.appendChild(ruangLingkupDiv);
                    });
                  
                    // Menangani penghapusan ruang lingkup
                    document.addEventListener('click', function (event) {
                      if (event.target.classList.contains('btn-remove-ruang-lingkup')) {
                        event.target.closest('.ruang-lingkup').remove();
                      }
                    });
                  </script>
@endsection