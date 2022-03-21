<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NovaSerie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nomeSerie;
    public $qtd_temporadas;
    public $ep_por_temporada;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        string $nomeSerie,
        int $qtd_temporadas,
        int $ep_por_temporada
        )
    {
        $this->nomeSerie = $nomeSerie;
        $this->qtd_temporadas = $qtd_temporadas;
        $this->ep_por_temporada = $ep_por_temporada;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
