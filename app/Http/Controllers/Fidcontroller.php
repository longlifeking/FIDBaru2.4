<?php

namespace App\Http\Controllers;

use App\Models\afetabel;
use App\Models\fidtabel;
use Illuminate\Support\Str;
use App\Models\ruanglingkup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // untuk menyimpam

class Fidcontroller extends Controller
{
    public function fid(){
        return view("fid");
    }

    public function tampilansearch()
    {
        $Fid_all = fidtabel::paginate(10);
        //$CardNilaifid = $Fid_all->sum('nilaifid');
        // Perform calculations for each FID
        foreach ($Fid_all as $fid) {
            $totalNilaiAfe = 0;
            $totalNilaiCor = 0;
            $totalProgress = 0;
            $totalAfeCount = 0;

            foreach ($fid->ruanglingkup as $ruanglingkup) {
                foreach ($ruanglingkup->afetabel as $afe) {
                    if (!empty($afe->nilai_afe)) {
                        $totalNilaiAfe += $afe->nilai_afe;
                    }

                    if (!empty($afe->nilai_closing)) {
                        $totalNilaiCor += $afe->nilai_closing;
                    }

                    if (!empty($afe->status_id)) {
                        $totalProgress += $afe->status_id;
                        $totalAfeCount++;
                    }
                }
            }

            $percentageProgress = $totalAfeCount > 0 ? floor(($totalProgress / ($totalAfeCount * 5)) * 100) : 0;
            // Add calculated values to each FID object
            $fid->totalNilaiAfe = $totalNilaiAfe;
            $fid->totalNilaiCor = $totalNilaiCor;
            $fid->percentageProgress = $percentageProgress;

        }
        //$Afe_all = afetabel::get();
        //$CardNilaiAfe = $Afe_all->sum('nilai_afe');
        //$CardNilaiCor = $Afe_all->sum('nilai_closing');

        //$groupedFidValues = $Fid_all->groupBy('field.nama_field')
        //->map(function ($group) {return $group->sum('nilaifid');});

        // grop jumlah field

        //$groupedFidField = $Fid_all->groupBy('field.nama_field')
        //                    ->map(function ($group) {
        //                       return $group->count();
         //                   });

        return view('fid-search', ['Fid_all' => $Fid_all,]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|unique:fidtabels|max:255',
            'nilaifid' => 'required|numeric',
            'tgl' => 'required',
            'pelaksana_id' => 'required',
            'judulrl' => 'required|array',
            'judulrl.*' => 'required',
            'fields_id' =>'required',
            'filepath' => 'required|mimes:pdf|max:50480',
            'filepod' => 'required|mimes:pdf|max:50480',            
            ]);

            $validatedData['slug'] = Str::slug($request->judul);
            $filepath = $request->file('filepath')->store('public/AppFID');
            $filepod = $request->file('filepod')->store('public/POD');
            $fidtabel = fidtabel::create($validatedData);

            $judulrl = collect($request->input('judulrl'));
            foreach ($judulrl as $judulrlData) {
                $judulrl = new ruanglingkup();
                $judulrl->fid_id = $fidtabel->id;
                $judulrl->judulrl = $judulrlData;
                $judulrl->save();
            }

            $fidtabel->filepath = $filepath;
            $fidtabel->filepod = $filepod;
            $fidtabel->save();

    return redirect('fid')->with('status','Data Berhasil Ditambahkan');
}

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $Fid_all = fidtabel::where('judul', 'LIKE', "%$keyword%")
        ->orWhere('tgl', 'LIKE', "%$keyword%")
        ->orWhere('nilaifid', 'LIKE', "%$keyword%")
        ->orWhereHas('pelaksana', function ($query) use ($keyword) {
        $query->where('nama_pelaksana', 'LIKE', "%$keyword%");
    })
    ->orWhereHas('ruanglingkup', function ($query) use ($keyword) {
        $query->where('judulrl', 'LIKE', "%$keyword%");
    })
    ->orWhereHas('ruanglingkup.afetabel', function ($query) use ($keyword) {
        $query->where('no_afe', 'LIKE', "%$keyword%")
        ->orWhere('judul_afe', 'LIKE', "%$keyword%");
    })
    ->paginate(10);

    foreach ($Fid_all as $fid) {
        $totalProgress = 0;
        $totalAfeCount = 0;
        foreach ($fid->ruanglingkup as $ruanglingkup) {
            foreach ($ruanglingkup->afetabel as $afe) {
                if (!empty($afe->status_id)) {
                    $totalProgress += $afe->status_id;
                    $totalAfeCount++;
                }
            }
        }
        $percentageProgress = $totalAfeCount > 0 ? floor(($totalProgress / ($totalAfeCount * 5)) * 100) : 0;
        $fid->percentageProgress = $percentageProgress;
    }
     return view('fid-search', ['Fid_all' => $Fid_all]);
    }
    public function edit($slug) 
    {
        $Fid_all = fidtabel::where('slug', $slug)->firstOrFail();
        return view('fid-edit', ['Fid_all' => $Fid_all]);
    }
    public function update(Request $request, $slug)
    {
    $validatedData = $request->validate
    ([
        'judul' => 'required|unique:fidtabels,judul,'.$slug.',slug',
        'nilaifid' => 'required|numeric',
        'tgl' => 'required',
        'pelaksana_id' => 'required',
        'judulrl' => 'required|array',
        'judulrl.*' => 'required',
            
    ]);
    
    $validatedData['slug'] = Str::slug($request->judul);
    $fidtabel = fidtabel::where('slug', $slug)->firstOrFail();
    $fidtabel->update($validatedData);

    foreach ($request->input('judulrl') as $index => $judulrlData) 
    {
        $judulrl = ruanglingkup::where('fid_id', $fidtabel->id)->get()[$index];
        $judulrl->judulrl = $judulrlData;
        $judulrl->save();
    }
    
    if ($request->hasFile('filepath')) 
    {
        $file = $request->file('filepath');
        $filePath = $file->store('public/AppFID');
        // Ubah path file yang disimpan
        $filePath = str_replace('public/', '', $filePath);
        $fidtabel->filepath = $filePath;
        $fidtabel->save();
    }

    return redirect('dashboard')->with('status','Data Berhasil Diupdate');
    }
    public function hapus($slug)
    {
        $Fid_all = fidtabel::where('slug', $slug)->firstOrFail();
        return view('fid-hapus',['Fid_all'=>$Fid_all]);
    }
    public function destroy($slug)
    {
        $Fid_all = fidtabel::where('slug', $slug)->firstOrFail();
        $ruanglingkupIds = $Fid_all->ruanglingkup()->pluck('id');
        // Hapus entri terkait dalam tabel "afetabels"
        afetabel::whereIn('ruang_id', $ruanglingkupIds)->delete();
        // Hapus baris dalam tabel "ruanglingkups"
        $Fid_all->ruanglingkup()->delete();
        // Hapus baris dalam tabel "fidtabels"
        $Fid_all->delete();
        return redirect('dashboard');
    }
    public function show ($slug)
    {
        $fidtabel = fidtabel::where('slug', $slug)->with('ruanglingkup.afetabel')->firstOrFail();
        return view('fid-show', ['fidtabel' => $fidtabel]);
    }

    public function show2 ($slug)
    {
        $fidtabel = fidtabel::where('slug', $slug)->with('ruanglingkup.afetabel')->firstOrFail();
        return view('fid-show2', ['fidtabel' => $fidtabel]);
    }
    
    public function downloadFile($id)
    {
        $fidtabel = fidtabel::findOrFail($id);

        if (!$fidtabel->filepath) {
            return abort(404, 'File not found.');
        }
    
        return Storage::download($fidtabel->filepath);
    }

    public function viewFile($id)
    {
        $pdf = fidtabel::findOrFail($id); // Ganti YourModel dengan model Anda

        $path = $pdf->filepath; // Asumsikan Anda memiliki kolom 'path' di tabel Anda yang menyimpan path ke file PDF

    if (!Storage::exists($path)) {
        abort(404, 'PDF tidak ditemukan.');
    }

    $content = Storage::get($path);

    return response($content)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
        
    }

    public function viewPod($id)
    {
        $pdf = fidtabel::findOrFail($id); // Ganti YourModel dengan model Anda

        $path = $pdf->filepod; // Asumsikan Anda memiliki kolom 'path' di tabel Anda yang menyimpan path ke file PDF

    if (!Storage::exists($path)) {
        abort(404, 'PDF tidak ditemukan.');
    }

    $content = Storage::get($path);

    return response($content)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
        
    }

    // view FID
    public function onlyviewFile($id)
    {
        return view('fid-view', ['pdfId' => $id]);
    }
    // view POD
    public function onlyviewFilePODP($id)
    {
        return view('pod-view',['podid' =>$id]);

    }

    public function downloadPod($id)
    {
        $fidtabel = fidtabel::findOrFail($id);

    if (!$fidtabel->filepod) {
        return abort(404, 'File not found.');
    }

    return Storage::download($fidtabel->filepod);
    }
}