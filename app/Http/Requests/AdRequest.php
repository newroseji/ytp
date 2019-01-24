<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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

        $rules =[
            'title' => 'required|string|unique:ads',

            'description' => 'required|string',
            'category_id' => 'required',

            'price' => 'required|numeric',

            'expires' => 'required|date|after_or_equal:publish',
            'publish' => 'required|date',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        return $rules;

    }
}
