<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Exports\MembersExport;
use App\Exports\MembershipExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
            session()->flash('berhasil', 'Pengajuan membership berhasil. Menunggu konfirmasi admin. Cek profile untuk update status membership!');
            return redirect()->back();
        }
        session()->flash('message', 'Anda sudah mengajukan membership sebelumnya atau sudah memiliki membership. Coba cek di profile Anda!');
        return redirect()->back();
    }

    public function approve($userId)
    {
        $user = User::findOrFail($userId);
        $user->role_name = 'level2'; // Mengubah role_name menjadi level2
        $user->save();

        // Update status membership
        $membership = $user->membership;
        $membership->status = 'approved';
        $membership->save();
        return redirect()->back()->with('berhasil', 'Membership user telah disetujui!');
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
        return redirect()->back()->with('message', 'Membership user telah ditolak!');
    }
  
    public function showUserHistory($userId, Request $request)
    {
        $user = User::findOrFail($userId);

        // Set sorting criteria
        $sort = $request->query('sort');
        $query = $user->events();

        switch ($sort) {
            case 'name_asc':
                $query->orderBy('nama_event', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nama_event', 'desc');
                break;
            case 'tag_asc':
                $query->orderBy('tag', 'asc');
                break;
            case 'tag_desc':
                $query->orderBy('tag', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc'); // Default sorting
                break;
        }

        $events = $query->get();
        return view('membership.history', compact('user', 'events'));
    }


    public function listMembership(Request $request)
    {
        // Default query untuk user dengan role level2
        $query = User::where('role_name', 'level2');

        // Mendapatkan pilihan sorting dari request
        $sort = $request->input('sort');

        // Sorting berdasarkan pilihan user
        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'created_at_asc') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort == 'created_at_desc') {
            $query->orderBy('created_at', 'desc');
        }

        // Pagination hasil query
        $members = $query->paginate(50);

        return view('membership.listMembership', compact('members'));
    }
    public function export()
    {
        return Excel::download(new MembersExport, 'List-Member.xlsx');
    }
}
