<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Bus\Queueable;

class TanggalSelesaiNotification extends Notification
{
    use Queueable;

    protected $tanggalSelesai;

    public function __construct($tanggalSelesai)
    {
        $this->tanggalSelesai = $tanggalSelesai;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'tanggal_selesai' => $this->tanggalSelesai,
            'message' => 'Pemberitahuan: Tanggal selesai Anda adalah ' . $this->tanggalSelesai
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Pemberitahuan: Tanggal selesai Anda adalah ' . $this->tanggalSelesai)
            ->action('Lihat Profil', url('/profile'))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }
}
