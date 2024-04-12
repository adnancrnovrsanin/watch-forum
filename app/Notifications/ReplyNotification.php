<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Reply $reply
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
            ->line('You have a new reply by' . $this->reply->user->name . ' on your comment.')
            ->action('View Reply', url('/conversations/' . $this->reply->comment->conversation->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reply_id' => $this->reply->id,
            'reply_content' => $this->reply->content,
            'comment_id' => $this->reply->comment->id,
            'comment_content' => $this->reply->comment->content,
            'conversation_id' => $this->reply->comment->conversation->id,
            'conversation_title' => $this->reply->comment->conversation->title,
            'user_name' => $this->reply->user->name,
        ];
    }
}
