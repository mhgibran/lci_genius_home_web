<?php

namespace App\Exports;

use App\BillOwner;
use App\Tower;
use App\Floor;
use App\UnitApart;
use App\Title;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class BillOwnerExportFaktur implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table("billing_owner")
                ->select(DB::raw("concat(mst_tower.kode_tower,mst_floor.no_floor,mst_unit_apart.no_unit_apart) as noUnit"),
                'mst_unit_owner.nama_depan',
                'mst_unit_owner.no_ktp',
                'mst_unit_owner.no_npwp',
                'mst_unit_owner.alamat_ktp',
                'billing_owner.tgl_cetak',
                'billing_owner.kode_billing',
                DB::raw("billing_owner.total_service_charge + billing_owner.jml_biaya_asuransi + billing_owner.jml_biaya_pbb + billing_owner.jml_sinking_fund + billing_owner.jml_slf + billing_owner.jml_hgb + billing_owner.jml_parkir as a"),
                DB::raw("billing_owner.jml_pemakaian + billing_owner.total_pemeliharaan + billing_owner.total_bagian_bersama + billing_owner.jml_biaya_bpju + billing_owner.jml_biaya_admin as b"),
                DB::raw("billing_owner.jml_pemakaian_air + billing_owner.jml_beban_tetap + billing_owner.jml_biaya_admin_air as z"),
                DB::raw('billing_owner.total_service_charge + billing_owner.jml_biaya_asuransi + billing_owner.jml_biaya_pbb + billing_owner.jml_sinking_fund + billing_owner.jml_slf + billing_owner.jml_hgb + billing_owner.jml_parkir + billing_owner.jml_pemakaian + billing_owner.total_pemeliharaan + billing_owner.total_bagian_bersama + billing_owner.jml_biaya_bpju + billing_owner.jml_biaya_admin + billing_owner.jml_pemakaian_air + billing_owner.jml_beban_tetap + billing_owner.jml_biaya_admin_air as c'),
                DB::raw('(billing_owner.total_service_charge + billing_owner.jml_biaya_asuransi + billing_owner.jml_biaya_pbb + billing_owner.jml_sinking_fund + billing_owner.jml_slf + billing_owner.jml_hgb + billing_owner.jml_parkir + billing_owner.jml_pemakaian + billing_owner.total_pemeliharaan + billing_owner.total_bagian_bersama + billing_owner.jml_biaya_bpju + billing_owner.jml_biaya_admin + billing_owner.jml_pemakaian_air + billing_owner.jml_beban_tetap + billing_owner.jml_biaya_admin_air) * 0.1 as d'),
                'billing_owner.biaya_materai',
                DB::raw('(billing_owner.total_service_charge + billing_owner.jml_biaya_asuransi + billing_owner.jml_biaya_pbb + billing_owner.jml_sinking_fund + billing_owner.jml_slf + billing_owner.jml_hgb + billing_owner.jml_parkir + billing_owner.jml_pemakaian + billing_owner.total_pemeliharaan + billing_owner.total_bagian_bersama + billing_owner.jml_biaya_bpju + billing_owner.jml_biaya_admin + billing_owner.jml_pemakaian_air + billing_owner.jml_beban_tetap + billing_owner.jml_biaya_admin_air) + ((billing_owner.total_service_charge + billing_owner.jml_biaya_asuransi + billing_owner.jml_biaya_pbb + billing_owner.jml_sinking_fund + billing_owner.jml_slf + billing_owner.jml_hgb + billing_owner.jml_parkir + billing_owner.jml_pemakaian + billing_owner.total_pemeliharaan + billing_owner.total_bagian_bersama + billing_owner.jml_biaya_bpju + billing_owner.jml_biaya_admin + billing_owner.jml_pemakaian_air + billing_owner.jml_beban_tetap + billing_owner.jml_biaya_admin_air) * 0.1) + billing_owner.biaya_materai as e'))
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
            'No Unit',
            'Unit Owner Name',
            'No KTP',
            'No NPWP',
            'Alamat KTP/NPWP',
            'Tgl Invoice',
            'No Invoice',
            'IKKL',
            'Listrik',
            'Air',
            'DPP',
            'PPN',
            'Materai',
            'Total Invoice'
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
