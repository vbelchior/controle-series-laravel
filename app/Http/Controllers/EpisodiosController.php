<?php

namespace App\Http\Controllers;

use App\Models\{Temporada, Episodio};
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request){
        $mensagem = $request->session()->get('mensagem');


        return view('episodios.index', [
            'episodios' => $temporada->episodios,
            'temporadaId' => $temporada->id,
            'mensagem' => $mensagem
        ]);
    }

    public function assistir(Temporada $temporada , Request $request){

        $episodiosAssistidos = $request->episodios;

        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos) {
            $episodio->assistido = in_array(
                $episodio->id , $episodiosAssistidos
                );
            });
        $temporada->push();

        $request->session()
        ->flash(
            'mensagem',
            "Episódios alterados com sucesso."
        );
        return redirect()->back();

    }
}
