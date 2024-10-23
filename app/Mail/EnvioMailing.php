<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnvioMailing extends Mailable
{
    use Queueable, SerializesModels;
    

    public $errorfind, $periodo;

    public function __construct($errorfind, $periodo)
    {
        $this->errorfind = $errorfind;
        $this->periodo = $periodo;
    }


    public function build()
    {
        return $this->view('mails.enviomail');
    }
}
