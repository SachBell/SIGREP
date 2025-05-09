<?php

namespace App\Http\Controllers;

use App\Models\ApplicationDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $usuario = ApplicationDetails::with('userData.semesters', 'institutes')->findOrFail($id);

        // Mapeo para corregir los nombres cuando sea necesario
        $conversionSemestres = [
            'Primero' => 'Primer',
            'Segundo' => 'Segundo',
            'Tercero' => 'Tercer',
            'Cuarto' => 'Cuarto',
            'Quinto' => 'Quinto',
            'Sexto' => 'Sexto',
            'Séptimo' => 'Séptimo',
            'Octavo' => 'Octavo',
            'Noveno' => 'Noveno',
            'Décimo' => 'Décimo'
        ];

        // Obtener el nombre del semestre desde la relación
        $semestreNombre = optional($usuario->userData->semesters)->semester ?? 'Semestre No Asignado';

        // Aplicar la conversión si el nombre está en el array
        $usuario->semestre_ordinal = $conversionSemestres[$semestreNombre] ?? $semestreNombre;

        // Generar el PDF con la vista
        $pdf = Pdf::loadView('pdf.solicitud_practicas', compact('usuario'))
            ->setPaper('a4')
            ->setOption('isPhpEnabled', true)
            ->setOption('header-right', 'Página {PAGE_NUM} de {PAGE_COUNT}');

        $pdf->getCanvas()->page_text(437, 79.8, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 8, [0, 0, 0]);

        return $pdf->stream('Solicitud_Practicas' . '_' . $usuario->userData->name .  '_' . $usuario->userData->lastname . '.pdf');
        // return $pdf->download('Solicitud_Practicas.pdf');
    }
}
