<?php

namespace App\Exports;

use App\ElectricityMeter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class ElectricityMeterExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table("listrik_meter")
        ->select('v_helper_unit.namaApart','listrik_meter.listrik_awal','listrik_meter.listrik_akhir','listrik_meter.pemakaian_listrik')
        ->join('v_helper_unit','v_helper_unit.id_unit_apart','=','listrik_meter.id_unit_apart')
        ->get();
    }
    public function headings(): array
    {
        return [
            'Unit Number',
            'Start Meter',
            'End Meter',
            'Total Usage'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
