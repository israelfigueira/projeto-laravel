<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ListExemploRequest;
use App\Http\Requests\StoreExemploRequest;
use App\Http\Requests\UpdateExemploRequest;
use App\Http\Resources\ExemploCollection;
use App\Http\Resources\ExemploResource;
use Illuminate\Http\Response;
use App\Models\Exemplo;
use App\Services\ExemploService;

/**
 * Class ExemploController
 * @package  App\Http\Controllers
 */
class ExemploController extends Controller
{

    private $exemploService;

    public function __construct(ExemploService $exemploService)
    {
        $this->exemploService = $exemploService;
    }

    /**
     * @OA\Get(
     *  path="/exemplos",
     *  operationId="list",
     *  tags={"Exemplo"},
     *  summary="Listar exemplos",
     *  description="Retorna a lista de exemplos",
     *  @OA\Response(response=200, description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/Exemplo"),
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Missing Data"
     *  )
     * )
     *
     * Lista de exemplo
     * @return JsonResponse
     */
    public function index(ListExemploRequest $request)
    {
        $exemplo = $this->exemploService->list();
        return response()->json(['data' => new ExemploCollection($exemplo)]);
    }

    /**
     * @OA\Post(
     *  operationId="store",
     *  summary="Criar exemplo",
     *  description="Criar exemplo",
     *  tags={"Exemplo"},
     *  path="/exemplos",
     *  @OA\RequestBody(
     *    description="Criar exemplo",
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="application/json",
     *      @OA\Schema(
     *         @OA\Property(
     *             title="data",
     *             property="data",
     *             type="object",
     *             ref="#/components/schemas/Exemplo")
     *         )
     *    )
     *  ),
     *  @OA\Response(response="201", description="Created",
     *     @OA\JsonContent(
     *        @OA\Property(
     *         title="data",
     *         property="data",
     *         type="object",
     *         ref="#/components/schemas/Exemplo"
     *        ),
     *    ),
     *  ),
     *  @OA\Response(response=422,description="Validation exception"),
     * )
     *
     * @param StoreExemploRequest $request
     * @return JsonResponse
     */
    public function store(StoreExemploRequest $request)
    {
        $data = $request->validated('data');
        $exemplo = $this->exemploService->create($data);
        return response()->json(['data' => new ExemploResource($exemplo)], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *   path="/exemplos/{exemplo_id}",
     *   summary="Visualizar exemplo",
     *   description="Visualizar exemplo",
     *   operationId="show",
     *   tags={"Exemplo"},
     *   @OA\Parameter(ref="#/components/parameters/Exemplo--id"),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="data",
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/Exemplo"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Exemplo não encontrado"),
     * )
     *
     * @param Exemplo $Exemplo
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $exemplo = $this->exemploService->get($id);
        return response()->json(['data' => new ExemploResource($exemplo)]);
    }

    /**
     * @OA\Patch(
     *   operationId="update",
     *   summary="Atualizar exemplo",
     *   description="Atualizar exemplo",
     *   tags={"Exemplo"},
     *   path="/exemplos/{exemplo_id}",
     *   @OA\Parameter(ref="#/components/parameters/Exemplo--id"),
     *   @OA\Response(response="204",description="No content"),
     *   @OA\RequestBody(
     *     description="Identificador do exemplo",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(
     *        @OA\Property(
     *        title="data",
     *        property="data",
     *        type="object",
     *        ref="#/components/schemas/Exemplo")
     *      )
     *     )
     *   )
     * )
     *
     * @param UpdateExemploRequest $request
     * @param Exemplo $Exemplo
     * @return Response|JsonResponse
     */
    public function update(int $id, UpdateExemploRequest $request)
    {
        $data = $request->validated('data');
        $exemplo = $this->exemploService->update($id, $data);
        return response()->json(['data' => new ExemploResource($exemplo)], Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *  path="/exemplos/{exemplo_id}",
     *  summary="Excluir um exemplo",
     *  description="Remove o registro do exemplo",
     *  operationId="delete",
     *  tags={"Exemplo"},
     *  @OA\Parameter(ref="#/components/parameters/Exemplo--id"),
     *  @OA\Response(response=204,description="No content"),
     *  @OA\Response(response=404,description="Exemplo not found"),
     * )
     *
     * @param Exemplo $Exemplo
     * @return Response|JsonResponse
     */
    public function destroy(int $id)
    {
        $this->exemploService->delete($id);
        return response()->noContent();
    }
}
