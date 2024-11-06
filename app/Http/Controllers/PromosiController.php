<?php

namespace App\Http\Controllers;

use App\Models\Promosi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PromosiController extends Controller
{
    public function index()
    {
        // Ambil semua data promosi dan urutkan berdasarkan waktu pembuatan terbaru
        $promosis = Promosi::orderBy('created_at', 'desc')->paginate(12);
        return view('promosis.index', compact('promosis'));
    }

    public function create()
    {
        return view('promosis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->judul);

        if ($request->hasFile('foto_produk')) {
            $imagePath = $request->file('foto_produk')->store('images/promosi', 'public');
        } else {
            $imagePath = null;
        }

        Promosi::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'foto_produk' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('promosis.index')->with('success', 'Promosi created successfully.');
    }

    public function edit(Request $request, Promosi $promosi)
    {
        $redirect = $request->query('redirect', 'index');

        return view('promosis.edit', compact('promosi'));
    }

    public function update(Request $request, Promosi $promosi)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->judul);

        if ($request->hasFile('foto_produk')) {
            if ($promosi->foto_produk) {
                Storage::disk('public')->delete($promosi->foto_produk);
            }

            $imagePath = $request->file('foto_produk')->store('images/promosi', 'public');
        } else {
            $imagePath = $promosi->foto_produk; // Gambar tidak diubah
        }

        $promosi->update([
            'judul' => $request->judul,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'foto_produk' => $imagePath,
        ]);

        $redirect = $request->input('redirect', 'index');

        if ($redirect === 'mypromote') {
            return redirect()->route('promosis.mypromote')->with('success', 'Promosi updated successfully.');
        }        
        return redirect()->route('promosis.index')->with('success', 'Promosi updated successfully.');
    }

    public function destroy(Request $request, Promosi $promosi)
    {
        if ($promosi->foto_produk) {
            Storage::disk('public')->delete($promosi->foto_produk);
        }

        $promosi->delete();

        $redirect = $request->input('redirect', 'index');

        if ($redirect === 'mypromote') {
            return redirect()->route('promosis.mypromote')->with('success', 'Promosi deleted successfully.');
        }

        return redirect()->route('promosis.index')->with('success', 'Promosi deleted successfully.');
    }

    public function mypromote()
    {
        // Mendapatkan data promosi yang hanya dibuat oleh user yang sedang login
        $promosis = Promosi::where('user_id', Auth::user()->id)->get();

        return view('promosis.mypromote', compact('promosis'));
    }

    public function detail(Promosi $promosi)
    {
        return view('promosis.detail', compact('promosi'));
    }

}
