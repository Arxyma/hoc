<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $beritas = Berita::latest()->paginate(12);
        return view('beritaIndex', compact('beritas'));
    }
}
