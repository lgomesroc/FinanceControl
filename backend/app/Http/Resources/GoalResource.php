<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoalResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'target_amount' => $this->target_amount,
            'deadline' => $this->deadline ? $this->deadline->format('Y-m-d H:i:s') : null,
        ];
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $goal = new Goal();
        $goal->user_id = Auth::id();
        $goal->name = $request->name;
        $goal->description = $request->description;
        $goal->due_date = $request->due_date;
        $goal->save();

        return redirect()->route('dashboard')->with('success', 'Meta adicionada com sucesso!');
    }

    public function edit($id)
    {
        $goal = Goal::findOrFail($id);
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::findOrFail($id);
        $goal->name = $request->name;
        $goal->description = $request->description;
        $goal->due_date = $request->due_date;
        $goal->save();

        return redirect()->route('dashboard')->with('success', 'Meta atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $goal = Goal::findOrFail($id);
        $goal->delete();

        return redirect()->route('dashboard')->with('success', 'Meta deletada com sucesso!');
    }

}
