<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoStore extends FormRequest
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
            'fecha_ingreso'        =>  'required',
            'fecha_nacimiento'     =>  'required',
            'user_id'              =>  'required',            
            'nacionalidad'         =>  'required',
            'rut'                  =>  'required',
            'pasaporte'            =>  'required',
            'direccion'            =>  'required',
            'telefono'             =>  'required',
            'imagen'               =>  'required',
            'emergencia_nombre'    =>  'required',
            'emergencia_telefono'    =>  'required',

            
        ];
    }

    public function messages()
    {
        return [
            'fecha_ingreso.required'    =>   'El campo Fecha de Ingreso es obligatorio',
            'fecha_nacimiento.required' =>   'El campo Fecha de Nacimiento es obligatorio',
            'user_id.required'          =>   'El campo Usuario  es obligatorio',            
            'nacionalidad.required'     =>   'El campo Nacionalidad es obligatorio',
            'rut.required'              =>   'El campo Rut es obligatorio',
            'pasaporte.required'        =>   'El campo Pasaporte es obligatorio',
            'direccion.required'        =>   'El campo Dirección es obligatorio',
            'telefono'                  =>   'El campo Telefono es obligatorio',
            'imagen'                    =>   'El campo Imagen es obligatorio',
            'emergencia_nombre'         =>   'El nombre del contacto de emergencia es requerido',
            'emergencia_telefono'       =>   'El teléfono del contacto de emergencia es requerido',
        ];
    }
}
