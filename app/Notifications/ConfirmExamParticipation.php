<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmExamParticipation extends Notification
{
    use Queueable;


    private $exam_contrainter;
    private $file_path;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($exam_contrainter, $file_path)
    {
        $this->exam_contrainter = $exam_contrainter;
        $this->file_path = $file_path;
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
            ->line('Your confrim exam participation file was attached to this e-mail letter')
            ->attach($this->file_path, [
                'as' => 'ConfirmExamParticipation.pdf',
                'mime' => 'application/pdf',
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
