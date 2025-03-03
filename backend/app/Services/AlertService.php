<?php

namespace App\Services;

use App\Models\Alert;

class AlertService
{
    /** Serviço para salvar um alerta */
    public function create(array $data)
    {
        return Alert::create([
            'message' => $data['message'],
            'type' => $data['type'],
        ]);
    }

    /** Atualiza o alerta */
    public function update(Alert $alert, array $data)
    {
        $alert->update([
            'message' => $data['message'],
            'type' => $data['type'],
        ]);

        return $alert;
    }

    /** Deleta o alerta */
    public function delete(Alert $alert)
    {
        return $alert->delete();
    }
}
