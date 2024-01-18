<?php

namespace App\Services;

use App\Http\Requests\AgendaRequest;
use App\Repositories\AgendaRepositoryInterface;

class AgendaService
{
    protected $agendaRepository;

    public function __construct(AgendaRepositoryInterface $agendaRepository)
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
