<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudVacacioneUpdate extends FormRequest
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
            'fecha'            =>  'required',
            'fecha_inicio'     =>  'required',
            'user_id'          =>  'required',           
          //  'fecha_aprobacion' =>  'required',
           // 'fecha_rechazo'    =>  'required',
          //  'solicitud_id'     =>  'required',
           // 'fecha_reintegro'  =>  'required',
            //'fecha_culminacion'=>  'required',
            'cantidad_dia'     =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'fecha.required'            =>   'El campo Fecha es obligatorio',
            'fecha_inicio.required'     =>   'El campo Ciudad es obligatorio',
            'user_id.required'          =>   'El campo Usuario  es obligatorio',            
           // 'fecha_aprobacion.required' =>   'El campo Fecha de Aprobación es obligatorio',
           // 'fecha_rechazo.required'    =>   'El campo Fecha de Rechazo es obligatorio',
          //  'solicitud_id.required'     =>   'El campo Estado de solicitud es obligatorio',
           // 'fecha_reintegro.required'  =>   'El campo Fecha de Reintegro es obligatorio',
           // 'fecha_culminacion'         =>   'El campo Fecha de Culminación es obligatorio',
            'cantidad_dia'              =>   'El campo Cantidad de Dias es obligatorio'
           
        ];
  
    }
}
