@extends('layout.mainlayout')
@section('title', 'dashboard')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-3">
      <h3 class="font-family-inter">Dashboard</h3>
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-4 mb-3">
  <div class="card bg-primary text-white h-100">
    <div class="card-body py-5">Total Nilai FID ZONA 1
      <h3>USD {{ number_format($CardNilaifid, 0, '.'.',') }}</h3>
    </div>
    <div class="card-footer d-flex">
      <a href ="view-fid" class="white"> View Details</a>
       <span class="ms-auto">
         <i class="bi bi-chevron-right"></i>
       </span>
     </div>
  </div>
</div>
<div class="col-md-4 mb-3">
  <div class="card bg-warning text-dark h-100">
    <div class="card-body py-5">Total Nilai AFE Disetujui
      <h3>USD {{ number_format($CardNilaiAfe, 0, '.'.',') }}</h3>
    </div>
    <div class="card-footer d-flex">
      <a href ="/view-afe" class="black"> View Details</a>
      <span class="ms-auto">
        <i class="bi bi-chevron-right"></i>
      </span>
    </div>
  </div>
</div>
<div class="col-md-4 mb-3">
  <div class="card bg-success text-white h-100">
    <div class="card-body py-5">Total Nilai AFE Telah Closing
      <h3>USD {{ number_format($CardNilaiCor, 0, '.'.',') }}</h3>
    </div>
    <div class="card-footer d-flex">
      <a href ="/view-cor" class="white"> View Details</a>
      <span class="ms-auto">
        <i class="bi bi-chevron-right"></i>
      </span>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-header">
        <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
        Area Chart Per-Field
      </div>
      <div class="card-body">
        <canvas id="areaChartPerFID" width="400" height="200"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-3">
    <div class="card h-100">
      <div class="card-header">
        <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
        Area Chart Nilai FID Per-Field 
      </div>
      <div class="card-body">
        <canvas id="myChart" width="400" height="200"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="row">
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
                  <th class="judul-fid-col">Judul FID</th>
                  <th>Nilai FID</th>
                  <th>Nilai AFE Disetujui</th>
                  <th>Nilai AFE Telah Closing</th>
                  <th>Realisasi FID</th>
                </tr>
              </thead>
          <tbody>
              @if ($Fid_all->isNotEmpty())
          <!-- Iterate over each Fid -->
          @foreach ($Fid_all->sortBy('slug') as $fid)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td><a href="/fid-show2/{{ $fid->slug }}">{{ $fid->judul }}</a></td>
                  <td>USD {{ number_format($fid->nilaifid, 0, '.'.',') }}</td>
                  <td>USD {{ number_format($fid->totalNilaiAfe, 0, '.'.',') }}</td>
                  <td>USD {{ number_format($fid->totalNilaiCor, 0, '.'.',') }}</td>
                  <td>{{ $fid->percentageProgress }} %</td>
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
<script>

// buat chart ke 2 untuk FID PER FIELD

var nilaiFIDData1 = @json($groupedFidField->values());
var namaFieldsData1 = @json($groupedFidField->keys());

var ctxAreaPerFID = document.getElementById('areaChartPerFID').getContext('2d');
var areaChartPerFID = new Chart(ctxAreaPerFID, {
    type: 'bar',
    data: {
        labels: namaFieldsData1, // Use the field names as labels
        datasets: [{
            label: 'Jumlah FID',
            data: nilaiFIDData1, // Use the grouped data values
            backgroundColor: 'rgba(0, 123, 255, 0.2)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// buat chart ke 2 untuk NILAI FID PER FIELD 
var nilaiFIDData = @json($groupedFidValues->values());
var namaFieldsData = @json($groupedFidValues->keys());

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: namaFieldsData,
        datasets: [{
            label: 'Total Nilai FID',
            data: nilaiFIDData,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});



  </script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>

@endsection
