<?php

namespace App\Notifications;

use App\Models\Conversation;
use App\Models\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewConversationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Topic $topic,
        public Conversation $conversation
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('New conversation has been created inside topic ' . $this->topic->name)
            ->action('Open the conversation', url('/conversations/' . $this->conversation->id))
            ->line('Thank you for using our application!');
    }



    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'conversation_id' => $this->conversation->id,
            'conversation_title' => $this->conversation->title,
            'conversation_description' => $this->conversation->description,
            'topic_id' => $this->topic->id,
            'topic_name' => $this->topic->name,
            'topic_description' => $this->topic->description,
            'user_name' => $this->conversation->user->name,
        ];
    }
}
