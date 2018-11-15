<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntakeRequest extends FormRequest
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
            'ate_on' => 'required|date',
            'food_id' => 'exists:foods,id',
            'meal' => 'required',
            'weight' => 'required_without:number|numeric|nullable',
            'number' => 'required_without:weight|numeric|nullable',
        ];
    }
}
