<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;

class GoalController extends Controller
{
    // Lista todas as metas
    public function index()
    {
        $goals = Goal::all();

        // API: retorna JSON
        if (request()->wantsJson()) {
            return response()->json($goals);
        }

        // Web: retorna view
        return view('goals.index', compact('goals'));
    }

    // Exibe o formulário para criar uma nova meta
    public function create()
    {
        return view('goals.create');
    }

    // Salva uma nova meta
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'target_amount' => 'required|numeric|min:0',
            'deadline' => 'nullable|date',
        ]);

        $goal = Goal::create($validated);

        // API: retorna a meta criada
        if ($request->wantsJson()) {
            return response()->json($goal, 201);
        }

        // Web: redireciona para a lista de metas
        return redirect()->route('goals.index')->with('success', 'Meta criada com sucesso!');
    }

    // Exibe os detalhes de uma meta específica
    public function show(Goal $goal)
    {
        return view('goals.show', compact('goal'));
    }

    // Exibe o formulário para editar uma meta
    public function edit(Goal $goal)
    {
        return view('goals.edit', compact('goal'));
    }

    // Atualiza os dados de uma meta específica
    public function update(Request $request, Goal $goal)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'target_amount' => 'required|numeric|min:0',
            'deadline' => 'nullable|date',
        ]);

        $goal->update($validated);

        // API: retorna a meta atualizada
        if ($request->wantsJson()) {
            return response()->json($goal);
        }

        // Web: redireciona para a lista de metas
        return redirect()->route('goals.index')->with('success', 'Meta atualizada com sucesso!');
    }

    // Exclui uma meta específica
    public function destroy(Goal $goal)
    {
        $goal->delete();

        // API: retorna status de sucesso
        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        // Web: redireciona para a lista de metas
        return redirect()->route('goals.index')->with('success', 'Meta excluída com sucesso!');
    }
}
