<?php

namespace App\Services;

use App\Models\Expense;
use Illuminate\Support\Facades\Log;

class ExpenseService
{
    /** Serviço para salvar uma despesa */
    public function create(array $data)
    {
        return Expense::create([
            'category' => $data['category'],
            'description' => $data['description'],
            'amount' => $data['amount'],
            'date' => $data['date'],
        ]);
    }

    /** Atualiza a despesa */
    public function update(int $id, array $data)
    {
        $expense = Expense::find($id);
        $expense->update([
            'description' => $data['description'],
            'amount' => $data['amount'],
            'category' => $data['category'],
            'date' => $data['date']
        ]);

        return $expense;
    }

    /** Deleta a despesa */
    public function delete(Expense $expense)
    {
        return $expense->delete();
    }
}
