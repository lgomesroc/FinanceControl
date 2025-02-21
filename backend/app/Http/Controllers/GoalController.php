<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalStoreRequest;
use App\Http\Requests\GoalUpdateRequest;
use App\Models\Goal;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class GoalController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->get();
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

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

            return redirect()->route('goals.index')
                ->with('success', 'Meta criada com sucesso!');

        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao criar meta: ' . $exception->getMessage());
        }
    }

    public function show(Goal $goal)
    {
        $this->authorize('view', $goal);
        return view('goals.show', compact('goal'));
    }

    public function edit(Goal $goal)
    {
        $this->authorize('update', $goal);
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        try {
            $this->authorize('update', $goal);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'target_amount' => 'required|numeric|min:0',
                'current_amount' => 'required|numeric|min:0',
                'due_date' => 'required|date',
            ]);

            $goal->update($validated);

            return redirect()->route('goals.index')
                ->with('success', 'Meta atualizada com sucesso!');

        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar meta: ' . $exception->getMessage());
        }
    }

    public function destroy(Goal $goal)
    {
        try {
            $this->authorize('delete', $goal);

            $goal->delete();

            return redirect()->route('goals.index')
                ->with('success', 'Meta excluída com sucesso!');

        } catch (Throwable $exception) {
            return back()->with('error', 'Erro ao excluir meta: ' . $exception->getMessage());
        }
    }
}
