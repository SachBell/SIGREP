<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationBanner extends Component
{
    public $message = '';
    public $type = 'success';
    public $visible = false;

    public function mount()
    {
        if (session()->has('notification')) {
            $data = session('notification');
            $this->type = $data['type'] ?? 'success';
            $this->message = $data['message'] ?? '';
            $this->visible = true;

            // Temporizador de cierre automático
            $this->dispatchBrowserEvent('start-notification-timer');
        }
    }

    public function render()
    {
        return view('livewire.notification-banner');
    }
}
