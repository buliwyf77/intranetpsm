<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienciaLaboraleStore extends FormRequest
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
            'empresa'          =>  'required',
            'fecha_inicio'     =>  'required',
            'user_id'          =>  'required',
            'cargo'            =>  'required',
            'fecha_termino'    =>  'required'          
           
        ];
    }

    public function messages()
    {
        return [
            'empresa.required'          =>   'El campo Empresa es obligatorio',
            'fecha_inicio.required'     =>   'El campo Ciudad es obligatorio',
            'user_id.required'          =>   'El campo Usuario  es obligatorio',
            'cargo.required'            =>   'El campo Cargo es obligatorio',
            'fecha_termino.required'    =>   'El campo Fecha de Termino es obligatorio'           
            
        ];
    }
}
