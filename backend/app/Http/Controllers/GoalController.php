<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalStoreRequest;
use App\Http\Requests\GoalUpdateRequest;
use App\Services\GoalService;
use Illuminate\Http\Request;
use App\Models\Goal;
use Throwable;

class GoalController extends Controller
{
    protected $goalService;

    public function __construct(GoalService $goalService)
    {
        $this->goalService = $goalService;
    }

    /** Lista todas as metas */
    public function index()
    {
        $goals = Goal::select('id', 'title', 'description', 'target_amount', 'current_amount', 'due_date')->get();
        return view('goals.index', compact('goals'));
    }

    /** Exibe o formulário para criar uma nova meta */
    public function create()
    {
        return view('goals.create');
    }

    /** Cria uma nova meta */
    public function store(GoalStoreRequest $request)
    {
        {
            try {
                // Definir regras de validação
                $rules = [
                    'name' => 'required|string|max:255',
                    'amount' => 'required|numeric',
                    'deadline' => 'required|date',
                ];

                // Validar a solicitação
                $validated = $request->validate($rules);

                // Criar a meta
                $goal = Goal::create($validated);

                // API: retorna a meta criada
                if ($request->is('api/goals')) {
                    return response()->json([
                        'goal' => $goal,
                        'message' => 'Meta criada com sucesso!'],
                        201);
                }

                // Web: redireciona para a lista de metas
                return redirect()->route('goals.index')->with('success', 'Meta criada com sucesso!');

            } catch (Throwable $exception) {
                return response()->json(['error' => $exception->getMessage()], 500);

            }
        }
    }

    /** Exibe os detalhes de uma meta específica **/
    public function show(Goal $goal)
    {
        return view('goals.show', compact('goal'));
    }

    /** Exibe o formulário para editar uma meta **/
    public function edit(Goal $goal)
    {
        return view('goals.edit', compact('goal'));
    }

    /** Atualiza os dados de uma meta específica **/
    public function update(GoalUpdateRequest $request, Goal $goal)
    {
        $this->goalService.update($goal, $request->validated());
        return redirect()->route('goals.index')->with('success', 'Meta atualizada com sucesso!');
    }

    /** Exclui uma meta específica */
    public function destroy(Goal $goal)
    {
        try {
            $this->goalService.delete($goal);
            return redirect()->route('goals.index')->with('success', 'Meta excluída com sucesso!');
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
