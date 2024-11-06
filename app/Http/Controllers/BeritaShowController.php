<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $berita = Berita::findOrFail($id);
        return view('beritaTampil', compact('berita'));
    }
}
