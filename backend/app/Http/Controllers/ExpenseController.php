<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseStoreRequest;
use App\Http\Requests\ExpenseUpdateRequest;
use App\Services\ExpenseService;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ExpenseController extends Controller
{
    protected $expenseService;

    public function __construct(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
    }

    /** Lista todas as despesas */
    public function index()
    {
        $expenses = Expense::select('id', 'description', 'amount', 'date')->get();
        return view('expenses.index', compact('expenses'));
    }

    /** Exibe o formulário para criar uma nova despesa */
    public function create()
    {
        return view('expenses.create');
    }

    /** Cria uma nova despesa */
    public function store(Request $request)
    {
        $expense = new Expense();
        $expense->user_id = Auth::id();
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->save();

        return redirect()->route('dashboard')->with('success', 'Despesa adicionada com sucesso!');
    }

    /** Exibe os detalhes de uma despesa específica **/
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    /** Exibe o formulário para editar uma despesa **/
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    /** Atualiza os dados de uma despesa específica **/
    public function update(ExpenseUpdateRequest $request, Expense $expense)
    {
        $this->expenseService.update($expense, $request->validated());
        return redirect()->route('expenses.index')->with('success', 'Despesa atualizada com sucesso!');
    }

    /** Exclui uma despesa específica */
    public function destroy(Expense $expense)
    {
        try {
            $this->expenseService->delete($expense);
            return redirect()->route('expenses.index')->with('success', 'Despesa excluída com sucesso!');
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
