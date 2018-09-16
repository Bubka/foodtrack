<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'name' => 'required',
            'kcal' => 'required|numeric',
            'protein' => 'required|numeric',
            'carb' => 'required|numeric',
            'lipid' => 'required|numeric',
            'baseWeight' => 'required|numeric',
            'unitWeight' => 'required|numeric',
        ];
    }
}
