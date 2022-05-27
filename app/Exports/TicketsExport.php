<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TicketsExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            "USER",
            "TICKET NO.",
            "EMAIL",
            "PHONE NO.",
            "STATUS",
            "CREATION DATE"
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('tickets')
            ->join('users', 'tickets.user_id', '=', 'users.id')
            ->orderBy('tickets.id', 'DESC')
            ->select(
                "tickets.id",
                "users.name",
                "tickets.number",
                "users.email",
                "users.phone",
                "tickets.status",
                "tickets.created_at",
            )
            ->get();
    }
}
