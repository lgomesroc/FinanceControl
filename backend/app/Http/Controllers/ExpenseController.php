<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseStoreRequest;
use App\Http\Requests\ExpenseUpdateRequest;
use App\Services\ExpenseService;
use Exception;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $expense->category = $request->category ;
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
        try {
            $this->expenseService->update($expense->id, $request->validated());
            return redirect()->route('dashboard')->with('success', 'Despesa atualizada com sucesso!');
        } catch (Exception $exception) {
            Log::info($exception);
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
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
