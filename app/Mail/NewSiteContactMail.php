<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSiteContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newContactInfo; // essendo public è automaticamente disponibile all'interno della view

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_newContactInfo)
    {
        $this->newContactInfo = $_newContactInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Nuovo Contatto da " . $this->newContactInfo->name ) //posso personalizzare l'oggetto della mail da inviare
        ->view('mails.newSiteContact');
        //se la variabile non fosse stata public avremmo dovuto prima passarla come secondo argomento della view utilizzando un compact()
    }
}
