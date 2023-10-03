@extends('layout.mainlayout')
@section('title', 'Add AFE')
@section('content')
<div class="main-wrapper">
    <div class="main-content">
        <div class="container">
            <form method="post" action="" enctype="multipart/form-data">
                @csrf
                <div class="card">
                  <div class="card-header">
                    <h3>EDIT AFE</h3>
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
                      @csrf
                            <!-- FID Selection -->
                            <div class="form-group">
                                <label for="fid_id">FID:</label>
                                <select name="fid_id" id="fid_id" class="form-control mt-2">
                                    <option value="">-- Pilih FID --</option>
                                    @foreach($fidtabels as $fid)
                                        <option value="{{ $fid->id }}">{{ $fid->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <!-- Ruanglingkup Selection -->
                            <div class="form-group mt-3">
                                <label for="ruanglingkup_id">Ruang Lingkup:</label>
                                <select name="ruang_id" id="ruanglingkup_id" class="form-control mt-2" required value= "{{ $afeall->ruang_id }}"></select> <!-- name ketika mengambil data name untuk menampilkan data -->
                            </div>
                        
                            <!-- AFE Data -->
                            <div class="form-group mt-3">
                                <label for="no_afe ">No AFE:</label>
                                <input type="text" id="no_afe" name="no_afe" class="form-control mt-2"  placeholder="Nomer AFE" required value= "{{ $afeall->no_afe }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="judul_afe ">Judul Project:</label>
                                <input type="text" id="judul_afe" name="judul_afe" class="form-control mt-2" placeholder="Nama Project AFE" required value= "{{ $afeall->judul_afe }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="nilai_afe ">Nilai AFE:</label>
                                <input type="text" id="nilai_afe" name="nilai_afe" class="form-control mt-2" placeholder="Nilai AFE" required value= "{{ $afeall->nilai_afe }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="nilai_closing ">Nilai Closing:</label>
                                <input type="text" id="nilai_closing" name="nilai_closing" class="form-control mt-2" placeholder="Harus ada angka" required value= "{{ $afeall->nilai_closing }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mt-3">Status Project</label>
                                <select class="form-select" name="status_id" aria-label="Default select example">
                                  <option selected disabled value="">-- Status Project --</option>
                                  <option value="1" {{ $afeall->status_id == 1 ? 'selected' : '' }}>Proyek Belum Mulai</option>
                                  <option value="2" {{ $afeall->status_id == 2 ? 'selected' : '' }}>Proyek Sedang Jalan </option>
                                  <option value="3" {{ $afeall->status_id == 3 ? 'selected' : '' }}>Belum Ada Minyak</option>
                                  <option value="4" {{ $afeall->status_id == 4 ? 'selected' : '' }}>Tahap PIS/PPP</option>
                                  <option value="5" {{ $afeall->status_id == 5 ? 'selected' : '' }}>Tahap COR</option>
                                  <option value="6" {{ $afeall->status_id == 6 ? 'selected' : '' }}>Selesai</option>
                                </select>
                              </div>
                              <div class="form-group mt-3">
                                <label for="target ">Target Closing AFE (COR):</label>
                                <input type="text" id="target" name="target" class="form-control mt-2" placeholder= "Target Kapan Selesai COR" required value= "{{ $afeall->target }}">
                              </div>
                            <div class="form-group mt-3">
                                <label for="PS" class="form-label">File PS</label>
                                <input class="form-control" type="file" name="PS" id="formFile" class="form-control mt-2">
                            </div>
                            <div class="form-group mt-3">
                                <label for="BS" class="form-label">File BS</label>
                                <input class="form-control" type="file" name="BS" id="formFile" class="form-control mt-2">
                            </div>
                        </form>
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#fid_id').change(function () {
                var fidId = $(this).val();
                if (fidId) {
                    $.ajax({
                        url: '/getRuangLingkup/' + fidId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#ruanglingkup_id').empty();
                            $('#ruanglingkup_id').append('<option value="">-- Pilih Ruang lingkup --</option>');
                            $.each(data, function(key, value) {
                                $('#ruanglingkup_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#ruanglingkup_id').empty();
                    $('#ruanglingkup_id').append('<option value="">-- Pilih Ruang lingkup --</option>');
                }
            });
        });
    </script>
    
@endsection