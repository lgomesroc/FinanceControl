<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'target_amount' => 'required|numeric|min:0',
            'deadline' => 'nullable|date',
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
