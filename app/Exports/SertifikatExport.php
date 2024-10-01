<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;

class SertifikatExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($sertifikat) {
            return [
                'ID' => $sertifikat->id,
                'Nama Penerima' => $sertifikat->nama_penerima,
                'Nama Pelatihan' => $sertifikat->training->nama_training,
                'Email' => $sertifikat->email,
                'Status' => $sertifikat->status ? 'Selesai Pelatihan' : 'Terdaftar',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Penerima',
            'Nama Pelatihan',
            'Email',
            'Status',
        ];
    }

    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        $sheet->getStyle('E2:E' . $sheet->getHighestRow())->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        // Loop untuk memberikan warna berdasarkan status
        foreach ($this->data as $index => $sertifikat) {
            $rowIndex = $index + 2; // karena baris pertama adalah header
            if ($sertifikat->status) { // Selesai Pelatihan
                $sheet->getStyle('E' . $rowIndex)->getFont()->getColor()->setARGB('008000'); //hex kode warna hejo
            } else { // Terdaftar
                $sheet->getStyle('E' . $rowIndex)->getFont()->getColor()->setARGB('0000FF'); //hex kode warna biru
            }
        }
    }
}
