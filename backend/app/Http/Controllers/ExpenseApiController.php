<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseStoreRequest;
use App\Http\Requests\ExpenseUpdateApiRequest;
use App\Http\Resources\ExpenseResource;
use App\Services\ExpenseService;
use Illuminate\Http\Request;
use App\Models\Expense;
use Throwable;

class ExpenseApiController extends Controller
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
        return ExpenseResource::collection($expenses);
    }

    /** Cria uma nova despesa */
    public function store(ExpenseStoreRequest $request)
    {
        try {
            $expense = $this->expenseService.create($request->validated());
            return (new ExpenseResource($expense))
                ->additional(['message' => 'Despesa cadastrada com sucesso!'])
                ->response()
                ->setStatusCode(201);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exibe os detalhes de uma despesa específica **/
    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    /** Atualiza os dados de uma despesa específica **/
    public function update(ExpenseUpdateApiRequest $request, Expense $expense)
    {
        try {
            $expense = $this->expenseService.update($expense, $request->validated());
            return (new ExpenseResource($expense))
                ->additional(['message' => 'Despesa atualizada com sucesso!'])
                ->response()
                ->setStatusCode(200);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exclui uma despesa específica */
    public function destroy(Expense $expense)
    {
        try {
            $this->expenseService.delete($expense);
            return response()->json(['message' => 'Despesa excluída com sucesso!'], 204);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
