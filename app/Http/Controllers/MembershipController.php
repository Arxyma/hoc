<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function index()
    {
        $pendingMemberships = User::whereHas('membership', function ($query) {
            $query->where('status', 'pending');
        })->with('events')->get();

        return view('membership.index', compact('pendingMemberships'));
    }

    public function requestMembership()
    {
        $user = Auth::user();

        // Cek apakah user bisa mengajukan membership
        if ($user->role_name == 'level1' && (!$user->membership || $user->membership->status == 'rejected')) {
            // Menarik data history event dan menyimpannya ke tabel membership
            Membership::updateOrCreate(
                ['user_id' => $user->id], // Cek jika ada membership berdasarkan user_id
                ['status' => 'pending'] // Set status menjadi pending lagi jika sebelumnya rejected
            );

            return redirect()->route('dashboard')->with('status', 'Pengajuan membership berhasil. Menunggu konfirmasi admin.');
        }

        return redirect()->route('dashboard')->with('status', 'Anda sudah mengajukan membership sebelumnya atau sudah memiliki membership.');
    }

    // public function approve($id)
    // {
    //     $membership = Membership::findOrFail($id);
    //     $membership->status = 'approved';

    //     // Ubah level user di tabel `users` ke level2
    //     $user = $membership->user;
    //     $user->role_name = 'level2';
    //     $user->save();

    //     $membership->save();

    //     return redirect()->route('membership.index')->with('status', 'Membership berhasil disetujui.');
    // }
    public function approve($userId)
    {
        $user = User::findOrFail($userId);
        $user->role_name = 'level2'; // Mengubah role_name menjadi level2
        $user->save();

        // Update status membership
        $membership = $user->membership;
        $membership->status = 'approved';
        $membership->save();

        return redirect()->route('membership.index')->with('status', 'Membership user telah disetujui.');
    }


    public function reject($userId)
    {
        $user = User::findOrFail($userId);

        // Update status membership menjadi rejected
        $membership = $user->membership;
        $membership->status = 'rejected';
        $membership->save();

        // Set ulang role_name menjadi level1
        $user->role_name = 'level1';
        $user->save();

        // Memberi kesempatan user mengajukan membership kembali
        return redirect()->route('membership.index')->with('status', 'Pengajuan membership ditolak. Anda bisa mengajukan kembali.');
    }
    public function showUserHistory($userId)
    {
        $user = User::findOrFail($userId); // Mendapatkan data user berdasarkan ID
        $events = $user->events; // Mengambil event yang diikuti oleh user

        // Menampilkan halaman riwayat event
        return view('membership.history', compact('user', 'events'));
    }
    public function listMembership()
    {
        // Ambil user dengan role 'level2' yang sudah disetujui
        $members = User::where('role_name', 'level2')->paginate(50); // Pagination 50 per halaman

        return view('membership.listMembership', compact('members'));
    }
}
