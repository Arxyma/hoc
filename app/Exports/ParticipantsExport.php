<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantsExport implements FromCollection, WithHeadings
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function collection()
    {
        $participants = $this->event->participants()
            ->select('users.name', 'users.usia', 'users.alamat', 'users.email', 'users.no_telp', 'event_user.created_at')
            ->get();

        $participants->each(function ($participant, $index) {
            $participant->no = $index + 1; // Menambahkan nomor urut dimulai dari 1
        });

        // Mapping data peserta dan memformat tanggal ke nama bulan
        return $participants->map(function ($participant) {
            return [
                'no' => $participant->no,
                'name' => $participant->name,
                'usia' => $participant->usia,
                'alamat' => $participant->alamat,
                'email' => $participant->email,
                'no_telp' => $participant->no_telp,
                'created_at' => $participant->created_at->translatedFormat('d F Y'), // Format dengan nama bulan
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Usia',
            'Alamat',
            'Email',
            'Nomor HP',
            'Tanggal Daftar',
        ];
    }
}
