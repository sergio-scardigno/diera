<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormularioIncompleto extends Mailable
{
    use Queueable, SerializesModels;
    public $incompleto, $periodo;

    public function __construct($incompleto, $periodo)
    {
        $this->incompleto = $incompleto;
        $this->periodo = $periodo;
    }


    public function build()
    {
        return $this->view('mails.envio_mail_incompleto');
    }
}
