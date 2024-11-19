<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{

    public function index(Request $request)
    {
        $beritas = Berita::all();
        $sortOrder = $request->get('sort', 'desc');

        // Dapatkan data berita berdasarkan urutan yang dipilih
        $beritas = Berita::orderBy('created_at', $sortOrder)->get();

        // Kirim data `sortOrder` ke view untuk menjaga pilihan pengguna
        return view('berita.index', compact('beritas', 'sortOrder'));
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
        if (Berita::where('judul', $request->judul)->exists()) {
            return redirect()->back()->with('error', 'Judul berita ini sudah ada, silakan gunakan judul yang berbeda.');
        }
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
        $validator = Validator::make($request->all(), [
            'judul' => 'required|unique:beritas,judul,' . $id,
            'isi_berita' => 'required',
            'gambar' => 'image|mimes:jpeg,jpg|max:2048',
        ]);
        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Judul berita sudah ada, silakan gunakan judul yang lain.');
        }

        $berita = Berita::findOrFail($id);
        $berita->judul = $request->judul;
        $berita->slug = Str::slug($request->judul);
        $berita->isi_berita = $request->isi_berita;

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('gambar', 'public');
            $berita->gambar = $imagePath;
        }
        // Cek apakah ada perubahan
        if ($berita->isDirty()) {
            $berita->save();
            return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
        }
        // Jika tidak ada perubahan, redirect kembali tanpa mengatur flash message
        return redirect()->route('berita.index');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
