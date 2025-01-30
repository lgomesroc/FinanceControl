<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    // Lista todas as despesas
    public function index()
    {
        $expenses = Expense::all();

        // API: retorna JSON
        if (request()->wantsJson()) {
            return response()->json($expenses);
        }

        // Web: retorna view
        return view('expenses.index', compact('expenses'));
    }

    // Exibe o formulário para criar uma nova despesa
    public function create()
    {
        return view('expenses.create');
    }

    // Salva uma nova despesa
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $expense = Expense::create($validated);

        // API: retorna a despesa criada
        if ($request->wantsJson()) {
            return response()->json($expense, 201);
        }

        // Web: redireciona para a lista de despesas
        return redirect()->route('expenses.index')->with('success', 'Despesa criada com sucesso!');
    }

    // Exibe os detalhes de uma despesa específica
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    // Exibe o formulário para editar uma despesa
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    // Atualiza os dados de uma despesa específica
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $expense->update($validated);

        // API: retorna a despesa atualizada
        if ($request->wantsJson()) {
            return response()->json($expense);
        }

        // Web: redireciona para a lista de despesas
        return redirect()->route('expenses.index')->with('success', 'Despesa atualizada com sucesso!');
    }

    // Exclui uma despesa específica
    public function destroy(Expense $expense)
    {
        $expense->delete();

        // API: retorna status de sucesso
        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        // Web: redireciona para a lista de despesas
        return redirect()->route('expenses.index')->with('success', 'Despesa excluída com sucesso!');
    }
}
