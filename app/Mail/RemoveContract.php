<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveContract extends Mailable
{
    use Queueable, SerializesModels;

    private $contract;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contract)
    {
        $this->contract = $contract;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@deutsch-kurs-hannover.com')
            ->view('emails.removeContract')->with(['contract'=>$this->contract])
            ->subject('The contract has been deleted');
    }
}
