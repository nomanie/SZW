<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends VerifyEmailBase implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(env('MAIL_USERNAME'))
            ->subject(__('Weryfikacja konta'))
            ->line('Aby zweryfikować swoje kotno naciśnij przycisk poniżej.')
            ->action(__('Weryfikuj'), $this->verificationUrl($notifiable))
            ->line(__('Jeśli to nie Ty stworzyłeś konto w Naszym serwisie, nie wykonuj żadnej akcji, i usuń wiadomość.'));
    }
}
