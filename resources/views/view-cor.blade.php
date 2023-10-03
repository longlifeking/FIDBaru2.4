@extends('layout.mainlayout')
@section('title', 'Add AFE')
@section('content')
<div class="row">
  <div class="row">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 p-3">
          <h3 class="font-family-inter">DATA MONITORING AFE YANG DIREALISASI ZONA 1 </h3>
        </div>
      </div>
    </div>
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header">
          <span><i class="bi bi-table me-2"></i></span> DATA AFE YANG TELAH DI CLOSING
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-striped data-table" style="width: 100%">
              <!-- Table content goes here -->
              <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul FID</th>
                    <th>Nilai AFE YANG DIREALISASI</th>
                  </tr>
                </thead>
            <tbody>
                @if ($Fid_all->isNotEmpty())
            <!-- Iterate over each Fid -->
            @foreach ($Fid_all->sortBy('tgl') as $fid)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="/fid-show/{{ $fid->slug }}">{{ $fid->judul }}</a></td>
                    <td>USD {{ number_format($fid->totalNilaiCor, 0, '.'. ',') }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="center" colspan="6">Tidak Ada Data FID</td>
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