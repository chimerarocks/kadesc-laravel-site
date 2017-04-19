<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'formMessage' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'É necessário inserir seu nome para enviar sua mensagem.',
            'email.required' => 'É necessário inserir seu email para enviar sua mensagem.',
            'email.email' => 'O email inserido é inválido.',
            'phone.required'=> 'É necessário inserir seu telefone para enviar sua mensagem.',
            'formMessage.required'=> 'Insira sua mensagem no campo \'Mensagem\''
        ];
    }
}
