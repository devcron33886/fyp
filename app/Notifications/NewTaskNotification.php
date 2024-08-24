<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTaskNotification extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task)
    {
        return $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->from($this->task->supervisor->email)
            ->subject($this->task->project->title.' task has been assigned to you')
            ->greeting('Dear '.$this->task->assigned_to->name.',')
            ->line('A new task has been assigned to you by '.$this->task->supervisor->name.' you can now access your tasks page with your team member and discuss about it.')
            ->line('Task Title: '.$this->task->title)
            ->action('View Task', url('/admin/tasks/'.$this->task->id))
            ->line('Warm Regards,');
    }
}
