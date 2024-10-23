<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormularioCompleto extends Mailable
{
    use Queueable, SerializesModels;

    public $completo, $periodo;

    public function __construct($completo, $periodo)
    {
        $this->completo = $completo;
        $this->periodo = $periodo;
    }


    public function build()
    {
        return $this->view('mails.envio_mail_completo');
    }
}
