<?php

namespace App\Services;

use App\Models\Income;

class IncomeService
{
    /** serviço para salvar uma receita */
    public function create(array $data)
    {
        return Income::create([
            'name' => $data['name'],
            'amount' => $data['amount'],
            'date' => $data['date'],
        ]);
    }

    /** atualiza a receita */
    public function update(Income $income, array $data)
    {
        $income->update([
            'name' => $data['name'],
            'amount' => $data['amount'],
            'date' => $data['date'],
        ]);

        return $income;
    }

    /** deleta a receita */
    public function delete(Income $income)
    {
        return $income->delete();
    }
}
