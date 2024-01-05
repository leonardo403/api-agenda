<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'agenda' => [
                'Id' => $this->id,
                'data_inicio' => $this->data_inicio,
                'data_prazo' => $this->data_prazo,
                'descricao' => $this->descricao,
            ]

        ];
    }
}
