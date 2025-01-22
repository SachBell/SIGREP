@section('title', 'Postularse')
<x-crud-layout>
    <div class="container">
        <h2>Formulario de postulación</h2>

        <p><b>Convocatoria:</b> {{ $application->application_title }}</p>
        <p><b>Periodo:</b> {{ $application->start_date }} - {{ $application->end_date }}</p>

        <form action="{{ route('user.form-register.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_application_calls" value="{{ $application->id }}">

            <div class="form-group">
                <label for="user_name">Estudiante:</label>
                <input type="text" class="form-control" id="user_name" value="{{ $user->name ?? '' }}" readonly>
            </div>

            <div class="form-group">
                <label for="id_institute">Selecciona la institución:</label>
                <select name="id_institute" id="id_institute" class="form-control" required>
                    @foreach ($institutes as $institute)
                        <option value="{{ $institute->id }}">
                            {{ $institute->name }} - {{ $institute->address }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mobile container-fluid d-flex justify-content-center gap-2">
                <button type="submit" class="btn btn-primary">Registrar Postulación</button>
                <a href="{{ route('user.dashboard') }}" class="mobile btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-crud-layout>
