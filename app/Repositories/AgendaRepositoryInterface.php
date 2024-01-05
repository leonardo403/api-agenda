<?php

namespace App\Repositories;

use App\Http\Requests\AgendaRequest;

interface AgendaRepositoryInterface
{
    public function index();
    public function showAgenda(int $agenda_id);
    public function createAgenda(AgendaRequest $request);
    public function updateAgenda(AgendaRequest $request, int $agenda_id);
    public function deleteAgenda(int $agenda_id);
}
