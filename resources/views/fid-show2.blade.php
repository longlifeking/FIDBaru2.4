@extends('layout.mainlayout')
@section('title','show')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header"><h5><strong>{{ $fidtabel->judul }}</strong></h5></div>

                <div class="card-body">
                    <p><strong>Tanggal Pembuatan: </strong>  {{ DateTime::createFromFormat('Y-m-d', $fidtabel->tgl)->format('d F Y') }}</p>
                    <p><strong>Pelaksana: </strong>  {{ $fidtabel->pelaksana->nama_pelaksana  }}</p>
                    <p><strong>Nilai FID: </strong>USD {{number_format($fidtabel->nilaifid, 0, '.'.',')}}</p>
                    @php
                        $totalNilaiAfe = 0;
                    @endphp
                    @foreach ($fidtabel->ruanglingkup as $ruanglingkup)
                        @foreach ($ruanglingkup->afetabel as $afe)
                            @if (!empty($afe->nilai_afe))
                                @php
                                    $totalNilaiAfe += $afe->nilai_afe;
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
                    <p><strong>Nilai AFE Disetujui :</strong> USD {{ number_format($fidtabel->totalNilaiAfe, 0,'.'.',') }}</p>
                    @php
                        $totalNilaiCor = 0;
                    @endphp
                    @foreach ($fidtabel->ruanglingkup as $ruanglingkup)
                        @foreach ($ruanglingkup->afetabel as $afe)
                            @if (!empty($afe->nilai_closing))
                                @php
                                    $totalNilaiAfe += $afe->nilai_closing;
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
                    <strong>Wilayah Kerja / field : </strong>  {{ $fidtabel->field->nama_field  }}</p>
                    <p><strong>Nilai AFE Direalisasi :</strong> USD {{ number_format($fidtabel->totalNilaiCor, 0, '.'.',') }}</p>
                    <strong>Ruang Lingkup:</strong>
                    <ul class="ruanglingkup">
                    @foreach($fidtabel->ruanglingkup as $rl)
                        <li><a href="/afe-showrl1/{{$rl->id}}">{{ $rl->judulrl }}</a></li>
                    @endforeach
                    </ul>
                    <p><strong>File Persetujuan FID : </strong><a href="{{ route('fidpdf.view', $fidtabel->id) }}">View</a></p>
                    <p><strong>File Persetujuan POD : </strong><a href="{{ route('podpdf.view', $fidtabel->id) }}">View</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection