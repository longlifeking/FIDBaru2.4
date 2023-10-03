@extends('layout.mainlayout')
@section('title','Flowline Show')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header"><h5><strong>{{ $flowlines->afetabels->judul_afe }}</strong></h5></div>

                <div class="card-body">
                    <p><strong>No AFE: </strong>  {{ $flowlines->afetabels->no_afe }}</p>
                    <p><strong>Fields: </strong>  {{ $flowlines->field->nama_field }}</p>
                    <p><strong>Vendor: </strong>  {{ $flowlines->vendor}}</p>
                    <p><strong>Durasi Pekerjaan : </strong>  {{ $flowlines->hari_project}}</p>
                    <p><strong>Panjang Pipa 2 Inch : </strong>  {{ $flowlines->panjang_2inch}} Meter</p>
                    <p><strong>Panjang Pipa 3 Inch : </strong>  {{ $flowlines->panjang_3inch}} Meter</p>
                    <p><strong>Nilai Realisasi Proyek Dalam Rupiah : </strong>  Rp {{ number_format($flowlines->Nilai_ProyekRP, 0, '.'.',') }}</p>
                    <p><strong>Nilai Realisasi Proyek Dalam USD : </strong>  {{ number_format($flowlines->Nilai_ProyekUSD, 0, '.'. ',')}} USD </p>
                    <p><strong>Keterangan: </strong>  {{ $flowlines->Keterangan }}</p>
                    <p><strong>Detail AFE: <a href ="/afe-show/{{ $flowlines->afetabels->slug }}"> Lihat </a></strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection