<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipacionProyectoUpdate extends FormRequest
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
            'funciones'       =>  'required',
            'proyecto_id'     =>  'required',
            'user_id'         =>  'required'
            
        ];
    }

    public function messages()
    {
        return [
            'funciones.required'       =>   'El campo Funciones es obligatorio',
            'proyecto_id.required'     =>   'El campo Proyecto es obligatorio',
            'user_id.required'         =>   'El campo Usuario es obligatorio'
        ];
  
    }
}
