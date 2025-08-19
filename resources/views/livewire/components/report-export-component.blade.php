<div>
    @role('admin')
        <!-- Select de carrera -->
        <div class="mb-4">
            <x-input-label for="career_id" value="Carrera" />
            <select wire:model="career_id" name="career_id" class="select">
                <option value="">Seleccione carrera</option>
                @foreach ($careers as $career)
                    <option value="{{ $career->id }}">{{ $career->name }}</option>
                @endforeach
            </select>
        </div>
    @endrole

    <!-- Select de convocatoria -->
    <div class="mb-4">
        <x-input-label for="call_id" value="Convocatoria" />
        <select wire:model="call_id" name="call_id" class="select">
            <option value="">Seleccione convocatoria</option>
            @foreach ($calls as $call)
                <option value="{{ $call->id }}">{{ $call->name }} - {{ $call->start_date }}</option>
            @endforeach
        </select>
    </div>

    <!-- Select de tipo de informe -->
    <div class="mb-4">
        <x-input-label for="report_type" value="Tipo de Informe" />
        <select wire:model="report_type" name="report_type" class="select" required>
            <option value="">Seleccione tipo</option>
            <option value="general">Informe General</option>
            <option value="teacher">Informe por Docente Tutor</option>
            <option value="student">Informe por Estudiante</option>
        </select>
    </div>

    <!-- Selects dinámicos -->
    @if ($report_type === 'teacher')
        <div class="mb-4">
            <x-input-label for="tutor_id" value="Seleccione Tutor" />
            <select name="tutor_id" class="select" required>
                <option value="">Seleccione tutor</option>
                @foreach ($tutors as $tutor)
                    <option value="{{ $tutor->id }}">{{ $tutor->user->name ?? 'Sin nombre' }}</option>
                @endforeach
            </select>
        </div>
    @elseif ($report_type === 'student')
        <div class="mb-4">
            <x-input-label for="student_id" value="Seleccione Estudiante" />
            <select name="student_id" class="select" required>
                <option value="">Seleccione estudiante</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name ?? 'Sin nombre' }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>
