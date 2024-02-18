<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailPautanPermohonan extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     * 
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
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
        $email = $this->data['email'];
        $id = $this->data['id'];
        $url = $this->data['url'];
        $jenis_permohonan = $this->data['jenis_permohonan'];

        return (new MailMessage)
            ->line('Berikut adalah pautan sementara bagi permohonan keluar negara yang ingin membuat permohonan kurang daripada 14 Hari. ')
            ->action('Pautan Permohonan Sementara', url($url))
            ->line('Untuk makluman, pautan ini hanya boleh diakses dalam tempoh 24 jam sahaja bermula pada waktu email ini diterima.')
            ->line('Sekian. Terima kasih.');
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
