<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\{RemovedorDeSerie, CriadorDeSerie};
use App\Models\Serie;

class RemovedorDeSerieTest extends TestCase
{
    /** @var Serie */
    private $serie;

    use RefreshDatabase;


    protected function setUp():void{
        parent::setUp();

        $criadorDeSerie = new CriadorDeSerie();
        $this->serie = $criadorDeSerie->criarSerie(
            'Nome da série',
            1,
            1
        );

    }

    public function testeRemoverUmaSerie()
    {
        $removedorDeSerie = new RemovedorDeSerie();
        $nomeSerie = $removedorDeSerie->excluirSerie($this->serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nome da série',$nomeSerie);
        $this->assertDatabaseMissing(
                'series',
                ['id' => $this->serie->id]
            );

    }
}
