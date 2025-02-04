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
        $pdf = Pdf::loadView('pdf.solicitud_practicas', compact('usuario'));

        return $pdf->stream('Solicitud_Practicas'. '_' . $usuario->userData->name .  '_' . $usuario->userData->lastname .'.pdf');
        // return $pdf->download('Solicitud_Practicas.pdf');
    }
}
