@extends('layout.mainlayout')
@section('title','FID')
@section('content')
<form action="{{ route('fid.search') }}" method="GET" class="mt-5">
    <div class="input-group mb-3 mt-5">
        <input type="text" id="searchInput" name="keyword" class="form-control" onkeyup="myFunction()" placeholder="Pencarian AFE xxxx di FID...">
        <button class="btn btn-primary" type="submit">Pencarian</button>
    </div>
</form>


<form action="{{route('fid-tampilan')}}" method="get">
    <div class="mt-5 d-flex justify-content-end">
        <a href="fid" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah FID</a>
    </div>
</form>

<table class="table mt-5">
    <thead>
        <tr>
            <th>No</th>
            <th class="judul-proyek-col">Judul</th>
            <th>Nilai FID</th>
            <th>Nilai AFE Disetujui</th>
            <th>Nilai AFE Telah Closing</th>
            <th>Progress</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($Fid_all->isNotEmpty())
            <!-- Iterate over each Fid -->
            @foreach ($Fid_all->sortBy('slug') as $fid)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="/fid-show/{{ $fid->slug }}">{{ $fid->judul }}</a></td>
                    <td>USD {{ number_format($fid->nilaifid, 0, '.'. ',') }}</td>
                    <td>USD {{ number_format($fid->totalNilaiAfe, 0,  '.'. ',') }}</td>
                    <td>USD {{ number_format($fid->totalNilaiCor, 0,  '.'. ',') }}</td>
                    <td>{{ $fid->percentageProgress }} %</td>
                    <td>
                        <a href="/fid-edit/{{ $fid->slug }}" class="icon"><i class="bi bi-pencil-square"></i></a>
                        <a href="/fid-hapus/{{ $fid->slug }}" class="icon"><i class="bi bi-file-earmark-x-fill"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="center" colspan="7">Tidak Ada Data FID</td>
            </tr>
        @endif
    </tbody>
</table>

<div class="pagination">
    {{ $Fid_all->links() }} <!-- This will generate the pagination links -->
</div>
</table>
<script>
    function clearInput() {
        document.getElementById("searchInput").value = '';
        // Hide the clear button
        document.getElementById("clearBtn").style.display = 'none';
    }
    
    function myFunction() {
        let keyword = document.getElementById("searchInput").value;
        // Show the clear button if there's text in the input
        if(keyword.length > 0) {
            document.getElementById("clearBtn").style.display = 'block';
        } else {
            document.getElementById("clearBtn").style.display = 'none';
        }
        // ... rest of your function
    }
    </script>
    
    
    


@endsection
