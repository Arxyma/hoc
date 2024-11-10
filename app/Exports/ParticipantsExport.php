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
        return $this->event->participants()->select('users.id', 'users.name','users.usia','users.alamat', 'users.email', 'users.no_telp')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Usia',
            'Alamat',
            'Email',
            'Nomor HP',
        ];
    }
}
