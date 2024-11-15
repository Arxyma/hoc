<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $members = User::where('role_name', 'level2')
            ->select('id', 'name', 'email', 'created_at')
            ->get();

        $members->each(function ($member, $index) {
            $member->no = $index + 1; // Add numbering starting from 1
        });

        return $members->map(function ($member) {
            return [
                'no' => $member->no,
                'name' => $member->name,
                'email' => $member->email,
                'created_at' => $member->created_at->format('d M Y'), // Format date
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Email',
            'Tanggal Bergabung',
        ];
    }
}
