<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ApplicationDetail;
use App\Models\UserData;
use Illuminate\Support\Facades\Auth;

class ProgresController extends Controller
{
    public function index()
    {
        $authUser = Auth::user()->load([
            'profile.userData' => function ($query) {
                $query->with(['careers', 'profiles']);
            },
            'profile.userData.applicationDetail' => function ($query) {
                $query->with(['applicationCalls', 'receivingEntities'])
                    ->orderBy('created_at', 'desc');
            }
        ]);

        // Validación de datos básicos
        $user = $authUser->profile ?? null;
        $userData = $user->userData ?? null;

        // Obtener aplicación si existe
        $appDetail = $userData->applicationDetail?->first() ?? null;

        $currentPeriod = $appDetail->applicationCalls ?? null;

        // Validar si hay aplicación antes de construir timeline
        $timeline = [];
        if ($appDetail) {
            $timeline = [
                [
                    'title' => 'Postulación enviada',
                    'date' => $appDetail->created_at->format('Y-m-d') ?? '2025-05-05',
                    'description' => 'Postulacion enviada a ' . ($appDetail->receivingEntities->name ?? 'institución no especificada'),
                ],
                [
                    'title' => 'Aceptado por institución',
                    'date' => $appDetail->approval_date ?? '2025-05-10',
                    'description' => $appDetail->approval_date
                        ? 'La institución aprobó tu postulación.'
                        : 'Esperando aprobación de la institución.',
                ],
            ];
        }

        return view('dashboard.my-progres.index', [
            'user' => $user,
            'currentPeriod' => $currentPeriod,
            'application' => $appDetail,
            'documents' => null,
            'finalGrade' => null,
            'timeline' => $timeline,
        ]);
    }
}
