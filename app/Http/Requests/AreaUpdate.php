<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaUpdate extends FormRequest
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
            
            'nombre'    =>  'required',
            'descripcion'    =>  'required'
            
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'     =>  'El campo Nombre es obligatorio.',
            'descripcion.required'     =>  'El campo Descripción es obligatorio.'           
        ];
  
    }
}
