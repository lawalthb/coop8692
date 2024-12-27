<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MembersExport implements FromQuery, WithHeadings, WithMapping
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'Member No',
            'Full Name',
            'Email',
            'Phone',
            'Status',
            'Join Date'
        ];
    }

    public function map($member): array
    {
        return [
            $member->member_no,
            $member->full_name,
            $member->email,
            $member->phone_number,
            $member->is_active ? 'Active' : 'Inactive',
            $member->created_at->format('M d, Y')
        ];
    }
}
