<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCall;
use App\Models\ApplicationDetail;
use App\Models\Career;
use App\Models\TeacherProfile;
use App\Models\UserData;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        // Cargar datos para selects: carreras, periodos, modalidades, tutores, etc.
        $careers = Career::all();
        $calls = ApplicationCall::all();
        $reportType = ['general', 'teacher', 'student'];

        return view('admin.reports.index', compact('careers', 'calls', 'reportType'));
    }

    public function generate(Request $request)
    {
        // Validar datos entrantes
        $request->validate([
            'career_id' => 'nullable|exists:careers,id',
            'call_id' => 'required|exists:application_calls,id',
            'report_type' => 'required|in:general,teacher,student',
            'format' => 'required|in:pdf,excel',
            'tutor_id' => 'required_if:report_type,teacher|nullable|exists:teacher_profiles,id',
            'student_id' => 'required_if:report_type,student|nullable|exists:user_data,id',
        ]);

        // Aquí va la consulta para obtener datos según tipo de informe
        switch ($request->report_type) {
            case 'general':
                $data = $this->getGeneralReportData($request);
                break;
            case 'teacher':
                $data = $this->getDocenteReportData($request);
                break;
            case 'student':
                $data = $this->getEstudianteReportData($request);
                break;
        }

        // Generar archivo según formato
        if ($request->format === 'pdf') {
            $pdf = Pdf::loadView("reports.templates.{$request->report_type}", compact('data'))
                ->setPaper('a4', 'landscape');
            return $pdf->download("informe_{$request->report_type}_" . now()->format('Ymd_His') . ".pdf");
        } else {
            // Excel
            return Excel::download(new \App\Exports\ReportExport($data, $request->report_type), "informe_{$request->report_type}_" . now()->format('Ymd_His') . ".xlsx");
        }
    }

    protected function getGeneralReportData($request)
    {
        // Obtener estudiantes que postularon en la convocatoria (application_call) y con modalidad filtrada
        return ApplicationDetail::with([
            'userData.profiles',   // perfil del estudiante
            'userData.careers',
            'receivingEntities',
            'applicationCalls',
            'userData.semesters',
            'userData.grades',
            'tutorStudent',
            'tutorStudent.finalGrade'
        ])
            ->where('application_calls_id', $request->call_id)
            ->when($request->career_id, function ($query) use ($request) {
                $query->whereHas('userData', function ($q) use ($request) {
                    $q->where('career_id', $request->career_id);
                });
            })
            ->when($request->modality, function ($query) use ($request) {
                $query->whereHas('userData.careers', function ($q) use ($request) {
                    $q->where('is_dual', $request->modality === 'dual');
                });
            })
            ->get();
    }

    protected function getDocenteReportData($request)
    {
        return TeacherProfile::with([
            'career',
            'user',
            'tutor.userData',
            'tutor.visits',
            'tutor.userData.userData.applicationDetail',
            'students'
        ])
            ->where('id', $request->tutor_id)
            ->first()
        ;
    }

    protected function getEstudianteReportData($request)
    {
        // Obtener estudiante con datos, entidad y visitas a través de aplicación
        return UserData::with([
            'profiles',
            'careers',
            'semesters',
            'grades',
            'applicationDetail.receivingEntities',
            'profiles.tutorStudents.visits',
            'profiles.tutorStudents.profiles'
        ])
            ->where('id', $request->student_id)
            ->first();
    }
}
