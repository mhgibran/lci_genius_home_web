<?php

namespace App\Exports;

use App\WaterMeter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class WaterMeterExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table("air_meter")
        ->select('v_helper_unit.namaApart','air_meter.air_awal','air_meter.air_akhir','air_meter.pemakaian_air')
        ->join('v_helper_unit','v_helper_unit.id_unit_apart','=','air_meter.id_unit_apart')
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
