<?php

namespace App\Http\Livewire\Modals;

use App\Helpers\EmailTemplateHelper;
use App\Mail\ConvocatoriaMail;
use App\Models\ApplicationCall;
use App\Models\User;
use App\Notifications\ConvocatoriaNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;

class CallModal extends GlobalModal
{
    use AuthorizesRequests;

    public $callId;
    public $name;
    public $start_date;
    public $end_date;
    public $career;

    public $listeners = [
        'openCreate',
        'openEdit',
        'delete',
    ];

    public function mount($callId = null)
    {
        $this->callId = $callId;

        if ($callId) {
            $call = ApplicationCall::findOrFail($callId);
            $this->name = $call->name;
            $this->start_date = $call->start_date;
            $this->end_date = $call->end_date;
            $this->career = $call->career_id;
        }
    }

    public function modelClass(): string
    {
        return ApplicationCall::class;
    }

    public function rules()
    {
        $user = auth()->user();
        $unique = 'unique:application_calls,name';
        if ($this->entityID) {
            $unique .= ',' . $this->entityID;
        }

        $rules = [
            'formData.name' => ['required', 'string', 'max:255', $unique],
            'formData.start_date' => ['required', 'date'],
            'formData.end_date' => ['required', 'date', 'after_or_equal:formData.start_date'],
        ];

        if ($user->hasRole('admin')) {
            $rules['formData.career_id'] = ['required', 'exists:careers,id'];
        }

        return $rules;
    }

    public function authorizeAction($action, $model = null)
    {
        if ($model) {
            $this->authorize($action, $model);
        } else {
            $this->authorize($action, ApplicationCall::class);
        }
    }

    public function save()
    {
        $user = auth()->user();

        $this->validate();

        if (!$user->hasRole('admin')) {
            $this->formData['career_id'] = $user->getCareerIdForScope();
        }

        if ($this->entityID) {
            $call = ApplicationCall::findOrFail($this->entityID);
            $call->update($this->formData);
        } else {

            $call = ApplicationCall::create($this->formData);

            $this->notifyStudentsOfNewCall($call);
        }

        if ($this->entityID) {
            $this->emitTo('filters.call-card-filter', 'refreshTutorFilter');
        } else {
            $this->redirectAfterSave();
        }

        $this->closeModal();
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'message' => $this->entityID ? 'Convocatoria actualizada exitosamente.' : 'Convocatoria creada exitosamente.'
        ]);
    }

    public function redirectAfterSave(): ?string
    {
        return $this->redirectRoute('app-calls.index');
    }

    public function delete($id)
    {
        $call = ApplicationCall::findOrFail($id);

        $this->authorize('delete', $call);

        $call->delete();

        $this->emitTo('filters.call-card-filter', 'refreshTutorFilter');

        $this->dispatchBrowserEvent('notify', [
            'type' => 'error',
            'message' => 'Convocatoria eliminada exitosamente'
        ]);
    }

    public function render()
    {
        return view('livewire.modals.call-modal');
    }

    protected function notifyStudentsOfNewCall(ApplicationCall $call)
    {
        $template = EmailTemplateHelper::get('call_opening');
        if (!$template) {
            return;
        }

        $students = User::role('student')
            ->whereHas('profile.UserData', function ($query) use ($call) {
                $query->where('career_id', $call->career_id);
            })->get();

        foreach ($students as $student) {
            $subject = EmailTemplateHelper::renderSubject('call_opening', [
                'student_name' => $student->profile->name,
                'call_title' => $call->name,
                'deadline' => $call->end_date,
            ]);

            $body = EmailTemplateHelper::renderBody('call_opening', [
                'student_name' => $student->profile->name,
                'call_title' => $call->name,
                'deadline' => $call->end_date,
            ]);

            $actionText = EmailTemplateHelper::renderAction('call_opening', [
                'student_name' => $student->profile->name,
                'call_title' => $call->name,
            ]);

            // Enviar usando el Mailable
            Mail::to($student->email)->send(
                new ConvocatoriaMail(
                    $subject,
                    $body,
                    route('applications.index'),
                    $actionText,
                    $student->profile->name
                )
            );
        }
    }
}
