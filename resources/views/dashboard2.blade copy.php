@extends('layout.mainlayout')
@section('title', 'dashboard')
@section('content')

<h2>Daftar FID</h2>
<form action="{{ route('fid.search') }}" method="GET" class="mt-5">
    <div class="input-group mb-3">
        <input type="text" name="keyword" class="form-control" placeholder="Cari FID...">
        <button class="btn btn-primary" type="submit">Pencarian</button>
    </div>
</form>
<table class="table mt-5">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul FID</th>
            <th>Nilai FID</th>
            <th>Nilai AFE</th>
            <th>Nilai COR</th>
        </tr>
    </thead>
    <tbody>
        @if ($Fid_all->isNotEmpty())
            <!-- Iterate over each Fid -->
            @foreach ($Fid_all as $fid)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="/fid-show/{{ $fid->slug }}">{{ $fid->judul }}</a></td>
                    <td>USD {{ number_format($fid->nilaifid, 0, ',', '.') }}</td>
                    <!-- Calculate totalNilaiAfe -->
                    @php
                        $totalNilaiAfe = 0;
                    @endphp
                    @foreach ($fid->ruanglingkup as $ruanglingkup)
                        @foreach ($ruanglingkup->afetabel as $afe)
                            @if (!empty($afe->nilai_afe))
                                @php
                                    $totalNilaiAfe += $afe->nilai_afe;
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
                    <td>USD {{ number_format($totalNilaiAfe, 0, ',', '.') }}</td>
                    @php
                        $totalNilaiCor = 0;
                    @endphp
                    @foreach ($fid->ruanglingkup as $ruanglingkup)
                        @foreach ($ruanglingkup->afetabel as $afe)
                            @if (!empty($afe->nilai_closing))
                                @php
                                    $totalNilaiCor += $afe->nilai_closing;
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
                    <td>USD {{ number_format($fid->totalNilaiCor, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="center" colspan="6">Tidak Ada Data FID</td>
            </tr>
        @endif
    </tbody>
</table>

<div class="row">{{ $Fid_all->links() }}</div>

@endsection
