@extends('layout.mainlayout')
@section('title', 'Add flowline')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 p-3">
            <h3 class="font-family-inter">Data Monitoring Dan Evaluasi Flowline Projects ZONA 1</h3>
        </div>
    </div>
</div>
<div class="row">
    <!-- Card for Jambi -->
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">Rata Rata Pengerjaan Flowline Di Jambi
                <h3>{{$CardJambi}} Meter / Hari </h3>
            </div>
            <div class="card-footer d-flex">
                <a href="viewjambi-flowline" class="white"> View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Card for Rantau -->
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white h-100">
            <div class="card-body py-5">Rata Rata Pengerjaan Flowline Di Rantau
                <h3>{{$CardRantau}} Meter / Hari </h3>
            </div>
            <div class="card-footer d-flex">
                <a href="viewrantau-flowline" class="white"> View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
    

    <!-- Card for Pangkalan Susu -->
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white h-100">
            <div class="card-body py-5">Rata Rata Pengerjaan Flowline Di Pangkalan Susu
                <h3>{{$CardPangkalansusu}} Meter / Hari </h3>
            </div>
            <div class="card-footer d-flex">
                <a href="viewpangsu-flowline" class="white"> View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Card for Siak Kampar -->
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">Rata Rata Pengerjaan Flowline Di Siak Kampar
                <h3>{{$Cardsiak}} Meter / Hari </h3>
            </div>
            <div class="card-footer d-flex">
                <a href="viewsiak-flowline" class="white"> View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Card for Jambi -->
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">Rata Rata Biaya Pengerjaan Flowline Di Jambi
                <h3>{{$CardBiayaCardJambi}} USD / Meter </h3>
            </div>
            <div class="card-footer d-flex">
                <a href="viewjambiHarga-flowline" class="white"> View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Card for Rantau -->
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white h-100">
            <div class="card-body py-5">Rata Rata Biaya Pengerjaan Flowline Di Rantau
                <h3>{{$CardBiayaCardRantau}} USD / Meter </h3>
            </div>
            <div class="card-footer d-flex">
                <a href="viewrantauHarga-flowline" class="white"> View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
    

    <!-- Card for Pangkalan Susu -->
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white h-100">
            <div class="card-body py-5">Rata Rata Biaya Pengerjaan Flowline Di Pangkalan Susu
                <h3>{{$CardBiayaCardPangkalansusu}} USD / Meter </h3>
            </div>
            <div class="card-footer d-flex">
                <a href="viewpangsuHarga-flowline" class="white"> View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Card for Siak Kampar -->
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">Rata Rata Biaya Pengerjaan Flowline Di Siak Kampar
                <h3>{{$CardBiayaCardsiak}} USD / Meter </h3>
            </div>
            <div class="card-footer d-flex">
                <a href="viewsiakHarga-flowline" class="white"> View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
</div>


        
<form action="" method="get">
    <div class="mt-5 d-flex justify-content-end">
        <a href={{route('tambah')}} class="btn btn-primary"><i class="bi bi-plus"></i> Tambah Flowline</a>
    </div>
</form>

<div class="row mt-5">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Full Flowline
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped data-table mt-5" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. AFE</th>
                                <th class="judul-proyek-col">Judul Proyek</th>
                                <th>Fields</th>
                                <th>Panjang 2 inch</th>
                                <th>Panjang 3 inch</th>
                                <th>Durasi Pekerjaan</th>
                                <th>Nilai Proyek</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($flowline->isNotEmpty())
                                @foreach ($flowline->sortBy('slug') as $flowlines)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="/flowline-show/{{ $flowlines->slug }}">{{ $flowlines->afetabels->no_afe }}</a></td>
                                        <td>{{ $flowlines->afetabels->judul_afe }}</td>
                                        <td>{{ $flowlines->field->nama_field }}</td>
                                        <td>{{ $flowlines->panjang_2inch }} Meter </td>
                                        <td>{{ $flowlines->panjang_3inch }} Meter </td>
                                        <td>{{ $flowlines->hari_project }} Hari</td>
                                        <td>USD {{ number_format($flowlines->Nilai_ProyekUSD, 0, '.'. ',') }}</td>
                                        <td>
                                            <a href="/flowline-edit/{{ $flowlines->slug }}" class="icon"><i class="bi bi-pencil-square"></i></a>
                                            <a href="/flowline-hapus/{{ $flowlines->slug }}" class="icon"><i class="bi bi-file-earmark-x-fill"></i></a>
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
<script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
@endsection
