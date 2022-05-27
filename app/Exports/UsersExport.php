<?php

namespace App\Exports;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            "Name",
            "EMAIL",
            "Departments",
            // "Roles",
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
            ->join('service_user', 'service_user.user_id', 'users.id')
            ->join('services', 'service_user.service_id', '=', 'services.id')
            ->orderBy('users.id', 'DESC')
            ->select(
                "users.id",
                "users.name",
                "users.email",
                "services.title",
                // "roles.title",
                "users.phone",
                "users.created_at",
            )
            ->get();
    }
}
