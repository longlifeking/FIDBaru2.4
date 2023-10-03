<?php

namespace App\Http\Controllers;

use App\Models\ruanglingkup;
use Illuminate\Http\Request;

class RuangLingkupController extends Controller
{
    //
    public function getRuangLingkupByFID($fid)
    {
        // Log the input fid
        Log::info('Received fid: ' . $fid);
        $ruanglingkups = ruanglingkup::where('fid_id', $fid)->get();
         // Log the result
        Log::info('Found RuangLingkup: ', $ruanglingkups->toArray());
        return response()->json($ruanglingkups);
    }
}
