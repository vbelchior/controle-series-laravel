<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SeriesFormRequest;

use  App\Models\{Serie,User};

use  App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;

use App\Events\NovaSerie;

class SeriesController extends Controller
{

    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');

        return view(view: 'series.index', data: [
            'series' => $series,
            'mensagem' => $mensagem
        ]);
    }


    public function create()
    {
        return view(view: 'series.create');
    }

    public function store(
        SeriesFormRequest $request,
        CriadorDeSerie $criadorDeSerie)
    {

        $capa=null;

        if($request->hasFile('capa')){
           $capa =  $request->file('capa')->store('serie');
        }

        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada,
            $capa
        );

        $eventoNovaSerie = new NovaSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );

        event($eventoNovaSerie);

        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->nome} com id {$serie->id} criada com sucesso !"
            );

        return redirect()->route('listar_series');
    }

    public function destroy(
        Request $request,
        RemovedorDeSerie $removedorDeSerie
        )
    {

        $nomeSerie = $removedorDeSerie->excluirSerie($request->id);

        $request->session()
        ->flash(
            'mensagem',
            "Série $nomeSerie apagada com sucesso !"
        );
        return redirect()->route('listar_series');

    }

    public function edit(int $id ,Request $request)
    {
        $novoNome = $request->nome;

        $serie = Serie::find($id);
        $serie->nome = $novoNome;

        $serie->save();

    }



}
