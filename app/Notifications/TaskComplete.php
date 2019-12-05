<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskComplete extends Notification
{
    use Queueable;

    public function __construct()
    {
       
    }

    public function via($notifiable)
    {
        // return ['mail'];
        return ['database'];
    }

    public function toMail($notifiable)
    {
        //return (new MailMessage)->view('invoice',['user' => $this->user]);
                   
    }

    public function toArray($notifiable)
    {
        return [
           'data' => 'This is my first notification'
        ];
    }
}
