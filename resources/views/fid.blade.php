@extends('layout.mainlayout')
@section('title','Tambahkan FID')
@section('content')
<div id="app">
    <div class="main-wrapper">
      <div class="main-content">
        <div class="container">
          <form method="post" action="{{ route('fid.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-header">
                <h3>FID BARU</h3>
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
                      <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}">
                    </div>
                    <div class="mb-3">
                      <label for="fid" class="form-label">Nilai FID</label>
                      <input type="text" class="form-control @error('nilaifid') is-invalid @enderror" id="nilaifid" name="nilaifid" value="{{ old('nilaifid') }}">
                    </div>
                    <div class="mb-3">
                      <label for="fid" class="form-label">Tanggal FID</label>
                      <input type="date" class="form-control col-1" id="tgl" name="tgl" value="{{ old('tgl') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pelaksana</label>
                        <select class="form-select" name="pelaksana_id" aria-label="Default select example" value="{{ old('pelaksana_id') }}" >
                          <option selected disabled value="">Pelaksana FID</option>
                          <option value="1">PT Pertamina EP</option>
                          <option value="2">PT. Pertamina Hulu Rokan</option>
                          <option value="3">PT. Pertamina Hulu Energi (PHE)</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Fields Pertamina</label>
                        <select class="form-select" name="fields_id" aria-label="Default select example" value="{{ old('fields_id') }}" >
                          <option selected disabled value="">Fields Pertamina</option>
                          <option value="1">Jambi</option>
                          <option value="2">Pangkalan Susu</option>
                          <option value="3">Rantau</option>
                          <option value="4">Siak & Kampar</option>
                        </select>
                      </div>
                    <div id="ruangLingkupContainer">
                      <div class="mb-3 ruang-lingkup">
                        <label for="ruang-lingkup-1" class="form-label">Ruang Lingkup</label>
                        <input type="text" class="form-control ruang-lingkup-input" name="judulrl[]">
                        <div class="py-2">
                          <button type="button" class="btn btn-danger btn-remove-ruang-lingkup">Hapus</button>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="formFile" class="form-label">File Persetujuan FID</label>
                      <input class="form-control" type="file" name="filepath" id="formFile" value="{{ old('filepath') }}">
                    </div>
                    <div class="mb-3">
                      <label for="formFile" class="form-label">File Persetujuan POD</label>
                      <input class="form-control" type="file" name="filepod" id="formFile" value="{{ old('filepod') }}">
                    </div>
                    <button type="button" class="btn btn-success btn-add-ruang-lingkup">Tambah Ruang Lingkup</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
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
