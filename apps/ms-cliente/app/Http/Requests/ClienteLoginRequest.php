<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class ClienteLoginRequest extends FormRequest
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
            'username' => 'required|string',
            'password' => 'required|string',
        ];

        return $validations;
    }
}
