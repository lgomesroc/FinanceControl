<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeStoreRequest;
use App\Http\Requests\IncomeUpdateRequest;
use App\Services\IncomeService;
use Illuminate\Http\Request;
use App\Models\Income;
use Throwable;

class IncomeApiController extends Controller
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
    public function store(IncomeStoreRequest $request)
    {
        try {
            $income = $this->incomeService.create($request->validated());
            return redirect()->route('incomes.index')->with('success', 'Receita criada com sucesso!');
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /** Exibe os detalhes de uma receita específica **/
    public function show(Income $income)
    {
        return view('incomes.show', compact('income'));
    }

    /** Exibe o formulário para editar uma receita **/
    public function edit(Income $income)
    {
        return view('incomes.edit', compact('income'));
    }

    /** Atualiza os dados de uma receita específica **/
    public function update(IncomeUpdateRequest $request, Income $income)
    {
        $this->incomeService.update($income, $request->validated());
        return redirect()->route('incomes.index')->with('success', 'Receita atualizada com sucesso!');
    }

    /** Exclui uma receita específica */
    public function destroy(Income $income)
    {
        try {
            $this->incomeService.delete($income);
            return redirect()->route('incomes.index')->with('success', 'Receita excluída com sucesso!');
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
