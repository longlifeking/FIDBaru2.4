<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\afetabel;
use App\Models\fidtabel;
use App\Models\ruanglingkup;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    //$Fid_all = fidtabel::paginate(10);
    $Fid_all = fidtabel::get();
    $CardNilaifid = $Fid_all->sum('nilaifid');
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
        $Afe_all = afetabel::get();
        $CardNilaiAfe = $Afe_all->sum('nilai_afe');
        $CardNilaiCor = $Afe_all->sum('nilai_closing');

        $groupedFidValues = $Fid_all->groupBy('field.nama_field')
        ->map(function ($group) {return $group->sum('nilaifid');});

        // grop jumlah field

        $groupedFidField = $Fid_all->groupBy('field.nama_field')
                            ->map(function ($group) {
                                return $group->count();
                            });

        return view('dashboard', ['Fid_all' => $Fid_all, 'CardNilaifid' => $CardNilaifid, 'CardNilaiAfe' => $CardNilaiAfe,'CardNilaiCor' => $CardNilaiCor,  'groupedFidValues' => $groupedFidValues, 'groupedFidField'=> $groupedFidField]);

}

public function viewfid()
{
    //$Fid_all = fidtabel::paginate(10);
    $Fid_all = fidtabel::get();
    $CardNilaifid = $Fid_all->sum('nilaifid');
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

            $percentageProgress = $totalAfeCount > 0 ? floor(($totalProgress / ($totalAfeCount * 6)) * 100) : 0;
            // Add calculated values to each FID object
            $fid->totalNilaiAfe = $totalNilaiAfe;
            $fid->totalNilaiCor = $totalNilaiCor;
            $fid->percentageProgress = $percentageProgress;

        }
        $Afe_all = afetabel::get();
        $CardNilaiAfe = $Afe_all->sum('nilai_afe');
        $CardNilaiCor = $Afe_all->sum('nilai_closing');

        return view('view-fid', ['Fid_all' => $Fid_all, 'CardNilaifid' => $CardNilaifid, 'CardNilaiAfe' => $CardNilaiAfe,'CardNilaiCor' => $CardNilaiCor]);

}
public function viewafe()
{
    //$Fid_all = fidtabel::paginate(10);
    $Fid_all = fidtabel::get();
    $CardNilaifid = $Fid_all->sum('nilaifid');
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

            $percentageProgress = $totalAfeCount > 0 ? floor(($totalProgress / ($totalAfeCount * 6)) * 100) : 0;
            // Add calculated values to each FID object
            $fid->totalNilaiAfe = $totalNilaiAfe;
            $fid->totalNilaiCor = $totalNilaiCor;
            $fid->percentageProgress = $percentageProgress;

        }
        $Afe_all = afetabel::get();
        $CardNilaiAfe = $Afe_all->sum('nilai_afe');
        $CardNilaiCor = $Afe_all->sum('nilai_closing');

        return view('view-afe', ['Fid_all' => $Fid_all, 'CardNilaifid' => $CardNilaifid, 'CardNilaiAfe' => $CardNilaiAfe,'CardNilaiCor' => $CardNilaiCor]);

}
public function viewcor()
{
    //$Fid_all = fidtabel::paginate(10);
    $Fid_all = fidtabel::get();
    $CardNilaifid = $Fid_all->sum('nilaifid');
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

            $percentageProgress = $totalAfeCount > 0 ? floor(($totalProgress / ($totalAfeCount * 6)) * 100) : 0;
            // Add calculated values to each FID object
            $fid->totalNilaiAfe = $totalNilaiAfe;
            $fid->totalNilaiCor = $totalNilaiCor;
            $fid->percentageProgress = $percentageProgress;

        }
        $Afe_all = afetabel::get();
        $CardNilaiAfe = $Afe_all->sum('nilai_afe');
        $CardNilaiCor = $Afe_all->sum('nilai_closing');

        return view('view-cor', ['Fid_all' => $Fid_all, 'CardNilaifid' => $CardNilaifid, 'CardNilaiAfe' => $CardNilaiAfe,'CardNilaiCor' => $CardNilaiCor]);

}
public function user()
{
    {
        //$Fid_all = fidtabel::paginate(10);
        $Fid_all = fidtabel::get();
        $CardNilaifid = $Fid_all->sum('nilaifid');
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
            $Afe_all = afetabel::get();
            $CardNilaiAfe = $Afe_all->sum('nilai_afe');
            $CardNilaiCor = $Afe_all->sum('nilai_closing');
    
            $groupedFidValues = $Fid_all->groupBy('field.nama_field')
            ->map(function ($group) {return $group->sum('nilaifid');});
    
            // grop jumlah field
    
            $groupedFidField = $Fid_all->groupBy('field.nama_field')
                                ->map(function ($group) {
                                    return $group->count();
                                });
    
            return view('dashboard2', ['Fid_all' => $Fid_all, 'CardNilaifid' => $CardNilaifid, 'CardNilaiAfe' => $CardNilaiAfe,'CardNilaiCor' => $CardNilaiCor,  'groupedFidValues' => $groupedFidValues, 'groupedFidField'=> $groupedFidField]);
    
    }
}
}
