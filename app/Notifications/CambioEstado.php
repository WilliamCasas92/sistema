<?php

namespace App\Notifications;

use App\ProcesoContractual;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CambioEstado extends Notification
{
    use Queueable;

    protected $procesoContractual;

    public function __construct(ProcesoContractual $procesoContractual)
    {
        $this->proceso_contractual =$procesoContractual;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('sigecop@elpoli.edu.co', 'SIGECOP')
            ->subject('[SIGECOP] Cambio de estado en el proceso con CDP: '.$this->proceso_contractual->numero_cdp.'.')
            ->success()
            ->line('SIGECOP te informa que el proceso con CDP '.$this->proceso_contractual->numero_cdp.' se le ha actualizado su estado a: '.$this->proceso_contractual->estado.'.')
            ->line('Tipo contratación: '.$this->proceso_contractual->tipo_proceso.'.')
            ->line('Objeto: '.$this->proceso_contractual->objeto.'.')
            ->line('')
            ->action('Ir a SIGECOP', 'http://sigecop.elpoli.edu.co/');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
