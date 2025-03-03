<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalStoreRequest;
use App\Http\Requests\GoalUpdateRequest;
use App\Models\Goal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GoalController extends Controller
{
    use AuthorizesRequests;

    /** Lista todas as metas do usuário */
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->get();
        return view('goals.index', compact('goals'));
    }

    /** Exibe o formulário para criar uma nova meta */
    public function create()
    {
        $dateNow = Carbon::now()->addDay()->toDateString();
        return view('goals.create', ['dateNow' => $dateNow]);
    }

    /** Cria uma nova meta */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'target_amount' => 'required|numeric|min:0',
                'due_date' => 'required|date|after:today',
            ]);

            $validated['user_id'] = auth()->id();
            $validated['current_amount'] = 0;

            $goal = Goal::create($validated);

            return redirect()->route('dashboard')
                ->with('success', 'Meta criada com sucesso!');

        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao criar meta: ' . $exception->getMessage());
        }
    }

    /** Exibe os detalhes de uma meta específica */
    public function show(Goal $goal)
    {
        $this->authorize('view', $goal);
        return view('goals.show', compact('goal'));
    }

    /** Exibe o formulário para editar uma meta */
    public function edit(Goal $goal)
    {
        $dateNow = Carbon::now()->addDay()->toDateString();
        $due_date = Carbon::parse($goal->due_date)->toDateString();
        $this->authorize('update', $goal);
        return view('goals.edit', ['goal' => $goal, 'dateNow' => $dateNow, 'due_date' => $due_date]);
    }

    /** Atualiza os dados de uma meta específica */
    public function update(Request $request, Goal $goal)
    {
        try {
            $this->authorize('update', $goal);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'target_amount' => 'required|numeric|min:0',
                'due_date' => 'required|date',
            ]);

            $goal->update($validated);

            return redirect()->route('dashboard')
                ->with('success', 'Meta atualizada com sucesso!');

        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar meta: ' . $exception->getMessage());
        }
    }

    /** Exclui uma meta específica */
    public function destroy(Goal $goal)
    {
        try {
            $this->authorize('delete', $goal);

            $goal->delete();

            return redirect()->route('dashboard')
                ->with('success', 'Meta excluída com sucesso!');

        } catch (Throwable $exception) {
            return redirect()->back()->with('error', 'Erro ao excluir meta: ' . $exception->getMessage());
        }
    }
}
