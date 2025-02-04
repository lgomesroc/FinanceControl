<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeStoreRequest;
use App\Http\Requests\IncomeUpdateApiRequest;
use App\Http\Requests\IncomeUpdateRequest;
use App\Http\Resources\IncomeResource;
use App\Services\IncomeService;
use Illuminate\Http\Request;
use App\Models\Income;
use Throwable;

class IncomeController extends Controller
{
    protected $incomeService;

    public function __construct(IncomeService $incomeService)
    {
        $this->incomeService = $incomeService;
    }

    /** Lista todas as receitas **/
    public function index(Request $request)
    {
        $incomes = Income::select('id', 'amount', 'source', 'created_at')->get();

        // API: retorna JSON
        if ($request->is('api/incomes')) {
            return IncomeResource::collection($incomes);
        }

        // Web: retorna view
        return view('incomes.index', compact('incomes'));
    }

    // Exibe o formulário para criar uma nova receita
    public function create()
    {
        return view('incomes.create');
    }

    /** Cria uma nova receita **/
    public function store(IncomeStoreRequest $request)
    {
        try {
            $income = $this->incomeService.create($request->validated());

            if ($request->is('api/incomes')) {
                return (new IncomeResource($income))
                    ->additional(['message' => 'Receita cadastrada com sucesso!'])
                    ->response()
                    ->setStatusCode(201);
            }

            return redirect()->route('incomes.index')->with('success', 'Receita criada com sucesso!');

        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
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

    /** Atualiza os dados de uma receita específica via web **/
    public function update(IncomeUpdateRequest $request, Income $income)
    {
        $this->incomeService.update($income, $request->validated());
        // Web: redireciona para a lista de receitas
        return redirect()->route('incomes.index')->with('success', 'Receita atualizada com sucesso!');
    }

    /** Atualiza os dados de uma receita específica via api **/
    public function updateApi(IncomeUpdateApiRequest $request, Income $income)
    {
        try {
            $income = $this->incomeService.update($income, $request->validated());
            // API: retorna a receita atualizada
            return (new IncomeResource($income))
                ->additional(['message' => 'Receita atualizada com sucesso!'])
                ->response()
                ->setStatusCode(200);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exclui uma receita específica */
    public function destroy(Income $income, Request $request)
    {
        try {
            $this->incomeService.delete($income);

            if ($request->is("api/incomes/{$income->id}")) {
                return response()->json(['message' => 'Receita excluída com sucesso!'], 204);
            }

            return redirect()->route('incomes.index')->with('success', 'Receita excluída com sucesso!');
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
