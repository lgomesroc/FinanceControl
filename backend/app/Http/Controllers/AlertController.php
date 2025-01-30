<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::all();

        // Se a requisição for da API, retorna como JSON
        if (request()->wantsJson()) {
            return response()->json($alerts);
        }

        // Se for uma requisição normal do navegador, retorna uma view
        return view('alerts.index', compact('alerts'));
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        // Criação do alerta
        $alert = Alert::create([
            'message' => $validated['message'],
            'user_id' => $validated['user_id'],
        ]);

        // Se a requisição for da API, retorna a resposta JSON
        if ($request->wantsJson()) {
            return response()->json($alert, 201);
        }

        // Se for uma requisição do navegador, redireciona para a página de alertas
        return redirect()->route('alerts.index')->with('success', 'Alerta criado com sucesso!');
    }

    public function create()
    {
        return view('alerts.create');
    }

    // Exibe os detalhes de um alerta específico
    public function show(Alert $alert)
    {
        return view('alerts.show', compact('alert'));
    }

    // Exibe o formulário para editar um alerta
    public function edit(Alert $alert)
    {
        return view('alerts.edit', compact('alert'));
    }

    // Atualiza os dados de um alerta específico
    public function update(Request $request, Alert $alert)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $alert->update([
            'message' => $validated['message'],
            'user_id' => $validated['user_id'],
        ]);

        // Se for requisição da API, retorna o alerta atualizado
        if ($request->wantsJson()) {
            return response()->json($alert);
        }

        // Se for requisição da Web, redireciona para a lista de alertas
        return redirect()->route('alerts.index')->with('success', 'Alerta atualizado com sucesso!');
    }

    // Exclui um alerta específico
    public function destroy(Alert $alert)
    {
        $alert->delete();

        // Se for requisição da API, retorna um status de sucesso
        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        // Se for requisição da Web, redireciona para a lista de alertas
        return redirect()->route('alerts.index')->with('success', 'Alerta excluído com sucesso!');
    }
}
