<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeStoreRequest;
use App\Http\Requests\IncomeUpdateRequest;
use App\Services\IncomeService;
use Illuminate\Http\Request;
use App\Models\Income;
use Throwable;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    protected $incomeService;

    public function __construct(IncomeService $incomeService)
    {
        $this->incomeService = $incomeService;
    }

    /** Lista todas as receitas */
    public function index()
    {
        $incomes = Income::select('id', 'name', 'amount', 'date')->get();
        return view('incomes.index', compact('incomes'));
    }

    // Exibe o formulário para criar uma nova receita
    public function create()
    {
        return view('incomes.create');
    }

    /** Cria uma nova receita */
    public function store(Request $request)
    {
        $income = new Income();
        $income->user_id = Auth::id();
        $income->name = $request->name;
        $income->amount = $request->amount;
        $income->source = $request->source;
        $income->save();

        return redirect()->route('dashboard')->with('success', 'Receita adicionada com sucesso!');
    }

    /** Exibe os detalhes de uma receita específica **/
    public function show(Income $income)
    {
        return view('incomes.show', compact('income'));
    }

    /** Exibe o formulário para editar uma receita **/
    public function edit($id)
    {
        $income = Income::findOrFail($id);
        return view('incomes.edit', compact('income'));
    }

    /** Atualiza os dados de uma receita específica **/
    public function update(Request $request, $id)
    {
        $income = Income::findOrFail($id);
        $income->name = $request->name;
        $income->amount = $request->amount;
        $income->source = $request->source;
        $income->save();

        return redirect()->route('dashboard')->with('success', 'Receita atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return redirect()->route('dashboard')->with('success', 'Receita deletada com sucesso!');
    }
}
