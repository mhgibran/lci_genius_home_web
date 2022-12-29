<?php

namespace App\Exports;

use App\BillOwner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class BillOwnerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table("billing_owner")
                ->select(DB::raw('billing_owner.kode_billing','concat(mst_title.nama_title,mst_unit_owner.nama_depan,mst_unit_owner.nama_belakang) as fullName',"concat(mst_tower.kode_tower,mst_floor.no_floor,mst_unit_apart.no_unit_apart) as noUnit",'billing_owner.tgl_cetak','billing_owner.tgl_jatuh_tempo','billing_owner.total_tagihan','billing_owner.total_tagihan_air','billing_owner.jml_sc_ikkl','billing_owner.biaya_materai','billing_owner.total_tagihan_all'))
                ->join('mst_unit_owner','mst_unit_owner.id_unit_owner','=','billing_owner.id_unit_owner')
                ->join('mst_title','mst_unit_owner.id_title','=','mst_title.id_title')
                ->join('mst_unit_apart','mst_unit_apart.id_unit_apart','=','mst_unit_owner.id_unit_apart')
                ->join('mst_tower','mst_tower.id_tower','=','mst_unit_apart.id_tower')
                ->join('mst_floor','mst_floor.id_floor','=','mst_unit_apart.id_floor')
                ->get();
    }
    public function headings(): array
    {
        return [
            'Billing Code',
            'Unit Owner Name',
            'Unit Number',
            'Invoice Date',
            'Due Date',
            'Electricity Bill',
            'Water Bill',
            'SC + IKKL + PBB + Insurance Bill',
            'Stamp Fee',
            'Bill GrandTotal'
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
