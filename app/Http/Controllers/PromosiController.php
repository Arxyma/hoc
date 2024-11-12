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
        $promosis = Promosi::where('status', 'approved')
                           ->orderBy('created_at', 'desc')
                           ->paginate(12);
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
            'foto_produk' => 'nullable|array|max:4',
            'foto_produk.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->judul);
        $fotoProduk = [];

        if ($request->hasFile('foto_produk')) {
            foreach ($request->file('foto_produk') as $foto) {
                $path = $foto->store('images/promosi', 'public');
                $fotoProduk[] = $path;
            }
        }

        Promosi::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'foto_produk' => json_encode($fotoProduk),
            'user_id' => Auth::id(),
            'status' => 'pending', // Set status menjadi "pending" saat dibuat
        ]);

        return redirect()->route('promosis.promosisaya')->with('success', 'Promosi berhasil dibuat dan menunggu persetujuan admin.');
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
            'foto_produk' => 'nullable|array|max:4',
            'foto_produk.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slug = Str::slug($request->judul);
        $fotoProduk = json_decode($promosi->foto_produk, true) ?? [];

        if ($request->hasFile('foto_produk')) {
            // Hapus foto lama
            foreach ($fotoProduk as $foto) {
                Storage::disk('public')->delete($foto);
            }
            $fotoProduk = []; // Reset array untuk foto baru

            foreach ($request->file('foto_produk') as $foto) {
                $path = $foto->store('images/promosi', 'public');
                $fotoProduk[] = $path;
            }
        }

        $promosi->update([
            'judul' => $request->judul,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'foto_produk' => json_encode($fotoProduk),
        ]);

        return redirect()->route('promosis.promosisaya')->with('success', 'Promosi updated successfully.');
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

    // public function promosiku()
    // {
    //     $promosis = Promosi::where('user_id', Auth::user()->id)
    //                         ->orderBy('created_at', 'desc')
    //                         ->get();

    //     return view('promosis.promosisaya', compact('promosis'));
    // }
    public function promosiku(Request $request)
    {
        $status = $request->input('status'); // Ambil status dari request

        // Query untuk mendapatkan promosi berdasarkan user dan status yang dipilih
        $query = Promosi::where('user_id', Auth::user()->id)
                        ->orderBy('created_at', 'desc');

        // Jika status ada dalam request, tambahkan filter status pada query
        if ($status) {
            $query->where('status', $status);
        }

        $promosis = $query->get();

        return view('promosis.promosisaya', compact('promosis'));
    }



    public function detail(Promosi $promosi)
    {
        return view('promosis.detail', compact('promosi'));
    }

    public function approve($id)
    {
        $promosi = Promosi::findOrFail($id);
        $promosi->update(['status' => 'approved']);

        return redirect()->route('promosis.index')->with('success', 'Promosi berhasil disetujui.');
    }

    public function reject($id)
    {
        $promosi = Promosi::findOrFail($id);
        $promosi->update(['status' => 'rejected']);

        return redirect()->route('promosis.index')->with('success', 'Promosi berhasil ditolak.');
    }

    public function adminIndex()
    {
        $promosis = Promosi::where('status', 'pending')->paginate(12); // Misalnya ambil semua promosi dengan status pending
        return view('promosis.pengajuan', compact('promosis'));
    }


}
