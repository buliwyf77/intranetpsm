<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracionStore extends FormRequest
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
            'nombre_empresa' => 'required',
            'direccion' => 'required',
            'rut' => 'required',
            //'logo' => 'required',
            'telefono'=> 'required',
            'email' => 'required|email',
            'ciudad' => 'required',
            'pagina_web' => 'required',
        ];
    }
}
