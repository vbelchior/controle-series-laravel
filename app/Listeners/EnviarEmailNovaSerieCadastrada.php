<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

use  App\Models\{User};


class EnviarEmailNovaSerieCadastrada  implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $nomeSerie = $event->nomeSerie;
        $qtd_temporadas = $event->qtd_temporadas;
        $ep_por_temporada =$event->ep_por_temporada;

        $users = User::all();
        foreach ($users as $index => $user) {

            $multiplicador = $index + 1;
            $email = new  \App\Mail\NovaSerie(
                $nomeSerie,
                $qtd_temporadas,
                $ep_por_temporada
            );
            $email->subject = 'Nova Série Adicionada';

            $when = now()->addSeconds( $multiplicador * 10);

            Mail::to($user)->later($when,$email);

        }

    }
}
