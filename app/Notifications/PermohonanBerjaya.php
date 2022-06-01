<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PermohonanBerjaya extends Notification  
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $negara;
    public $tarikhMulaPerjalanan;
    public $tarikhAkhirPerjalanan;
    public $nokp;
    public $nama;

    public function __construct($negara,$tarikhMulaPerjalanan,$tarikhAkhirPerjalanan,$nokp,$nama)
    {
       $this->negara=$negara;
       $this->tarikhMulaPerjalanan=$tarikhMulaPerjalanan;
       $this->tarikhAkhirPerjalanan=$tarikhAkhirPerjalanan;
       $this->nokp=$nokp;
       $this->nama=$nama;
        
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
            ->subject('eLuarNegara: Permohonan Keluar Negara Anda Telah Berjaya')
            ->greeting('Assalamualaikum / Selamat Sejahtera')
            ->line("Negara: $this->negara")
            ->line("Tarikh Perjalan: $this->tarikhMulaPerjalanan")
            ->line("Tarikh Kembali: $this->tarikhAkhirPerjalanan")
            ->line("Nama: $this->nama")
            ->line("No Kad Pengenalan: $this->nokp")
            ->line('Permohonan Anda Telah Berjaya.');
            // ->action('Pengesahan Pengguna', url(config('app.url')) );
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
            
        ];
    }
}
