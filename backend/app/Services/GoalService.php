<?php

namespace App\Services;

use App\Models\Goal;

class GoalService
{
    /** Serviço para salvar uma meta */
    public function create(array $data)
    {
        return Goal::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'target_amount' => $data['target_amount'],
            'deadline' => $data['deadline'],
        ]);
    }

    /** Atualiza a meta */
    public function update(Goal $goal, array $data)
    {
        $goal->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'target_amount' => $data['target_amount'],
            'deadline' => $data['deadline'],
        ]);

        return $goal;
    }

    /** Deleta a meta */
    public function delete(Goal $goal)
    {
        return $goal->delete();
    }
}
