<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->date->format('Y-m-d H:i:s')
        ];
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $expense = new Expense();
        $expense->user_id = Auth::id();
        $expense->name = $request->name;
        $expense->amount = $request->amount;
        $expense->category = $request->category;
        $expense->save();

        return redirect()->route('dashboard')->with('success', 'Despesa adicionada com sucesso!');
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->name = $request->name;
        $expense->amount = $request->amount;
        $expense->category = $request->category;
        $expense->save();

        return redirect()->route('dashboard')->with('success', 'Despesa atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('dashboard')->with('success', 'Despesa deletada com sucesso!');
    }

}
