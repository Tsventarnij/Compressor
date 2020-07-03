<?php
namespace App\Http\Controllers;

use App\Http\Service\CompressorService;
use Illuminate\Http\Request;
use App\Rules\{
    Compress,
    Decompress
};

class CompressorController
{

    public function compress(Request $request)
    {
        $request->validate([
            'inputString' => ['required', 'string', new Compress]
        ]);

        return response()->json([
            'compressed' => CompressorService::compress($request->input("inputString"))
        ]);
    }

    public function decompress(Request $request)
    {
        $request->validate([
            'inputString' => ['required', 'string', new Decompress]
        ]);

        return response()->json([
            'decompressed' => CompressorService::decompress($request->input("inputString"))
        ]);
    }
}