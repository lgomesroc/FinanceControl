<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;

class IncomeController extends Controller
{
    // Lista todas as receitas
    public function index()
    {
        $incomes = Income::all();

        // API: retorna JSON
        if (request()->wantsJson()) {
            return response()->json($incomes);
        }

        // Web: retorna view
        return view('incomes.index', compact('incomes'));
    }

    // Exibe o formulário para criar uma nova receita
    public function create()
    {
        return view('incomes.create');
    }

    // Salva uma nova receita
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $income = Income::create($validated);

        // API: retorna a receita criada
        if ($request->wantsJson()) {
            return response()->json($income, 201);
        }

        // Web: redireciona para a lista de receitas
        return redirect()->route('incomes.index')->with('success', 'Receita criada com sucesso!');
    }

    // Exibe os detalhes de uma receita específica
    public function show(Income $income)
    {
        return view('incomes.show', compact('income'));
    }

    // Exibe o formulário para editar uma receita
    public function edit(Income $income)
    {
        return view('incomes.edit', compact('income'));
    }

    // Atualiza os dados de uma receita específica
    public function update(Request $request, Income $income)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $income->update($validated);

        // API: retorna a receita atualizada
        if ($request->wantsJson()) {
            return response()->json($income);
        }

        // Web: redireciona para a lista de receitas
        return redirect()->route('incomes.index')->with('success', 'Receita atualizada com sucesso!');
    }

    // Exclui uma receita específica
    public function destroy(Income $income)
    {
        $income->delete();

        // API: retorna status de sucesso
        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        // Web: redireciona para a lista de receitas
        return redirect()->route('incomes.index')->with('success', 'Receita excluída com sucesso!');
    }
}
