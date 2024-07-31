<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download(Request $request)
    {
        $file = $request->file;
        $path = public_path($file);
        // $newFilename = 'new_filename.ext';
        return response()->download($path);
    }
}
