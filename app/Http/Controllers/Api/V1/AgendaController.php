<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaRequest;
use App\Http\Resources\V1\AgendaResource;
use App\Models\Agenda;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class AgendaController extends Controller
{
    use HttpResponse;
    /**
* @OA\Post(
     *     path="/api/v1/agendas",
     *     summary="Lista das agendas cadastradas",     *
     *     @OA\Response(response="201", description="Retorna listagem de agendas")
     * )
     */
    public function index()
    {
        return AgendaResource::collection(Agenda::with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgendaRequest $request)
    {
        try {

        $agenda = Agenda::create($request->all());
        return response()->json('Agenda criada com sucesso!', HttpStatusCode::HTTP_OK);

    } catch (\Exception $ex) {
        return $ex->getMessage().' - '.HttpStatusCode::HTTP_BAD_REQUEST;
    }

    }

    /**
     * Display the specified resource.
     */
    public function show($agenda_id)
    {
        return Agenda::findOrFail($agenda_id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $agenda = Agenda::findOrFail($id);
            $agenda->update($request->all());
            return response()->json('Agenda atualizada com sucesso!', HttpStatusCode::HTTP_OK);
        } catch (\Exception $ex) {
            return $ex->getMessage().' - '.HttpStatusCode::HTTP_BAD_REQUEST;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        try {

        $agenda = Agenda::findOrFail($id)->delete();
        $agenda->delete();
        return response()->json('Agenda removida!',HttpStatusCode::HTTP_NO_CONTENT);

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
