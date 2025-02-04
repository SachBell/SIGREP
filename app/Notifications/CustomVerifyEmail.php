<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return $this->buildMailMessage($verificationUrl, $notifiable);
    }

    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url, $notifiable)
    {
        return (new MailMessage)
            ->subject(__('emails.verify.verify_subject'))
            ->greeting(__('emails.verify.greeting_title', ["name" => $notifiable->name]))
            ->line(__('emails.verify.verify_line'))
            ->action(__('emails.verify.verify_button'), $url)
            ->line(__('emails.verify.verify_footer'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        // Crear la URL firmada para la verificación
        return URL::temporarySignedRoute(
            'verification.verify', // Nombre de la ruta
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)), // Tiempo de expiración
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()), // Hash del email para verificar
            ]
        );
    }
}
