@extends('layout.mainlayout')
@section('title','Show Flowline')
@section('content')
<div class="row">
    <div class="row">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 p-3">
            <h3 class="font-family-inter">DATA MONITORING FLOWLINE JAMBI YANG DISETUJUI ZONA 1 </h3>
          </div>
        </div>
      </div>
      <div class="col-md-12 mb-3">
        <div class="card">
          <div class="card-header">
            <span><i class="bi bi-table me-2"></i></span> Data FID
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table-striped data-table" style="width: 100%">
                <!-- Table content goes here -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. AFE</th>
                        <th class="judul-proyek-col">Judul Proyek</th>
                        <th>Fields</th>
                        <th>Panjang 2 inch</th>
                        <th>Panjang 3 inch</th>
                        <th>Durasi Pekerjaan</th>
                        <th>Rata-rata Proyek Pengerjaan</th> <!--- Rata-rata Proyek---> 
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($flowlines->isNotEmpty())
                        @foreach ($flowlines->sortBy('slug') as $flowline)
                          @php
                              $cardValuesJambi = (($flowline->panjang_3inch + $flowline->panjang_2inch) / $flowline->hari_project);
                          @endphp
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td><a href="/flowline-show/{{ $flowline->slug }}">{{ $flowline->afetabels->no_afe }}</a></td>
                              <td>{{ $flowline->afetabels->judul_afe }}</td>
                              <td>{{ $flowline->field->nama_field }}</td>
                              <td>{{ $flowline->panjang_2inch }} Meter</td>
                              <td>{{ $flowline->panjang_3inch }} Meter</td>
                              <td>{{ $flowline->hari_project }} Hari</td>
                              <td>{{  round($cardValuesJambi) }} Hari / Meter</td>
                              <td>
                                  <a href="/flowline-edit/{{ $flowline->slug }}" class="icon"><i class="bi bi-pencil-square"></i></a>
                                  <a href="/flowline-hapus/{{ $flowline->slug }}" class="icon"><i class="bi bi-file-earmark-x-fill"></i></a>
                              </td>
                          </tr>
                    @endforeach
                    @else
                        <tr>
                            <td class="center" colspan="9">Tidak Ada Data FLOWLINE</td>
                        </tr>
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
@endsection