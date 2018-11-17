<?php

namespace sisVentas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    { //PASO 7- modificamos de false a true para indicar que esta autorizado
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     //PASO 8- Definir las reglas para los atributos nombre y descripcion,son el nombre de nuestro objeto HTML que vamos a validar
    public function rules()
    {
        return [
            'nombre'=>'required|max:50',
            'descripcion'=>'max:256',
        ];
    }
}
