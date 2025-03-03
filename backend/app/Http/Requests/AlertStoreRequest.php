<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlertStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'message' => 'required|string|max:255',
            'type' => 'required|string|max:50',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->isApiRequest()) {
            $this->merge([
                // Adicione quaisquer preparações de dados específicas para a API aqui, se necessário
            ]);
        }
    }

    /**
     * Determine if the request is an API request.
     *
     * @return bool
     */
    protected function isApiRequest()
    {
        return $this->is('api/*');
    }
}
