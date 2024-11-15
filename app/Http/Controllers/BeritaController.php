<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{

    public function index()
    {
        $beritas = Berita::all();
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi_berita' => 'required',
            'gambar' => 'image|mimes:jpeg,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->file('gambar')) {
            $imagePath = $request->file('gambar')->store('gambar', 'public');
        }
        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi_berita' => $request->isi_berita,
            'gambar' => $imagePath,
        ]);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.tampil', compact('berita'));
    }
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'isi_berita' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $berita = Berita::findOrFail($id);
        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->judul);
        $berita->isi_berita = $request->isi_berita;

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('gambar', 'public');
            $berita->gambar = $imagePath;
        }

        $berita->save();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
