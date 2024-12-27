<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromQuery, WithHeadings, WithMapping
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
            'Date',
            'Reference',
            'Member',
            'Type',
            'Credit',
            'Debit',
            'Description'
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->created_at->format('M d, Y'),
            $transaction->reference,
            $transaction->user->full_name,
            ucfirst($transaction->type),
            $transaction->credit_amount,
            $transaction->debit_amount,
            $transaction->description
        ];
    }
}
