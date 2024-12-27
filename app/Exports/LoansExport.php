<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoansExport implements FromQuery, WithHeadings, WithMapping
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
            'Reference',
            'Member',
            'Amount',
            'Interest',
            'Total Amount',
            'Duration',
            'Status',
            'Date'
        ];
    }

    public function map($loan): array
    {
        return [
            $loan->reference,
            $loan->user->full_name,
            $loan->amount,
            $loan->interest_amount,
            $loan->total_amount,
            $loan->duration . ' months',
            ucfirst($loan->status),
            $loan->created_at->format('M d, Y')
        ];
    }
}
