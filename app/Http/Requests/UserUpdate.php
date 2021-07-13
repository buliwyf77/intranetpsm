<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
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
            'name'                 =>  'required',
            'email'                =>  'required|email:rfc,dns',
            'password'             =>  'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
            'doc_identidad'        =>  'required',
            'num_doc'              =>  'required|max:12',
            'nacionalidad'         =>  'required',
            //'fecha_nacimiento'     =>  'required',
            'fecha_ingreso'        =>  'required',
            //'imagen'               =>  'mimes:jpg,jpeg,png',
            //'telefono'             =>  'required',
            //'direccion'            =>  'required',
            'area_id'              =>  'required'
        ];
    }


    public function messages ()
    {
        return [
            'name.required'                 =>  'El campo nombre es obligatorio',
            'email.required'                =>  'El campo email es obligatorio',
            'password.required'             =>  'El campo contraseña es obligatorio',
            'password.min:8'                =>  'La contraseña debe ser mayor a 8 caracteres',
            'password.confirmed'            => 'Las contraseñas con coinciden',
            'doc_identidad.required'        =>  'El campo documento de identidad es obligatorio',
            'num_doc.required'              =>  'El campo número de documento es obligatorio',
            'nacionalidad.required'         =>  'El campo nacionalidad es obligatorio',
            //'fecha_nacimiento.required'     =>  'El campo fecha de nacimiento es obligatorio',
            'fecha_ingreso.required'        =>  'El campo fecha de ingreso es obligatorio',
            //'imagen.mimes'                  =>  'El campo foto debe ser formato jpeg ó png',
            //'telefono.required'             =>  'El campo teléfono es obligatorio',
            //'direccion.required'            =>  'El campo dirección es obligatorio',
            'area_id.required'              =>  'El campo área es obligatorio'
        ];
    }
}
