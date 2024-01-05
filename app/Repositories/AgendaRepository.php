<?php

namespace App\Repositories;

use App\Models\Agenda;
use App\Http\Requests\AgendaRequest;
use App\Http\Resources\V1\AgendaResource;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

class AgendaRepository implements AgendaRepositoryInterface
{
    use HttpResponse;
    protected $model;

    public function __construct(Agenda $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return AgendaResource::collection(Agenda::with('user')->get());
    }

    public function createAgenda(AgendaRequest $request)
    {
        if (!auth()->user()->tokenCan('agenda-store')) {
            return $this->error('Não autorizado', HttpStatusCode::HTTP_FORBIDDEN, $request);
        }

        try {

        $agenda = Agenda::create($request->all());
        return response()->json('Agenda criada com sucesso!', HttpStatusCode::HTTP_OK);

        } catch (\Exception $ex) {
            return $ex->getMessage().' - '.HttpStatusCode::HTTP_BAD_REQUEST;
        }

    }

    public function showAgenda($agenda_id)
    {
        return Agenda::findOrFail($agenda_id);
    }

    public function updateAgenda(AgendaRequest $request, int $agenda_id)
    {
        try {
            $agenda = Agenda::findOrFail($id);
            $agenda->update($request->all());
            return response()->json('Agenda atualizada com sucesso!', HttpStatusCode::HTTP_OK);
        } catch (\Exception $ex) {
            return $ex->getMessage().' - '.HttpStatusCode::HTTP_BAD_REQUEST;
        }
    }

    public function deleteAgenda(int $agenda_id)
    {
        try {

        $agenda = Agenda::findOrFail($agenda_id);
        $agenda->delete();
        return response()->json([
            "message" => "Agenda foi removida!"],HttpStatusCode::HTTP_NO_CONTENT);

    } catch (\Exception $ex) {
            return $ex->getMessage().' - '.HttpStatusCode::HTTP_BAD_REQUEST;
        }
    }

    public function rangeData(AgendaRequest $request)
    {
        $data_inicio = $request->input('data_inicio');
        $data_conclusao = $request->input('data_conclusao');

        return $agenda = Agenda::query()
               ->whereDate('created_at','>=', $data_inicio)
               ->whereDate('created_at','<=', $data_conclusao)
               ->get();
    }
}
