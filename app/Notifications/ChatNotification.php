<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChatNotification extends Notification
{
    use Queueable;
    private $details;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    { 
        // return ['mail','database'];
        return ['database'];
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
                    ->subject('Notification Subject')
                    ->greeting($this->details['greeting'])
                    ->line($this->details['body'])
                    ->action($this->details['actionText'], $this->details['actionURL'])
                    ->line($this->details['thanks']);
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
            'greeting' => $this->details['greeting'],
            'data' =>  $this->details['body'],
            'datawith' => $this->details['body']. ":- ".$this->details['main_id'],
            'notify_type' => '2',
            'actionURL' => $this->details['actionURL'],
            'main_id' => $this->details['main_id']
         ];
    }
}
