<?php

namespace App\Exports;

use App\Models\TimeSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TimeSheetExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TimeSheet::select([
            'id', 'work_day', 'difficult', 'plan', 'created_by',
            'manager_id', 'status', 'created_at'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Work Day',
            'Difficult',
            'Plan',
            'Created by',
            'Manager',
            'Status',
            'Created At'
        ];
    }
}

