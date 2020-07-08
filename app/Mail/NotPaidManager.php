<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotPaidManager extends Mailable
{
    use Queueable, SerializesModels;


    private $user_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $data['user_id'] = $this->user_id;

        return $this->from('info@deutsch-kurs-hannover.com')
            ->view('emails.notPaidEmail',$data)
            ->subject('Der Student war 6 Tage lang nicht aktiv');
    }
}
