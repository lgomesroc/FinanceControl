<?php

namespace App\Services;

use App\Models\Expense;

class ExpenseService
{
    /** Serviço para salvar uma despesa */
    public function create(array $data)
    {
        return Expense::create([
            'description' => $data['description'],
            'amount' => $data['amount'],
            'date' => $data['date'],
        ]);
    }

    /** Atualiza a despesa */
    public function update(Expense $expense, array $data)
    {
        $expense->update([
            'description' => $data['description'],
            'amount' => $data['amount'],
            'date' => $data['date'],
        ]);

        return $expense;
    }

    /** Deleta a despesa */
    public function delete(Expense $expense)
    {
        return $expense->delete();
    }
}
