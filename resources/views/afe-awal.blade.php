@extends('layout.mainlayout')
@section('title', 'Add AFE')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 p-3">
            <h3 class="font-family-inter">Data Full AFE</h3>
        </div>
    </div>
</div>

    <div class="mt-5 d-flex justify-content-end">
        <a href="{{ route('afe.index') }}" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah AFE</a>
    </div>

<div class="row mt-5">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Full AFE
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped data-table mt-5" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomer AFE</th>
                                <th class="judul-proyek-col">Judul AFE</th>
                                <th>Nilai AFE Disetujui</th>
                                <th>Progress Fisik Pekerjaan</th>
                                <th>Nilai AFE Direalisasi</th>
                                <th class="judul-realisasi-col">Progress Closing AFE</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($afe_all->isNotEmpty())
                                @foreach ($afe_all as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="/afe-show/{{ $item->slug }}">{{ $item->no_afe }}</a></td>
                                    <td>{{ $item->judul_afe }}</td> 
                                    <td>USD {{ number_format($item->nilai_afe, 0, '.'. ',') }}</td>
                                    <td>{{ $item->percentageProgressPekerjaan }}%</td>
                                    <td>USD {{ number_format($item->nilai_closing, 0, '.'. ',') }}</td>
                                    <td>{{ $item->percentageProgress }}%</td>              
                                    <td>
                                        <a href="/afe-edit/{{ $item->slug }}" class="icon"><i class="bi bi-pencil-square"></i></a>
                                        <a href="/afe-hapus/{{ $item->slug }}" class="icon"><i class="bi bi-file-earmark-x-fill"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="center" colspan="8">Tidak ADA DATA AFE</td>
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
{{-- <div class="row">{{ $afe_all->links() }}</div> --}}
@endsection