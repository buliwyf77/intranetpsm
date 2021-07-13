<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudAumentoStore extends FormRequest
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
            'proyectos_funciones'            =>  'required',
            
        ];
    }

    public function messages()
    {
        return [
            'proyectos_funciones.required'            =>   'El campo es obligatorio',
            
        ];
    }
}
