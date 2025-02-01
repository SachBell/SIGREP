<div>
    @if ($applicationDetails)
        <h2>Periodo de Postulación</h2>
        <p><strong>Nombre del periodo:</strong> {{ $applicationDetails->applicationCalls->application_title }}</p>
        <p><strong>Fecha de inicio y fin:</strong>
            {{ $applicationDetails->applicationCalls->start_date }} -
            {{ $applicationDetails->applicationCalls->end_date }}</p>

        <h2>Datos del Estudiante</h2>
        <p><strong>Nombre:</strong> {{ $applicationDetails->userData->name }}</p>
        <p><strong>Apellidos:</strong> {{ $applicationDetails->userData->lastname }}</p>
        <p><strong>CEI:</strong> {{ $applicationDetails->userData->cei }}</p>
        <p><strong>Teléfono:</strong> {{ $applicationDetails->userData->phone_number }}</p>
        <p><strong>Semestre:</strong> {{ $applicationDetails->userData->semesters->semester }}</p>

        <h2>Instituto</h2>
        <p><strong>Nombre:</strong> {{ $applicationDetails->institutes->name }}</p>
        <p><strong>Dirección:</strong> {{ $applicationDetails->institutes->address }}</p>

        <h2>Estado del Estudiante</h2>
        <p><strong>Estado:</strong> {{ $applicationDetails->status_individual }}</p>

        <a href="{{route('user.application-pdf.preview', $applicationDetails->id)}}">Descargar Registro</a>
    @else
        <p>No se encontraron datos para mostrar.</p>
    @endif
</div>
