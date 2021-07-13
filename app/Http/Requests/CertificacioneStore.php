<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificacioneStore extends FormRequest
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
            'nombre'        =>  'required',
            'descripcion'   =>  'required',
            'tipo'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'       =>   'El campo Nombre es obligatorio',
            'tipo.required'         =>   'El campo Tipo es obligatorio',
            'descripcion.required'  =>   'El campo Descripción es obligatorio',
           
        ];
    }
}
