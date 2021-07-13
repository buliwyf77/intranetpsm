<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoUpdate extends FormRequest
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
            'fecha_inicio'      =>  'required',
            //'fecha_culminacion' =>  'required',
            'horas_trabajo'     =>  'required',
            'monto_sueldo'      =>  'required',
            'tipo_contrato_id'  =>  'required',
            'cargo_id'          =>  'required',
            'user_id'           =>  'required'
            
        ];
    }

    public function messages()
    {
        return [
            'fecha_inicio.required'      =>   'El campo Fecha de Inicio es obligatorio',
            //'fecha_culminacion.required' =>   'El campo Fecha de Culminación es obligatorio',
            'horas_trabajo.required'     =>   'El campo Horas de Trabajo es obligatorio',
            'monto_sueldo.required'      =>   'El campo Monto es obligatorio',
            'tipo_contrato_id.required'  =>   'El campo Tipo de Contrato es obligatorio',
            'cargo_id.required'          =>   'El campo Cargo es obligatorio',
            'user_id.required'           =>   'El campo Area es obligatorio'
        ];
    }
}
