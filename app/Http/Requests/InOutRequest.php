<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InOutRequest extends FormRequest
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
            'id_materials' => ['required', 'numeric'],
            'qty' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'remark' => ['required', 'string'],
        ];
    }
}
