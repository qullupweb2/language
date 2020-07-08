<?php

namespace App\Mail;

use App\Http\Services\InvoiceService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    private $contract;
    private $client;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contract, $client, $manual = false)
    {
        $this->manual = $manual;
        $this->contract = $contract;
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        InvoiceService::generateConfirmed($this->contract, $this->client, true, $this->manual);
        $data = InvoiceService::generateConfirmed($this->contract, $this->client, false, $this->manual);
   
        return $this->from('info@deutsch-kurs-hannover.com')
            ->view('admin.confirmation',$data)
            ->attach($data['file_path'])
            ->subject('Information about course');
    }
}
