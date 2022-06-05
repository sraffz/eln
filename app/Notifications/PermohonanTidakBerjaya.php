<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PermohonanTidakBerjaya extends Notification
{
    use Queueable;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $butiran;

    public function __construct($butiran)
    {
       $this->butiran=$butiran;        
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
        $negara = $this->butiran['negara'];
        $tarikhMulaPerjalanan = $this->butiran['tarikhMulaPerjalanan'];
        $tarikhAkhirPerjalanan = $this->butiran['tarikhAkhirPerjalanan'];
        $nama = $this->butiran['nama'];
        $nokp = $this->butiran['nokp'];
        
        // return (new MailMessage)->markdown('mail.permohonan.berjaya', [
        //     'negara' => $negara,
        //     'tarikhMulaPerjalanan' => $tarikhMulaPerjalanan,
        //     'tarikhAkhirPerjalanan' => $tarikhAkhirPerjalanan,
        //     'nama' => $nama,
        //     'nokp' => $nokp,
        // ]);     
        return (new MailMessage)->markdown('mail.permohonan.gagal', [
            'negara' => $negara,
            'tarikhMulaPerjalanan' => $tarikhMulaPerjalanan,
            'tarikhAkhirPerjalanan' => $tarikhAkhirPerjalanan,
            'nama' => $nama,
            'nokp' => $nokp,
        ]); 
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
