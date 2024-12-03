<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verifica tu correo electrónico')
            ->line('Por favor, haz clic en el botón de abajo para verificar tu dirección de correo electrónico.')
            ->action('Verificar correo', $this->verificationUrl($notifiable))
            ->line('Si no creaste esta cuenta, ignora este correo.');
    }
}
