<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RelevamientoDIE extends Mailable
{
    use Queueable, SerializesModels;

    public $texto;

    public function __construct($texto)
    {
        $this->texto = $texto;
    }


    public function build()
    {
        return $this->view('mails.envio_mail_personalizado');
    }

}
