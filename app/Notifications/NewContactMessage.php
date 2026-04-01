<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewContactMessage extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;

    public function __construct(ContactMessage $message)
    {
        $this->message = $message;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('New Contact Message: ' . $this->message->subject)
            ->greeting('Hello Admin!')
            ->line('You have received a new contact message from ' . $this->message->name)
            ->line('Subject: ' . $this->message->subject)
            ->line('Message:')
            ->line($this->message->message)
            ->action('View Message', url('/admin/contact/message/' . $this->message->id))
            ->line('Thank you for using our website!');
    }

    public function toArray($notifiable): array
    {
        return [
            'message_id' => $this->message->id,
            'name' => $this->message->name,
            'email' => $this->message->email,
            'subject' => $this->message->subject,
        ];
    }
}
