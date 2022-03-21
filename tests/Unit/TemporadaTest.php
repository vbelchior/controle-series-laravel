<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Temporada,Episodio};

class TemporadaTest extends TestCase
{

    /** @var Temporada */
    private $temporada;


    protected function setUp():void{
        parent::setUp();

        $temporada = new Temporada();

        $episodio1 = new Episodio();
        $episodio1->assistido = true ;
        $episodio2 = new Episodio();
        $episodio2->assistido = false ;
        $episodio3 = new Episodio();
        $episodio3->assistido = true ;
        $episodio4 = new Episodio();
        $episodio4->assistido = false ;

        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);
        $temporada->episodios->add($episodio4);

        $this->temporada = $temporada;

    }

    public function testBuscarPOrEpisodiosAssistido()
    {

        $episodiosAssistidos =  $this->temporada->getEpisodiosAssistidos();

        $this->assertCount(2,$episodiosAssistidos);

        foreach($episodiosAssistidos as $episodio){
            $this->assertTrue($episodio->assistido);
        }
    }

    public function testeBuscaTodosOsEpisodios(){

        $episodios = $this->temporada->episodios;
        $this->assertCount(4,$episodios);
    }
}
