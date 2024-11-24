<?php

namespace App\Exports;

use App\Models\Formulario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class FormularioExport implements FromCollection, WithHeadings, WithStyles
{

    public function collection() {
        return Formulario::with('institucion')->get()->map(function ($registro){
            return [
                'id' => $registro->id,
                'cei' => $registro->cei,
                'nombres' => $registro->name,
                'apellidos' => $registro->lastname,
                'telefono' => $registro->phone_number,
                'correo' => $registro->email,
                'direaccion' => $registro->address,
                'barrio' => $registro->neighborhood,
                'semestre' => $registro->semester,
                'paralelo' => $registro->grade,
                'jornada' => $registro->daytrip,
                'institucion' => $registro->institucion->name ?? 'Sin Asignar.',
                'dir_institucion' => $registro->institucion->address,
            ];
        });
    }

    public function headings(): array {
        return [
            'ID',
            'CEI',
            'Nombres',
            'Apellidos',
            'Teléfono',
            'Email',
            'Dirección',
            'Barrio',
            'Semestre',
            'Grado',
            'Jornada',
            'Institución',
            'Dirección de la Institución'
        ];
    }

    public function styles(Worksheet $sheet){

        $lastRow = $sheet->getHighestRow();
        
        $sheet->getStyle('A1:M1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '114e7b'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
        ]);

        $sheet->getStyle('A')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
        ]);

        for ($row = 2; $row <= $lastRow ; $row++) { 
            $fillColor = $row % 2 === 0 ? 'e2f0fc' : 'bfe0f8';

            $sheet->getStyle("A{$row}:M{$row}")->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $fillColor],
                ],
            ]);
        }

        $sheet->getStyle('A1:M' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF']
                ]
            ],
        ]);

        $sheet->setAutoFilter($sheet->calculateWorksheetDimension());

    }
}
