<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    /** Lista todos os alertas */
    public function index()
    {
        $alerts = Alert::all();
        return view('alerts.index', compact('alerts'));
    }

    /** Exibe o formulário para criar um novo alerta */
    public function create()
    {
        return view('alerts.create');
    }

    /** Cria um novo alerta */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'type' => 'required|string|max:50',
        ]);

        try {
            Alert::create([
                'message' => $validated['message'],
                'type' => $validated['type'],
                'user_id' => Auth::id(),
            ]);
            return redirect()->route('alerts.index')->with('success', 'Alerta criado com sucesso!');
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /** Exibe os detalhes de um alerta específico **/
    public function show(Alert $alert)
    {
        return view('alerts.show', compact('alert'));
    }

    /** Exibe o formulário para editar um alerta **/
    public function edit(Alert $alert)
    {
        return view('alerts.edit', compact('alert'));
    }

    /** Atualiza os dados de um alerta específico **/
    public function update(Request $request, Alert $alert)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'type' => 'required|string|max:50',
        ]);

        try {
            $alert->update($validated);
            return redirect()->route('alerts.index')->with('success', 'Alerta atualizado com sucesso!');
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /** Exclui um alerta específico */
    public function destroy(Alert $alert)
    {
        try {
            $alert->delete();
            return redirect()->route('alerts.index')->with('success', 'Alerta excluído com sucesso!');
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
