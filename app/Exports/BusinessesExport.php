<?php

namespace App\Exports;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BusinessesExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            "Name",
            "EMAIL",
            "Business Name",
            "PHONE NO.",
            "CREATION DATE"
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('users')
            ->orderBy('users.id', 'DESC')
            ->select(
                "users.id",
                "users.name",
                "users.email",
                "users.business",
                "users.phone",
                "users.created_at",
            )
            ->get();
    }
}
