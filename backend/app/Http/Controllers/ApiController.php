<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function getData(): JsonResponse
    {
        // Retornar dados como JSON
        return response()->json(['data' => 'Aqui estão seus dados']);
    }

    public function postData(Request $request): JsonResponse
    {
        // Processar e salvar os dados recebidos
        $data = $request->input('data');

        // Lógica para salvar os dados...
        // Exemplo de uso da variável $data para não ficar como "unused"
        $savedData = $this->saveData($data);

        return response()->json(['success' => true, 'message' => 'Dados salvos com sucesso', 'data' => $savedData]);
    }

    /**
     * Método para salvar os dados
     *
     * @param mixed $data Os dados para salvar
     * @return mixed Os dados salvos
     */
    private function saveData(mixed $data): mixed
    {
        // Implemente a lógica real de salvamento aqui
        // Este é apenas um exemplo para usar a variável $data
        return $data;
    }
}
