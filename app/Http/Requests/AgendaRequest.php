<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AgendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {

        return [
            'data_inicio' => 'required|date_format:Y-m-d H:i:s|unique:agendas,data_inicio',
            'data_prazo'  => 'required|date_format:Y-m-d H:i:s',
            'data_conclusao' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|string',
            'titulo' => 'required|string|unique:agendas,titulo',
            'tipo' => 'required|string',
            'descricao' => 'required|max:255',
            'usuario_responsavel' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }



}
