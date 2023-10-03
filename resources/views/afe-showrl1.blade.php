@extends('layout.mainlayout')
@section('title', 'Tampilkan AFE')
@section('content')


<div class="container-fluid"> 
    <div class="row"> 
        <div class="col-md-12 p-3">
            <h3 class="font-family-inter">Data Full AFE Dalam Satu Ruang Lingkup</h3>
        </div> 
    </div>

    <div class="row mt-5">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-table me-2"></i></span> Data AFE
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped data-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomer AFE</th>
                                    <th>Judul AFE</th>
                                    <th>Nilai AFE Disetujui</th>
                                    <th>Progress Pekerjaan Fisik</th>
                                    <th>Nilai AFE Direalisasi</th>
                                    <th>Progress Realisasi AFE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($afe_showrls->isNotEmpty())
                                    @foreach ($afe_showrls as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="/afe-show/{{$item->slug}}">{{ $item->no_afe }}</a></td>
                                            <td>{{$item->judul_afe}}</td> 
                                            <td>USD {{ number_format($item->nilai_afe, 0, '.', ',') }}</td>
                                            <td>{{$item->percentageProgressPekerjaan}} % </td>
                                            <td>USD {{ number_format($item->nilai_closing, 0, '.', ',') }}</td>
                                            <td>{{$item->percentageProgress}} % </td>              
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="center" colspan="6"> Tidak ADA DATA AFE</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset ('js/jquery-3.5.1.js')}}"></script>
<script src="{{asset ('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset ('js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset ('js/script.js')}}"></script>
@endsection
