<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalStoreRequest;
use App\Http\Requests\GoalUpdateApiRequest;
use App\Http\Resources\GoalResource;
use App\Services\GoalService;
use Illuminate\Http\Request;
use App\Models\Goal;
use Throwable;

class GoalApiController extends Controller
{
    protected $goalService;

    public function __construct(GoalService $goalService)
    {
        $this->goalService = $goalService;
    }

    /** Lista todas as metas */
    public function index()
    {
        $goals = Goal::select('id', 'title', 'description', 'target_amount', 'deadline')->get();
        return GoalResource::collection($goals);
    }

    /** Cria uma nova meta */
    public function store(GoalStoreRequest $request)
    {
        try {
            $goal = $this->goalService.create($request->validated());
            return (new GoalResource($goal))
                ->additional(['message' => 'Meta cadastrada com sucesso!'])
                ->response()
                ->setStatusCode(201);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exibe os detalhes de uma meta específica **/
    public function show(Goal $goal)
    {
        return new GoalResource($goal);
    }

    /** Atualiza os dados de uma meta específica **/
    public function update(GoalUpdateApiRequest $request, Goal $goal)
    {
        try {
            $goal = $this->goalService.update($goal, $request->validated());
            return (new GoalResource($goal))
                ->additional(['message' => 'Meta atualizada com sucesso!'])
                ->response()
                ->setStatusCode(200);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exclui uma meta específica */
    public function destroy(Goal $goal)
    {
        try {
            $this->goalService.delete($goal);
            return response()->json(['message' => 'Meta excluída com sucesso!'], 204);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
