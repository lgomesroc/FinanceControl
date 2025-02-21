<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlertResource extends JsonResource
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
            'message' => $this->message,
            'type' => $this->type,
        ];
    }

    public function create()
    {
        return view('alerts.create');
    }

    public function store(Request $request)
    {
        $alert = new Alert();
        $alert->user_id = Auth::id();
        $alert->name = $request->name;
        $alert->description = $request->description;
        $alert->alert_date = $request->alert_date;
        $alert->save();

        return redirect()->route('dashboard')->with('success', 'Alerta adicionado com sucesso!');
    }

    public function edit($id)
    {
        $alert = Alert::findOrFail($id);
        return view('alerts.edit', compact('alert'));
    }

    public function update(Request $request, $id)
    {
        $alert = Alert::findOrFail($id);
        $alert->name = $request->name;
        $alert->description = $request->description;
        $alert->alert_date = $request->alert_date;
        $alert->save();

        return redirect()->route('dashboard')->with('success', 'Alerta atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $alert = Alert::findOrFail($id);
        $alert->delete();

        return redirect()->route('dashboard')->with('success', 'Alerta deletado com sucesso!');
    }

}
