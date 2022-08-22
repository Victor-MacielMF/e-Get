<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

    public function messages() {

        return [
            'cpf' => 'O CPF fornecido não é válido.'
        ];
    }

    public function rules()
    {
        return [
            'nome'=> [
                'required'
            ],
            'cep'=> [
                'required'
            ],
            'cpf'=> [
                'bail',
                'required',
                'cpf',
                'unique:clientes,cpf,' .intval($this->id)
            ]
        ];
    }
}
