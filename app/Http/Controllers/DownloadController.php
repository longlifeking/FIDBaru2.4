<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    //
    public function download(Request $request, $filename)
    {
        // Get file path
        $path = Storage::disk('public')->path($filename);

        // Check if file exists
        if (!file_exists($path)) {
            abort(404);
        }

        // Get file size
        $size = filesize($path);

        // Set headers
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . $size);
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Output file
        readfile($path);
    }
}
