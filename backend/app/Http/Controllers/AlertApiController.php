<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use Throwable;

class AlertApiController extends Controller
{
    /** Lista todos os alertas */
    public function index()
    {
        $alerts = Alert::all();
        return response()->json($alerts);
    }

    /** Cria um novo alerta */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'type' => 'required|string|max:50',
        ]);

        try {
            $alert = Alert::create($validated);
            return response()->json($alert, 201);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exibe os detalhes de um alerta específico **/
    public function show(Alert $alert)
    {
        return response()->json($alert);
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
            return response()->json($alert);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /** Exclui um alerta específico */
    public function destroy(Alert $alert)
    {
        try {
            $alert->delete();
            return response()->json(null, 204);
        } catch (Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
