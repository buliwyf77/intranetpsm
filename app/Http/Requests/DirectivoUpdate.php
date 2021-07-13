<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DirectivoUpdate extends FormRequest
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
            'nombre_completo'   =>  'required',
            'rut'               =>  'required',
            'cargo'             =>  'required',
            'email'             =>  'required'            
        ];
    }

    public function messages()
    {
        return [
            'nombre_completo.required' =>   'El campo Nombre es obligatorio',
            'rut.required'             =>   'El campo Rut es obligatorio',
            'cargo.required'           =>   'El campo Cargo es obligatorio',
            'email.required'           =>   'El campo Correo es obligatorio'
        ];
  
    }
}
