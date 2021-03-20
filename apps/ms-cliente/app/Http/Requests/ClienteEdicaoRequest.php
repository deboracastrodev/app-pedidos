<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class ClienteEdicaoRequest extends FormRequest
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
            'nome'  => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ];

        return $validations;
    }
}
