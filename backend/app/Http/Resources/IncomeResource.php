<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncomeResource extends JsonResource
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
            'name' => $this->name,
            'amount' => $this->amount,
            'date' => $this->date->format('Y-m-d H:i:s')
        ];
    }

    public function store(Request $request)
    {
        $income = new Income();
        $income->user_id = Auth::id();
        $income->amount = $request->amount;
        $income->source = $request->source;
        $income->save();

        return redirect()->route('users.dashboard')->with('success', 'Receita adicionada com sucesso!');
    }

    public function edit($id)
    {
        $income = Income::findOrFail($id);
        return view('incomes.edit', compact('income'));
    }

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

