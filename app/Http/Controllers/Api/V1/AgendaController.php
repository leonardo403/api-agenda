<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaRequest;
use App\Http\Resources\V1\AgendaResource;
use App\Models\Agenda;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;
use App\Services\AgendaService;
class AgendaController extends Controller
{
    use HttpResponse;
    protected $agendaService;

    public function __construct(AgendaService $agendaService)
    {
        $this->middleware('auth:sanctum' )->only(['store','update','destroy']);
        $this->agendaService = $agendaService;
    }

    /**
     * @OA\Get(
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
     *  @OA\Post(
     *   path="/api/v1/agendas",
     *   summary="Cadastro de agenda",
     *    @OA\Parameter(
     *         name="AgendaRequest",
     *         in="query",
     *         description="Criar uma agenda",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *   @OA\Response(response="200", description="Retorna Agenda criada com sucesso!"),
     *   @OA\Response(response="400", description="Cadastro não realizado.")
     *   )
     */
    public function store(AgendaRequest $request)
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

    /**
     *  @OA\Get(
     *   path="/api/v1/agendas/{agenda_id}",
     *   summary="Retorna uma agenda cadastrada.",
     *    @OA\Parameter(
     *         name="agenda_id",
     *         in="query",
     *         description="Seleciona apenas uma agenda",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *   @OA\Response(response="200", description="Retorna uma Agenda!")
     *   )
     */
    public function showAgenda($agenda_id)
    {
        return $this->agendaService->showAgenda($agenda_id);
    }

    /**
     *  @OA\Put(
     *   path="/api/v1/agendas/",
     *   summary="Atualiza uma agenda",
     *    @OA\Parameter(
     *         name="AgendaRequest",
     *         in="query",
     *         description="Criar uma agenda",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Id de uma agenda",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *   @OA\Response(response="200", description="Retorna que agenda foi atualizada com sucesso!"),
     *   @OA\Response(response="400", description="Não foi atualizado.")
     *   )
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
     *  @OA\Delete(
     *   path="/api/v1/agendas/{agenda_id}",
     *   summary="Deleta uma agenda",
     *    @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Id de uma agenda",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *   @OA\Response(response="200", description="Agenda foi removida!"),
     *   @OA\Response(response="400", description="Não foi removida.")
     *   )
     */
    public function destroy(int $id)
    {
        try {

        $agenda = Agenda::findOrFail($id);
        $agenda->delete();
        return response()->json([
            "message" => "Agenda foi removida!"],HttpStatusCode::HTTP_NO_CONTENT);

    } catch (\Exception $ex) {
            return $ex->getMessage().' - '.HttpStatusCode::HTTP_BAD_REQUEST;
        }
    }

    /**
     *  @OA\Get(
     *   path="/api/v1/agendas/rangeData",
     *   summary="Relaizar um range de data.",
     *    @OA\Parameter(
     *         name="AgendaRequest",
     *         in="query",
     *         description="Listar a agenda em um range de data",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *   @OA\Response(response="200", description="Retorna que agenda foi atualizada com sucesso!"),
     *   @OA\Response(response="400", description="Não foi atualizado.")
     *   )
     */
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
