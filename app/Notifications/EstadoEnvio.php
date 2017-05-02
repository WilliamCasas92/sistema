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

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ProcesoContractual $procesoContractual)
    {
        $this->proceso_contractual = $procesoContractual;
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
            //->from('sigecop@elpoli.edu.co', 'SIGECOP')
            ->subject('[SIGECOP] Nuevo proceso CDP: '.$this->proceso_contractual->numero_cdp)
            ->success()
            ->line('Existe un nuevo proceso en la etapa '. $this->proceso_contractual->estado.' con los datos: ')
            ->line('Tipo contratación: '.$this->proceso_contractual->tipo_proceso)
            ->line('CDP: '.$this->proceso_contractual->numero_cdp)
            ->line('Objeto: '.$this->proceso_contractual->objeto)
            ->line('El proceso fue enviado ha Adquisiciones')
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
