<?php

namespace App\Services;

use App\Repositories\AgendaRepository;
use App\Http\Requests\AgendaRequest;

class AgendaService
{
    protected $agendaRepository;

    public function __construct(AgendaRepository $agendaRepository)
    {
        $this->agendaRepository = $agendaRepository;
    }

    public function showAgenda(int $agenda_id)
    {
        return $this->agendaRepository->showAgenda($agenda_id);
    }

    public function createAgenda(AgendaRequest $request)
    {
        return $this->agendaRepository->createAgenda($request);
    }

    public function updateAgenda(AgendaRequest $request, int $agenda_id)
    {
        return $this->agendaRepository->updateAgenda($request, agenda_id);
    }

    public function deleteAgenda(int $agenda_id)
    {
        return $this->agendaRepository->deleteAgenda($agenda_id);
    }

}
