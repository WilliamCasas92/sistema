<?php

namespace App\Notifications;

use App\ProcesoContractual;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CambioEtapa extends Notification
{
    use Queueable;
    protected $procesoContractual;
    protected $nombre_etapa_anterior;

    public function __construct(ProcesoContractual $procesoContractual, $nombre_etapa_anterior, $roles)
    {
        $this->proceso_contractual = $procesoContractual;
        $this->nombre_etapa_anterior = $nombre_etapa_anterior;
        $this->roles = $roles;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('sigecop@elpoli.edu.co', 'SIGECOP')
                    ->subject('[SIGECOP] Nuevo proceso con CDP: '.$this->proceso_contractual->numero_cdp.'.')
                    ->success()
                    ->line('SIGECOP te informa que existe un nuevo proceso contractual en la etapa de '.$this->proceso_contractual->estado.'. 
                        La persona encargada debe proceder a diligenciar la información.')
                    ->line('Tipo de contratación: '.$this->proceso_contractual->tipo_proceso.'.')
                    ->line('CDP: '.$this->proceso_contractual->numero_cdp.'.')
                    ->line('Objeto: '.$this->proceso_contractual->objeto.'.')
                    ->line('Etapa de la que proviene: '.$this->nombre_etapa_anterior.'.')
                    ->line('Puedes acceder a diligenciar el proceso debido a que posees los siguientes roles: '. $this->roles)
                    ->line('')
                    ->action('¡Diligenciar ahora!', 'http://policontratos.app/datosetapas/'.$this->proceso_contractual->id);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
