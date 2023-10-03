@extends('layout.mainlayout')
@section('title', 'Add AFE')
@section('content')
<div class="main-wrapper">
    <div class="main-content">
        <div class="container">
            <form method="post" action="{{ route('afe.update', $afeall->slug) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
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
                                        <option value="{{ $fid->id }}" {{ $fid->id == $afeall->ruanglingkup->fidtabel->id ? 'selected' : '' }}>
                                            {{ $fid->judul }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
    
                            <!-- Ruanglingkup Selection -->
                            <div class="form-group mt-3">
                                <label for="ruanglingkup_id">Ruang Lingkup:</label>
                                <select name="ruang_id" id="ruanglingkup_id" class="form-control mt-2"></select>
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
                                <input type="number" id="decimalInput" step="0.01" name="nilai_afe" class="form-control mt-2" placeholder="Nilai AFE" required value= "{{ $afeall->nilai_afe }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="nilai_closing ">Nilai Closing:</label>
                                <input type="number" id="decimalInput" step="0.01" name="nilai_closing" class="form-control mt-2" placeholder="Harus ada angka" required value= "{{ $afeall->nilai_closing }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mt-3">Progress Realisasi AFE</label>
                                <select class="form-select" name="status_id" aria-label="Default select example">
                                  <option selected disabled value="">-- Progress Realisasi AFE --</option>
                                  <option value="1"{{ $afeall->status_id == 1 ? 'selected' : '' }}>AFE Telah Disetujui</option>
                                  <option value="2"{{ $afeall->status_id == 2 ? 'selected' : '' }}>Inprogress Pekerjaan </option>
                                  <option value="3"{{ $afeall->status_id == 3 ? 'selected' : '' }}>Pekerjaan Selesai</option>
                                  <option value="4"{{ $afeall->status_id == 4 ? 'selected' : '' }}>PIS / PPP</option>
                                  <option value="5"{{ $afeall->status_id == 5 ? 'selected' : '' }}>Sudah Closing</option>
                                </select>
                              </div>
                              <div class="form-group mt-3">
                                <label for="target ">Target Pekerjaan :</label>
                                <input type="date" id="targetpekerajaan" name="targetpekerajaan" class="form-control mt-2" required value= "{{ $afeall->targetpekerajaan }}"/>
                              </div>
                              <div class="form-group mt-3">
                                <label for="targetcor">Target Closing AFE :</label>
                                <div class="form-group mt-3">
                                  <label for="year">Tahun:</label>
                                  <input type="number" id="targetcor" name="targetcor" min="1900" max="3099" step="1" required value= "{{$afeall->targetcor}}" />
                                  <label for="quarter">Pilih Kuartal:</label>
                                  <select id="quarter_id" name="quarter_id">
                                      <option value="1" {{ $afeall->quarter_id == 1 ? 'selected' : '' }}>Q1 (Januari - Maret)</option>
                                      <option value="2" {{ $afeall->quarter_id == 2 ? 'selected' : '' }}>Q2 (April - Juni)</option>
                                      <option value="3" {{ $afeall->quarter_id == 3 ? 'selected' : '' }}>Q3 (Juli - September)</option>
                                      <option value="4" {{ $afeall->quarter_id == 4 ? 'selected' : '' }}>Q4 (Oktober - Desember)</option>
                                  </select>
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
    // Fungsi untuk memuat data Ruanglingkup
    function loadRuangLingkup(fidId) {
        if (fidId) {
            $.ajax({
                url: '/getRuangLingkup/' + fidId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#ruanglingkup_id').empty();
                    $('#ruanglingkup_id').append('<option value="">-- Pilih Ruang lingkup --</option>');
                    $.each(data, function(key, value) {
                        var option = '<option value="' + key + '"';
                        if (value === '{{ $afeall->ruanglingkup->judulrl }}') {
                            option += ' selected';
                        }
                        option += '>' + value + '</option>';
                        $('#ruanglingkup_id').append(option);
                    });
                }
            });
        } else {
            $('#ruanglingkup_id').empty();
            $('#ruanglingkup_id').append('<option value="">-- Pilih Ruang lingkup --</option>');
        }
    }

    // Panggil fungsi saat halaman dimuat
    loadRuangLingkup($('#fid_id').val());

    // Panggil fungsi saat FID berubah
    $('#fid_id').change(function () {
        loadRuangLingkup($(this).val());
    });
});

    </script>
    
@endsection