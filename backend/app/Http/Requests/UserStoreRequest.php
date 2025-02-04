<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => $this->isApiRequest() ? 'required|string|min:8' : 'required|string|min:8|confirmed',
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
                'password_confirmation' => $this->password_confirmation
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
