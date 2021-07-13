<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudAumentoUpdate extends FormRequest
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
            'fecha'                 =>  'required',
            'ciudad'                =>  'required',
            'user_id'               =>  'required',
            'directivo_id'          =>  'required',
            //'fecha_aprobacion'    =>  'required',
            //'fecha_rechazo'       =>  'required',
            //'solicitud_id'        =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'fecha.required'                =>   'El campo Fecha es obligatorio',
            'ciudad.required'               =>   'El campo Ciudad es obligatorio',
            'user_id.required'              =>   'El campo Usuario  es obligatorio',
            'directivo_id.required'         =>   'El campo Directivo es obligatorio',
            //'fecha_aprobacion.required'   =>   'El campo Fecha de Aprobación es obligatorio',
            //'fecha_rechazo.required'      =>   'El campo Fecha de Rechazo es obligatorio',
            //'solicitud_id.required'       =>   'El campo Estado de solicitud es obligatorio'
           
        ];
  
    }
}
