<?php

namespace App\Http\Controllers;

use App\Models\afetabel;
use App\Models\ruanglingkup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AFEControllerPengunjung extends Controller
{
    // untuk melihat awal tampilan

    public function awal()
    {
        $afe_all = afetabel::all();
        foreach ($afe_all as $afe) {
            $afe->percentageProgress = floor (($afe->status_id / 5) * 100);
        }
        foreach ($afe_all as $afe) {
            // Jika $afe->status_id sudah mencapai 3 atau lebih, set ke 3
            if ($afe->status_id >= 3) {
                $afe->status_id = 3;
            } else {
                // Jika kurang dari 3, biarkan sesuai dengan nilai aslinya
                $afe->status_id = $afe->status_id;
            }
        
            // Hitung persentase kemajuan pekerjaan
            $afe->percentageProgressPekerjaan = floor(($afe->status_id / 3) * 100);
        }
        
        return view('afe-awal1', compact('afe_all'));
    }

    public function show($slug)
    {
        $afetabels = afetabel::where('slug', $slug)->firstOrFail();


            // Calculate percentage progress
            $afetabels->percentageProgress = floor(($afetabels->status_id / 5) * 100);

            // If $afetabel->status_id is 3 or more, set it to 3
            // Store the original status_id value
            $originalStatusId = $afetabels->status_id; // deskripsikan dulu valuenya

            // Check if status_id is greater than or equal to 3
            if ($afetabels->status_id >= 3) {
                $afetabels->status_id = 3;
                // No need for the else part since if it's less than 3, it remains unchanged
            }

            // Calculate percentage progress for work
            $afetabels->percentageProgressPekerjaan = floor(($afetabels->status_id / 3) * 100);

            // Restore the original status_id value
            $afetabels->status_id = $originalStatusId;

            return view('afe-show2', ['afetabels' => $afetabels]);
    }

    public function FileBS($id)
    {
            $pdf = afetabel::findOrFail($id); // Ganti YourModel dengan model Anda
    
            $path = $pdf->BS; // Asumsikan Anda memiliki kolom 'path' di tabel Anda yang menyimpan path ke file PDF
    
        if (!Storage::exists($path)) {
            return redirect('not-found');
        }
    
        $content = Storage::get($path);
    
        return response($content)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }

    public function viewFileBS($id)
    {
        return view('bs-view', ['pdfbs' => $id]);
    }

    public function FilePS($id)
    {
        $pdf = afetabel::findOrFail($id); // Ganti YourModel dengan model Anda
    
        $path = $pdf->PS; // Asumsikan Anda memiliki kolom 'path' di tabel Anda yang menyimpan path ke file PDF

    if (!Storage::exists($path)) {
        return redirect('not-found');
    }

    $content = Storage::get($path);

    return response($content)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }

    public function viewFilePS($id)
    {
        return view('ps-view', ['pdfps' => $id]);
    }

    public function FilePISPPP($id)
    {
        $pdf = afetabel::findOrFail($id); // Ganti YourModel dengan model Anda
    
        $path = $pdf->PISPPP; // Asumsikan Anda memiliki kolom 'path' di tabel Anda yang menyimpan path ke file PDF

    if (!Storage::exists($path)) {
        return redirect('not-found');
    }

    $content = Storage::get($path);

    return response($content)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }

    public function viewFilePISPPP($id)
    {
        return view('ppp-view', ['pdfppp' => $id]);
    }

    public function FileCOR($id)
    {
        $pdf = afetabel::findOrFail($id); // Ganti YourModel dengan model Anda
    
        $path = $pdf->COR; // Asumsikan Anda memiliki kolom 'path' di tabel Anda yang menyimpan path ke file PDF

    if (!Storage::exists($path)) {
        return redirect('not-found');
    }

    $content = Storage::get($path);

    return response($content)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }

    public function viewFileCOR($id) 
    {
        return view('cor-view', ['pdfcor' => $id]);
    }

    public function showrl($id)
    {
        $ruangLingkup = ruanglingkup::find($id);

        if ($ruangLingkup === null) {
            return redirect()->back()->withErrors(['message' => 'RuangLingkup not found']);
        }

        $afe_collection = collect();

        foreach ($ruangLingkup->afetabel as $afe_showrl) {
            $afe_showrl->percentageProgress = floor(($afe_showrl->status_id / 5) * 100);

            $originalStatusId = $afe_showrl->status_id;

            if ($afe_showrl->status_id >= 3) {
                $afe_showrl->status_id = 3;
            }

            $afe_showrl->percentageProgressPekerjaan = floor(($afe_showrl->status_id / 3) * 100);
            $afe_showrl->status_id = $originalStatusId; // Restore the original status_id value

            $afe_collection->push($afe_showrl);
        }
        return view('afe-showrl1', ['afe_showrls' => $afe_collection]);
    }
}
