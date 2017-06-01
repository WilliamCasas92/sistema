<?php

namespace App\Notifications;

use App\ProcesoContractual;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EstadoEnvio extends Notification
{
    use Queueable;

    protected $procesoContractual;


    public function __construct(ProcesoContractual $procesoContractual)
    {
        $this->proceso_contractual = $procesoContractual;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('sigecop@elpoli.edu.co', 'SIGECOP')
            ->subject('[SIGECOP] Nuevo proceso con CDP: '.$this->proceso_contractual->numero_cdp.'. En el Área de Adquisiciones.')
            ->success()
            ->line('SIGECOP te informa que existe un nuevo proceso contractual en el Área de Adquisiciones. 
                Debes ingresar a SIGECOP y atender el proceso.')
            ->line('Estado actual: '. $this->proceso_contractual->estado.'.')
            ->line('Tipo de contratación: '.$this->proceso_contractual->tipo_proceso.'.')
            ->line('CDP: '.$this->proceso_contractual->numero_cdp.'.')
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
