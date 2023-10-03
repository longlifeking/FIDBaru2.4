@extends('layout.mainlayout')
@section('title', 'Add AFE')
@section('content')
<script>
  window.onload = function() {
    var currentYear = new Date().getFullYear();
    document.getElementById("targetcor").value = currentYear;
  };
</script>

<div id="app">
    <div class="main-wrapper mt-3">
      <div class="main-content">
        <div class="container">
          <form method="post" action="/afe" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-header">
                <h3>AFE BARU</h3>
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
                          <select name="fid_id" id="fid_id" class="form-control mt-2 select2" onfocus='this.size=10;' onblur='this.size=1;' onchange='this.size=1; 'this.blur();'>
                              <option selected disabled value="">-- Pilih FID --</option>
                              @foreach($fidtabels as $fid)
                                  <option value="{{ $fid->id }}">{{ $fid->judul }}</option>
                              @endforeach
                          </select>
                      </div>

                        <!-- Ruanglingkup Selection -->
                        <div class="form-group mt-3">
                            <label for="ruanglingkup_id">Ruang Lingkup:</label>
                            <select name="ruang_id" id="ruanglingkup_id" class="form-control mt-2"></select> <!-- name ketika mengambil data name untuk menampilkan data -->
                        </div>
                    
                        <!-- AFE Data -->
                        <div class="form-group mt-3">
                            <label for="no_afe ">No AFE:</label>
                            <input type="text" id="no_afe" name="no_afe" class="form-control mt-2"  placeholder="Nomer AFE" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="judul_afe ">Judul Project:</label>
                            <input type="text" id="judul_afe" name="judul_afe" class="form-control mt-2" placeholder="Nama Project AFE"  required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="nilai_afe ">Nilai AFE:</label>
                            <input type="number" id="decimalInput" step="0.01" name="nilai_afe" class="form-control mt-2" placeholder="Nilai AFE" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="nilai_closing ">Nilai Closing:</label>
                            <input type="number"  id="decimalInput" step="0.01" name="nilai_closing" class="form-control mt-2" placeholder="Harus ada angka" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label mt-3">Progress Realisasi AFE</label>
                            <select class="form-select" name="status_id" aria-label="Default select example">
                              <option selected disabled value="">-- Progress Realisasi AFE --</option>
                              <option value="1">AFE Telah Disetujui</option>
                              <option value="2">Inprogress Pekerjaan </option>
                              <option value="3">Pekerjaan Selesai</option>
                              <option value="4">PIS / PPP</option>
                              <option value="5">Sudah Closing</option>
                            </select>
                          </div>
                          <div class="form-group mt-3">
                            <label for="target ">Target Pekerjaan :</label>
                            <input type="date" id="targetpekerajaan" name="targetpekerajaan" class="form-control mt-2" required>
                          </div>
                          <div class="form-group mt-3">
                            <label for="targetcor">Target Closing AFE :</label>
                            <div class="form-group mt-3">
                              <label for="year">Tahun:</label>
                              <input type="number" id="targetcor" name="targetcor" min="1900" max="3099" step="1" />
                              <label for="quarter">Pilih Kuartal:</label>
                              <select id="quarter_id" name="quarter_id">
                                  <option value="1">Q1 (Januari - Maret)</option>
                                  <option value="2">Q2 (April - Juni)</option>
                                  <option value="3">Q3 (Juli - September)</option>
                                  <option value="4">Q4 (Oktober - Desember)</option>
                              </select>
                            </div>
                          </div>
                        <div class="form-group mt-3">
                            <label for="PS" class="form-label">File PS</label>
                            <input class="form-control" type="file" name="PS" id="formFile" class="form-control mt-2">
                        </div>
                        <div class="form-group mt-3">
                            <label for="BS" class="form-label">File BS</label>
                            <input class="form-control" type="file" name="BS" id="formFile" class="form-control mt-2">
                        </div>
                        <div class="form-group mt-3">
                          <label for="BS" class="form-label">File PIS / PPP</label>
                          <input class="form-control" type="file" name="PISPPP" id="formFile" class="form-control mt-2">
                      </div>
                      <div class="form-group mt-3">
                        <label for="BS" class="form-label">File COR</label>
                        <input class="form-control" type="file" name="COR" id="formFile" class="form-control mt-2">
                    </div>
                    </form>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
<script>
    $(document).ready(function () {
      
      // buat  pencarian fid
      $('.select2').select2();

      // pencarian ruang lingkup
        $('#fid_id').change(function () {
            var fidId = $(this).val();
            if (fidId) {
                $.ajax({
                    url: '/getRuangLingkup/' + fidId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#ruanglingkup_id').empty();
                        $('#ruanglingkup_id').append('<option selected disabled value="">-- Pilih Ruang lingkup --</option>');
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
