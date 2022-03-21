<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

use  App\Models\Serie;


class CriadorDeSerie{

    public function criarSerie(
        string $nomeSerie,
        int $qtd_temporadas,
        int $ep_por_temporada,
        ?string $capa
    ):Serie  {

        $serie = new Serie();

        DB::beginTransaction();
            $serie = Serie::create([
                'nome' => $nomeSerie,
                'capa' => $capa,
             ]);
            $this->criarTemporadas( $serie, $qtd_temporadas,$ep_por_temporada);
        DB::commit();

        return $serie;
    }

    private function criarTemporadas(Serie $serie ,int $qtd_temporadas,int $ep_por_temporada){
        for ($i = 1; $i <= $qtd_temporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpisodios($temporada,$ep_por_temporada);
        };

    }

    private function criarEpisodios($temporada,int $ep_por_temporada){
        for($j = 1; $j <= $ep_por_temporada; $j++){
                $temporada->episodios()->create(['numero' => $j]);
           };

    }

}
