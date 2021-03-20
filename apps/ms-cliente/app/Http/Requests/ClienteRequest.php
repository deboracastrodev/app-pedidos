<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validations = [
            'nome'  => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'telefone' => 'required',
            'username' => 'required|string|unique:clientes',
            'password' => 'required|confirmed',
        ];

        return $validations;
    }
}
