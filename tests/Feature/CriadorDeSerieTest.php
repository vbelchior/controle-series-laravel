<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\CriadorDeSerie;
use App\Models\Serie;

class CriadorDeSerieTest extends TestCase
{
    use RefreshDatabase;

    public function testCriarSerie()
    {
        $criadorDeSerie = new CriadorDeSerie();

        $nomeSerie = "Nome de teste";

        $serieCriada = $criadorDeSerie->criarSerie($nomeSerie,1,1);

        $this->assertInstanceOf(Serie::class, $serieCriada);
        $this->assertDatabaseHas('series',['nome' => $nomeSerie]);
        $this->assertDatabaseHas('temporadas',['serie_id' => $serieCriada->id,'numero' => 1]);
        $this->assertDatabaseHas('episodios',['numero' => 1]);

    }
}
