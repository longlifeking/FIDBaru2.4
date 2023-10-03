<?php
namespace App\Http\Controllers;
use App\Models\afetabel;
use App\Models\fidtabel;
use Illuminate\Support\Str;
use App\Models\ruanglingkup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AFEController extends Controller
{
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
        
        return view('afe-awal', compact('afe_all'));
    }
    public function showMatchingData()
    {
        $fidtabels = fidtabel::all();
        $ruanglingkup = ruanglingkup::whereIn('fid_id', $fidtabels->pluck('id'))->get();
        return view('afe', compact('fidtabels', 'ruanglingkup'));
    }
    public function getRuangLingkup($id)
    {
        $ruanglingkup = ruanglingkup::where('fid_id',$id)->pluck('judulrl','id');
        return json_encode($ruanglingkup);
    }
    public function store(Request $request) 
    {
        $validatedData = $request->validate([
            'ruang_id'=> 'required',
            'no_afe' => 'required|unique:afetabels',
            'judul_afe' =>'required|unique:afetabels',
            'nilai_afe' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'nilai_closing' => ['required','regex:/^\d+(\.\d{1,2})?$/'],
            'status_id' => 'required',
            'targetpekerajaan' => 'required',
            'targetcor' => 'required',
            'quarter_id' =>'required',
            'PS' => 'required|mimes:pdf|max:50480',
            'BS' => 'required|mimes:pdf|max:50480',
            'PISPPP' => 'mimes:pdf|max:50480',
            'COR' => 'mimes:pdf|max:50480',
        ]);

        $validatedData['slug'] = Str::slug($request->judul_afe);
        $PS = $request->file('PS')->store('public/PS');
        $BS = $request->file('BS')->store('public/BS');
        if ($request->hasFile('PISPPP')) {
            $PISPPP = $request->file('PISPPP')->store('public/PISPPP');
        } else {
            $PISPPP = null;
        }
        if ($request->hasFile('COR')) {
            $COR = $request->file('COR')->store('public/COR');
        } else {
            $COR = null;
        }
        $afetabel = afetabel::create($validatedData);

        $afetabel->PS = $PS;
        $afetabel->BS = $BS;
        $afetabel->PISPPP = $PISPPP;
        $afetabel->COR = $COR; 
        $afetabel->save();
        return redirect('afe')->with('status','Data Berhasil Ditambahkan');
        //return redirect('dashboard')->with('status','Data Berhasil Ditambahkan');
        }
        public function edit($slug)
        {
            $fidtabels = Fidtabel::all();
            $ruanglingkup = ruanglingkup::whereIn('fid_id', $fidtabels->pluck('id'))->get();
            $afeall = afetabel::where('slug', $slug)->firstOrFail();
            return view('afe-edit', compact('fidtabels','ruanglingkup','afeall'));
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

        return view('afe-showrl', ['afe_showrls' => $afe_collection]);
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

            return view('afe-show', ['afetabels' => $afetabels]);
        }

        // UNTUK DOWNLOAD PS
        public function downloadFilePS($id) 
        {
            $afetabel = afetabel::findOrFail($id);
            if (!$afetabel->PS) {
            return redirect('not-found');
        }
        return Storage::download($afetabel->PS);
        }

        // UNTUK DOWNLOAD BS
        public function downloadFileBS($id) 
        {
            $afetabel = afetabel::findOrFail($id);
            if (!$afetabel->BS) {
            return redirect('not-found');
        }
        return Storage::download($afetabel->BS);
        }

        // UNTUK DOWNLOAD PIS/PPP
        public function downloadFilePISPPP($id) 
        {
            $afetabel = afetabel::findOrFail($id);
            if (!$afetabel->PISPPP) {
            return redirect('not-found');
        }
        return Storage::download($afetabel->PISPPP);
        }

        // UNTUK DOWNLOAD COR
        public function downloadFileCOR($id) 
        {
            $afetabel = afetabel::findOrFail($id);
            if (!$afetabel->COR) {
            return redirect('not-found');
        }
        return Storage::download($afetabel->COR);
        }


        public function hapus($slug)
        {
            $afe_all = afetabel::where('slug', $slug)->firstOrFail();
            return view('afe-hapus',['afe_all'=>$afe_all]);
        }
        public function destroy($slug)
        {
            $afe_all = afetabel::where('slug', $slug)->firstOrFail();
            $afe_all->delete();
            return redirect('afe-awal');
        }
        public function update(Request $request, $slug)
        {
            $validatedData = $request->validate([
                'ruang_id'=> 'required',
                'no_afe' => 'required|unique:afetabels,no_afe,'.$slug.',slug',
                'judul_afe' =>'required|unique:afetabels,judul_afe,'.$slug.',slug',
                'nilai_afe' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
                'nilai_closing' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
                'status_id' => 'required',
                'targetpekerajaan' => 'required',
                'targetcor' => 'required',
                'quarter_id' =>'required',
                'PS' => 'mimes:pdf|max:50480',
                'BS' => 'mimes:pdf|max:50480',
                'PISPPP' => 'mimes:pdf|max:50480',
                'COR' => 'mimes:pdf|max:50480',
            ]);

            $validatedData['slug'] = Str::slug($request->judul_afe);
            $afeall = afetabel::where('slug', $slug)->first();
            if (!$afeall) {
                return redirect('afe-awal')->with('error','Data tidak ditemukan');
            }

            if ($request->hasFile('PS')) 
            {
                $file = $request->file('PS');
                $PS = $file->store('public/PS');
                // Ubah path file yang disimpan
                $PS = str_replace('public/', '', $PS);
                $validatedData['PS'] = $PS;
            }

            if ($request->hasFile('BS')) 
            {
                $file = $request->file('BS');
                $BS = $file->store('public/BS');
                // Ubah path file yang disimpan
                $BS = str_replace('public/', '', $BS);
                $validatedData['BS'] = $BS;
            }

            if ($request->hasFile('PISPPP')) 
            {
                $file = $request->file('PISPPP');
                $PISPPP = $file->store('public/PISPPP');
                // Ubah path file yang disimpan
                $PISPPP = str_replace('public/', '', $PISPPP);
                $validatedData['PISPPP'] = $PISPPP;
            }

            if ($request->hasFile('COR')) 
            {
                $file = $request->file('COR');
                $COR = $file->store('public/COR');
                // Ubah path file yang disimpan
                $COR = str_replace('public/', '', $COR);
                $validatedData['COR'] = $COR;
            }

            $afeall->update($validatedData);

            return redirect('afe-awal')->with('status','Data Berhasil Diupdate');
        }
        public function search(Request $request)
        {
            $keyword = $request->input('keyword');
            $afe_all = afetabel::where('judul_afe', 'LIKE', "%$keyword%")
            ->orWhere('no_afe', 'LIKE', "%$keyword%")
            ->paginate(10);

            foreach ($afe_all as $afe) {
                $afe->percentageProgress = floor (($afe->status_id / 5) * 100);
            }
            
            return view('afe-awal', ['afe_all' => $afe_all]);
        }
}