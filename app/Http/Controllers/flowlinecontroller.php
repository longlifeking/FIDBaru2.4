<?php

namespace App\Http\Controllers;

use App\Models\field;
use App\Models\afetabel;
use App\Models\fidtabel;
use App\Models\flowline;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class flowlinecontroller extends Controller
{
    //
    public function index()
{
    $afetabels = Afetabel::orderBy('no_afe', 'asc')->get();
    $fidtabel = fidtabel::all();
    $field = field::all();
    $flowline = flowline::all();

    $fields = [
        'CardJambi' => 1,
        'CardPangkalansusu' => 2,
        'CardRantau' => 3,
        'Cardsiak' => 4
    ];

    $cardValues = [];
    $cardBiaya = [];

    foreach ($fields as $cardName => $fieldValue) {
        $filteredFlowlines = flowline::where('nama_fields', $fieldValue)->get();

        $sum = 0;
        $sumByProjectValue = 0;

        foreach ($filteredFlowlines as $flow) {
            if ($flow->hari_project != 0) {
                $sum += (($flow->panjang_3inch + $flow->panjang_2inch) / $flow->hari_project);
            }
            if ($flow->hari_project != 0 && $flow->Nilai_ProyekUSD != 0) {
                $sumByProjectValue += ($flow->Nilai_ProyekUSD / ($flow->panjang_3inch + $flow->panjang_2inch) /3);
            }
        }

        $cardValues[$cardName] = round (count($filteredFlowlines) ? $sum / count($filteredFlowlines) : 0);
        $cardBiaya["CardBiaya" . $cardName] = round(count($filteredFlowlines) ? $sumByProjectValue/count($filteredFlowlines) :0);
    }

    return view('flowline', array_merge(compact('flowline', 'afetabels', 'fidtabel', 'field'), $cardValues, $cardBiaya));
}


    public function tambah()
    {
        $afetabels = Afetabel::orderBy('no_afe', 'asc')->get();
        return view('flowline_tambah', ['afetabels' => $afetabels]);
    }
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'afe_flow'=> 'required|unique:flowlines',
            'judul_afe'=>'required',
            'vendor' => 'required',
            'nama_fields' =>'required',
            'hari_project' =>'required',
            'panjang_2inch' =>'',
            'panjang_3inch' =>'',
            'Nilai_ProyekUSD'=>'required',
            'Nilai_ProyekRP'=>'required',
            'Keterangan'=>'',
        ]);

        $slug = Str::slug($validatedData['judul_afe']);

        // Menghasilkan slug dari judul_afe
        $flowline = flowline::create([
            'afe_flow' => $validatedData['afe_flow'],
            'slug' => $slug,
            'vendor' => $validatedData['vendor'],
            'nama_fields' => $validatedData['nama_fields'],
            'hari_project' => $validatedData['hari_project'],
            'panjang_2inch' => $validatedData['panjang_2inch'],
            'panjang_3inch' => $validatedData['panjang_3inch'],
            'Nilai_ProyekRP' => $validatedData['Nilai_ProyekRP'],
            'Nilai_ProyekUSD' => $validatedData['Nilai_ProyekUSD'],
            'Keterangan' => $validatedData['Keterangan'],
        ]);

        //$afetabels = afetabel::all();

        //return redirect('afe')->with('status','Data Berhasil Ditambahkan');

        //return redirect('flowline_tambah', compact('afetabels'))->with('status', 'Data Berhasil Ditambahkan');
        return redirect('flowline_tambah')->with('status', 'Data Berhasil Ditambahkan');
    }

    public function hapus($slug)
    {
        $afetabels = afetabel::all();
        $flowline = flowline::where('slug', $slug)->firstOrFail();
        return view('flowline-hapus',['flowline'=>$flowline,'afetabels'=>$afetabels]);
    }

    // hapus selamanya
    public function destroy($slug)
    {
        $flowline = flowline::where('slug', $slug)->firstOrFail();
        $flowline->delete();
        return redirect('flowline');
    }
    public function edit($slug)
    {
        $flowline = flowline::where('slug',$slug)->firstOrFail();
        $afetabels = afetabel::all();
        return view('flowline-edit',['afetabels'=>$afetabels,'flowline'=>$flowline]);
    }

    public function update(Request $request, $slug)
{
    $validatedData = $request->validate([
        'afe_flow' => 'required|unique:flowlines,afe_flow,' . $slug . ',slug',
        'judul_afe' => 'required',
        'vendor' => 'required',
        'nama_fields' => 'required',
        'hari_project' => 'required',
        'panjang_2inch' => '',
        'panjang_3inch' => '',
        'Nilai_ProyekUSD' => 'required|numeric',
        'Nilai_ProyekRP' => 'required',
        'Keterangan' => '',
    ]);

    $slug = Str::slug($validatedData['judul_afe']);

    // Try to find the flowline by slug
    $flowlineall = flowline::where('slug', $slug)->first();

    // If not found, redirect or handle accordingly
    if (!$flowlineall) {
        return redirect('flowline')->with('error', 'Flowline not found.');
    }

    $flowlineall->afe_flow = $validatedData['afe_flow'];
    $flowlineall->vendor = $validatedData['vendor'];
    $flowlineall->nama_fields = $validatedData['nama_fields'];
    $flowlineall->hari_project = $validatedData['hari_project'];
    $flowlineall->panjang_2inch = $validatedData['panjang_2inch'];
    $flowlineall->panjang_3inch = $validatedData['panjang_3inch'];
    $flowlineall->Nilai_ProyekRP = $validatedData['Nilai_ProyekRP'];
    $flowlineall->Nilai_ProyekUSD = $validatedData['Nilai_ProyekUSD'];
    $flowlineall->Keterangan = $validatedData['Keterangan'];
    $flowlineall->save();

    return redirect('flowline');
}
public function show($slug)
{
    $flowlines = flowline::where('slug', $slug)->with('afetabels')->firstOrFail();
    return view('flowline-show', ['flowlines' => $flowlines]);
}

public function viewjambi1()
{
    $flowlines = flowline::where('nama_fields', 1)->get();
    // $filteredFlowlines = flowline::where('nama_fields', 1)->get();
    // $hasil = 0;
    
    // // Periksa apakah hari_project tidak sama dengan 0 sebelum melakukan perhitungan
    // if ($filteredFlowlines->isNotEmpty() && $filteredFlowlines->first()->hari_project != 0) {
    //     // Ganti $flow dengan $filteredFlowlines jika itu adalah yang Anda maksud
        
    //     $hasil = (($filteredFlowlines->first()->panjang_3inch + $filteredFlowlines->first()->panjang_2inch) / $filteredFlowlines->first()->hari_project);
    // }
    
    // $cardValuesJambi = $hasil;
    return view('viewjambi-flowline', ['flowlines' => $flowlines]);
}

public function Hargajambi1()
{
    $flowlines = flowline::where('nama_fields', 1)->get();
    return view('viewjambiHarga-flowline', ['flowlines' => $flowlines]);
}



public function viewpangsu1()
{
    $flowlines = flowline::where('nama_fields', 2)->get();
    return view('viewpangsu-flowline', ['flowlines' => $flowlines]);

}

public function Hargapangsu1()
{
    $flowlines = flowline::where('nama_fields', 2)->get();
    return view('viewpangsu-flowline', ['flowlines' => $flowlines]);

}

public function viewrantau1()
{
    $flowlines = flowline::where('nama_fields', 3)->get();
    return view('viewrantau-flowline', ['flowlines' => $flowlines]);

}

public function Hargarantau1()
{
    $flowlines = flowline::where('nama_fields', 3)->get();
    return view('viewrantauHarga-flowline', ['flowlines' => $flowlines]);

}

public function viewsiak1()
{
    $flowlines = flowline::where('nama_fields', 4)->get();
    return view('viewsiak-flowline', ['flowlines' => $flowlines]);

}
public function Hargasiak1()
{
    $flowlines = flowline::where('nama_fields', 4)->get();
    return view('viewsiak-flowline', ['flowlines' => $flowlines]);

}
}
