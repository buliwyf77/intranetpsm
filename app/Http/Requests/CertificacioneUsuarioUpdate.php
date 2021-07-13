<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificacioneUsuarioUpdate extends FormRequest
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
            'user_id'             =>  'required',
            'certificacione_id'   =>  'required'
            
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'              =>   'El campo Usuario es obligatorio',
            'certificacione_id.required'    =>   'El campo Certificaciones es obligatorio'
           
        ];
  
    }
}
