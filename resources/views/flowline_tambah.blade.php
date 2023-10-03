@extends('layout.mainlayout')
@section('title', 'Add flowline')
@section('content')
  <div id="app">
      <div class="main-wrapper mt-3">
        <div class="main-content">
          <div class="container">
            <form method="post" action="{{route('flowline.store')}}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                <div class="card-header">
                  <h3>FLOWLINE BARU</h3>
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
                          <!-- Dropdown untuk memilih No AFE -->
                            <div class="form-group mt-3">
                              <label for="afe_flow">No AFE:</label>
                              <select name="afe_flow" id="afe_flow" class="form-control mt-2 select2">
                                  <option selected disabled value="">-- Pilih No AFE --</option>
                                  @foreach($afetabels as $afe)
                                      @if (strlen($afe->no_afe) >= 4 && substr($afe->no_afe, 3, 3) === '22A')
                                          <option value="{{ $afe->id }}" data-title="{{ $afe->judul_afe }}">{{ $afe->no_afe }}</option>
                                      @endif
                                  @endforeach
                              </select>
                            </div>
        
                    <!-- Input field untuk menampilkan Judul AFE -->
                    <div class="form-group mt-3">
                      <label for="judul_afe">Judul AFE:</label>
                      <input type="text" id="judul_afe" name="judul_afe" class="form-control mt-2" placeholder="Judul AFE" required readonly>
                    </div>
                    <input type="hidden" id="slug" name="slug">
                        

                          <div class="form-group mt-3">
                              <label for="vendor ">Vendor Project:</label>
                              <input type="text" id="vendor" name="vendor" class="form-control mt-2" placeholder="Nama Vendor Project" required>
                          </div>
                          
                          <div class="form-group mt-3">
                            <label class="form-label">Fields Pertamina</label>
                            <select class="form-select" name="nama_fields" class="form-control mt-2" aria-label="Default select example" value="{{ old('nama_fields') }}" >
                              <option selected disabled value="">Fields Pertamina</option>
                              <option value="1">Jambi</option>
                              <option value="2">Pangkalan Susu</option>
                              <option value="3">Rantau</option>
                              <option value="4">Siak & Kampar</option>
                            </select>
                          </div>

                          <div class="form-group mt-3">
                              <label for="hari_project ">Durasi Proyek :</label>
                              <input type="number" id="hari_project" name="hari_project" class="form-control mt-2" placeholder="Durasi Proyek" required>
                          </div>
                          <div class="form-group mt-3">
                              <label for="panjang_2inch ">Panjang Flowline 2 Inchi:</label>
                              <input type="number" id="panjang_2inch" name="panjang_2inch" class="form-control mt-2" placeholder="Panjang Flowline 2 Inch">
                          </div>
                          <div class="form-group mt-3">
                            <label for="panjang_3inch ">Panjang Flowline 3 Inchi:</label>
                            <input type="number" id="panjang_3inch" name="panjang_3inch" class="form-control mt-2" placeholder="Panjang Flowline 3 Inch" required>
                          </div>
                          <div class="form-group mt-3">
                            <label for="Nilai_ProyekRP ">Nilai Proyek Dalam Rupiah :</label>
                            <input type="number" id="Nilai_ProyekRP2" name="Nilai_ProyekRP" class="form-control mt-2" placeholder="Nilai Proyek Flowline 2 Inch dalam Rupiah">
                          </div>
                          <div class="form-group mt-3">
                            <label for="Nilai_ProyekUSD ">Nilai Proyek Dalam Dollar :</label>
                            <input type="number" id="decimalInput" step="0.01" name="Nilai_ProyekUSD" class="form-control mt-2" placeholder="Nilai Proyek Flowline 2 Inch dalam Dollar" required>
                          </div>
                          <div class="form-group mt-3">
                            <label for="Keterangan ">Keterangan :</label>
                            <textarea type="text" id="Keterangan" name="Keterangan" class="form-control mt-2" placeholder="Keterangan apa terjadi Freeze "> </textarea>
                          </div>
                      </form>
                          <!-- Submit Button -->
                          <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>

                          <!-- Select2 JS -->
                          <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


                          <!-- Initialize Select2 and bind onChange event -->
                          <script type="text/javascript">
                               $('.select2').select2({
                                placeholder: '-- Pilih No AFE --',
                                allowClear: true, // Add this line to allow clearing the selection
                                width: '100%', // Adjust the width as needed
                                // You can add more configuration options here
                            });

                            // Add event listener to update the "Judul AFE" input when an option is selected
                            $('#afe_flow').on('change', function() {
                                var selectedOption = $(this).find(':selected');
                                var judulAfe = selectedOption.data('title');
                                $('#judul_afe').val(judulAfe); // Set the value of the input field
                            });

                            // Trigger the change event on page load to populate the #judul_afe input field
                            $('#afe_flow').trigger('change');
                        </script>
@endsection