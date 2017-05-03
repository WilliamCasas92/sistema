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
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ProcesoContractual $procesoContractual, $nombre_etapa_anterior, $roles)
    {
        $this->proceso_contractual = $procesoContractual;
        $this->nombre_etapa_anterior = $nombre_etapa_anterior;
        $this->roles = $roles;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    // ->from('adquisicionespolitecnicojic@gmail.com', 'SIGECOP')
                    ->subject('[SIGECOP] Nuevo proceso CDP: '.$this->proceso_contractual->numero_cdp)
                    ->success()
                    ->line('Existe un nuevo proceso en la etapa '. $this->proceso_contractual->estado.' con los datos: ')
                    ->line('Tipo contratación: '.$this->proceso_contractual->tipo_proceso)
                     ->line('CDP: '.$this->proceso_contractual->numero_cdp)
                    ->line('Objeto: '.$this->proceso_contractual->objeto)
                    ->line('Etapa anterior: '.$this->nombre_etapa_anterior)
                    ->line('Funciones que tiene asociados en esta etapa: '. $this->roles)
                    ->line('')
                    ->action('Ingresar al sistema', 'http://sigecop.elpoli.edu.co/');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
