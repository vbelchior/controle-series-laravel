<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovaSerie extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $qtd_temporadas;
    public $qtdEpisodios;

    public function __construct($nome,$qtd_temporadas,$qtdEpisodios)
    {
        $this->nome = $nome;
        $this->qtd_temporadas = $qtd_temporadas;
        $this->qtdEpisodios = $qtdEpisodios;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.serie.nova-serie');
    }
}
