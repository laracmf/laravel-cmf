<?php

namespace GrahamCampbell\BootstrapCMS\Http\Requests;

use GrahamCampbell\BootstrapCMS\Http\Requests\Request;

class ConfigutationRequest extends Request
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
            'name'  => 'required|max:255|name_unique:' . $this->name,
            'keys' => 'required|array|filled',
            'values' => 'required|array|filled'
        ];
    }
}
