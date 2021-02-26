<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title'     => 'required|string|min:3|unique:projects,title',
            'details'   => 'required|string',
            'start_date'  => 'required|date|date_format:Y-m-d|before:end_date',
            'end_date'    => 'required|date|date_format:Y-m-d|after:start_date',
        ];
    }
}
