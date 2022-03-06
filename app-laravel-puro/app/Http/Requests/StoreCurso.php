<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurso extends FormRequest
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

            'nombre' => 'required|max:10',
            'descripcion' => 'required|min:10',
            'categoria' => 'required'

        ];
    }

    public function attributes()
    {
        return[
            'nombre'=>'nombre del curso'
        ];
    }
    public function messages()
    {
        return [
            'descripcion.required'=>'Debe Ingresar una descripcion del Curso'
        ];
    }
}
