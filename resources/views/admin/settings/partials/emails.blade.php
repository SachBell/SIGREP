@php
    $templates = \App\Models\EmailTemplate::all()->keyBy('key');
@endphp

<div class="space-y-6">
    @foreach ($templates as $key => $template)
        <form method="POST" action="{{ route('settings.emailsUpdate') }}"
            class="max-w-4xl bg-white border rounded shadow-md p-4">
            @csrf
            @method('PUT')

            <input type="hidden" name="key" value="{{ $template->key }}">

            <h2 class="text-lg font-semibold mb-2">
                @if ($key === 'tutor_assignment_student')
                    Asignación de Tutor - Estudiante
                @elseif($key === 'tutor_assignment_teacher')
                    Asignación de Tutor - Docente
                @elseif($key === 'visit_assignment')
                    Asignación de Visita
                @elseif($key === 'call_opening')
                    Aviso de Apertura de Convocatoria
                @endif
            </h2>
            <p class="text-sm text-slate-500 mb-4">
                {{ $template->description }}
            </p>

            <div class="mb-4">
                <x-input-label for="subject_{{ $template->key }}" value="Asunto del correo" />
                <x-text-input id="subject_{{ $template->key }}" name="subject" type="text" class="mt-1 block w-full"
                    value="{{ old('subject', $template->subject) }}" />
            </div>

            <div class="mb-4">
                <x-input-label for="body_{{ $template->key }}" value="Cuerpo del correo" />
                <textarea id="body_{{ $template->key }}" name="body" rows="4"
                    class="textarea w-full border border-gray-300 rounded p-2 shadow-sm focus:border-blue-700 focus:ring-blue-600">{{ old('body', $template->body) }}</textarea>

                <p class="text-xs text-slate-400 mt-1">
                    Variables disponibles:
                    @if ($key === 'tutor_assignment_student')
                        <code>{student_name}</code>, <code>{tutor_name}</code>, <code>{career}</code>
                    @elseif($key === 'tutor_assignment_teacher')
                        <code>{tutor_name}</code>, <code>{students_list}</code>
                    @elseif($key === 'visit_assignment')
                        <code>{student_name}</code>, <code>{visit_number}</code>, <code>{visit_date}</code>,
                        <code>{visit_time}</code>
                    @elseif($key === 'call_opening')
                        <code>{student_name}</code>, <code>{call_title}</code>, <code>{deadline}</code>
                    @endif
                </p>
            </div>

            <div class="text-end">
                @if (session()->has('success_' . $template->key))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-2"
                        style="display: none;">
                        <span class="text-sm text-green-600">{{ session('success_' . $template->key) }}</span>
                    </div>
                @endif
                <button type="submit"
                    class="btn btn-md h-auto py-1.5 bg-blue-800 text-white border border-none hover:bg-blue-900">
                    Guardar
                </button>
            </div>
        </form>
    @endforeach
</div>
