@extends('layout.mainlayout')
@section('title','Show AFE')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header"><h5><strong>{{ $afetabels->judul_afe }}</strong></h5></div>
                <div class="card-body">
                    <p><strong>Judul FID: </strong> {{$afetabels->ruanglingkup->fidtabel->judul}}</p>
                    <p><strong>Judul Ruanglingkup: </strong> {{$afetabels->ruanglingkup->judulrl}}</p>
                    <p><strong>Judul AFE: </strong> {{ $afetabels->judul_afe }}</p>
                    <p><strong>Nilai AFE Disetujui: </strong>USD {{number_format($afetabels->nilai_afe, 0, ',', '.')}}</p>
                    <p><strong>Nilai AFE Direalisasi :</strong> USD {{ number_format($afetabels->nilai_closing, 0, ',', '.') }}</p>
                    <p><strong>Status Terakhir AFE :</strong> {{ $afetabels->statu->name  }}</p>
                    <p><strong>Target Realisasi Pekerjaan : </strong>{{ DateTime::createFromFormat('Y-m-d', $afetabels->targetpekerajaan)->format('d F Y') }}</p>
                    <p><strong>Progress Pekerjaan : </strong> {{$afetabels->percentageProgressPekerjaan}} %  </p>
                    <p><strong>Target Realisasi AFE : </strong> {{$afetabels->quartercor->name_quarter }} {{ $afetabels->targetcor}}</p>
                    <p><strong>Progress Closing AFE :</strong> {{$afetabels->percentageProgress}} %  </p>
                    <p><strong>File PS AFE Yang Disetujui : </strong><a href="{{ route('onlyPS.view', $afetabels->id) }}">View</a></p>
                    <p><strong>File BS AFE Yang Disetujui : </strong><a href="{{ route('onlyBS.view', $afetabels->id) }}">View</a></p>
                    <p><strong>File Persetujuan PIS / PPP : </strong><a href="{{ route('onlyPISPPP.view', $afetabels->id) }}">View</a></p>
                    <p><strong>File Persetujuan COR : </strong><a href="{{ route('onlyCOR.view', $afetabels->id) }}">View</a></p>
                    {{-- <p><strong>Detail Pekerjaan :</strong> <a href="/flowline-show/{{ $afetabels->flowline->slug}}">Lihat</a></p> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection