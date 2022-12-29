<?php

namespace App\Exports;

use App\BillAging;
use App\BillAgingView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BillAgingExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BillAgingView::select('mst_title.nama_title','mst_unit_owner.nama_depan','mst_unit_owner.nama_belakang','mst_unit_apart.no_unit_apart','v_billing_aging.type1','v_billing_aging.type2','v_billing_aging.type3','v_billing_aging.type4','v_billing_aging.type5','v_billing_aging.typeall')
                ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','v_billing_aging.id_unit_owner')
                ->join('mst_title','mst_unit_owner.id_title','=','mst_title.id_title')
                ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                ->get();
    }
    public function headings(): array
    {
        return [
            'Title',
            'First Name',
            'Last Name',
            'Unit Number',
            '<=0 Days',
            '1 - 30 Days',
            '31 - 60 Days',
            '61 - 90 Days',
            '> 3 Months',
            'Outstanding Amount'
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
