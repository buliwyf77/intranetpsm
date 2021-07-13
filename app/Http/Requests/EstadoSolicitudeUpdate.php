<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadoSolicitudeUpdate extends FormRequest
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
            'color'         =>  'required'
            
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'        =>   'El campo Nombre es obligatorio',
            'descripcion.required'   =>   'El campo Descripción es obligatorio',
            'color.required'         =>   'El campo Color es obligatorio'
           
        ];
  
    }
}
