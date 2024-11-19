<?php

namespace App\Http\Controllers;

use App\Models\Promosi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PromosiController extends Controller
{
    public function index(Request $request)
    {
        session(['redirect_url' => route('promosis.index')]);

        $query = Promosi::where('status', 'approved');

        // Filter pencarian berdasarkan judul
        if ($request->has('search') && $request->search !== null) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $promosis = $query->orderBy('created_at', 'desc')->paginate(12);

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

        // Generate slug
        $slug = Str::slug($request->judul);
        $uniqueSlug = $slug;
        $counter = 1;

        // Cek apakah slug sudah ada, jika iya, tambahkan angka di belakangnya
        while (Promosi::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter;
            $counter++;
        }

        $fotoProduk = [];

        if ($request->hasFile('foto_produk')) {
            foreach ($request->file('foto_produk') as $foto) {
                $path = $foto->store('images/promosi', 'public');
                $fotoProduk[] = $path;
            }
        }

        // Simpan data ke database
        Promosi::create([
            'judul' => $request->judul,
            'slug' => $uniqueSlug, // Gunakan slug unik
            'deskripsi' => $request->deskripsi,
            'foto_produk' => json_encode($fotoProduk),
            'user_id' => Auth::id(),
            'status' => 'pending', // Set status menjadi "pending" saat dibuat
        ]);

        return redirect()->route('promosis.promosisaya')->with('berhasil', 'Promosi berhasil dibuat dan menunggu persetujuan admin.');
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
        // Redirect ke URL yang disimpan dalam session, atau default ke halaman my-promosi
        return redirect(session('redirect_url', route('promosis.promosisaya')))
        ->with('berhasilupdate', 'Produk berhasil diubah.');
    }


    public function destroy(Request $request, Promosi $promosi)
    {
        if ($promosi->foto_produk) {
            Storage::disk('public')->delete($promosi->foto_produk);
        }

        $promosi->delete();

        $redirect = $request->input('redirect', 'index');

        if ($redirect === 'mypromote') {
            return redirect()->route('promosis.promosisaya')->with('success', 'Promosi berhasil dihapus.');
        }elseif($redirect === 'semuapromosi'){
            return redirect()->route('promosis.semuapromosi')->with('success', 'Promosi berhasil dihapus.');
        }
        return redirect()->route('promosis.index')->with('success', 'Promosi berhasil dihapus.');
    }

    public function promosiku(Request $request)
    {
        session(['redirect_url' => route('promosis.promosisaya')]);
        $status = $request->input('status'); // Ambil status dari request
        session(['redirect_url' => route('promosis.promosisaya')]);

        // Query untuk mendapatkan promosi berdasarkan user dan status yang dipilih
        $query = Promosi::where('user_id', Auth::user()->id)
                        ->orderBy('created_at', 'desc');

        // Jika status ada dalam request, tambahkan filter status pada query
        if ($status) {
            $query->where('status', $status);
        }

        $promosis = $query->paginate(12);

        return view('promosis.promosisaya', compact('promosis'));
    }



    public function detail($slug)
    {
        // Coba temukan promosi berdasarkan slug
        $promosi = Promosi::where('slug', $slug)->first();

        if (!$promosi) {
            // Redirect ke halaman 404 atau tampilkan pesan
            abort(404, 'Promosi tidak ditemukan');
        }

        return view('promosis.detail', compact('promosi'));
    }



    public function approve($id)
    {
        $promosi = Promosi::findOrFail($id);
        $promosi->update(['status' => 'approved']);

        return redirect()->route('promosis.pengajuan')->with('success', 'Promosi berhasil disetujui.');
    }

    public function reject($id)
    {
        $promosi = Promosi::findOrFail($id);
        $promosi->update(['status' => 'rejected']);

        return redirect()->route('promosis.pengajuan')->with('success', 'Promosi berhasil ditolak.');
    }

    public function adminIndexPengajuan(Request $request)
    {
        $query = Promosi::where('status', 'pending');

        // Cek parameter 'sort' untuk sorting
        $sortOrder = $request->get('sort', 'desc'); // Default ke 'desc'

        $promosis = $query->orderBy('created_at', $sortOrder)->paginate(12);

        return view('promosis.pengajuan', compact('promosis', 'sortOrder'));
    }


    public function adminIndexPromosi(Request $request)
    {
        // Mulai query
        $query = Promosi::where('status', 'approved');

        // Filter pencarian jika ada parameter 'search'
        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Default sorting adalah terbaru
        $sortOrder = $request->get('sort', 'desc'); // Jika tidak ada, default ke 'desc'

        // Urutkan berdasarkan tanggal upload
        $query->orderBy('created_at', $sortOrder);

        // Ambil hasil dengan pagination
        $promosis = $query->paginate(12);

        // Kembalikan ke view
        return view('promosis.semuapromosi', compact('promosis', 'sortOrder'));
    }




}
