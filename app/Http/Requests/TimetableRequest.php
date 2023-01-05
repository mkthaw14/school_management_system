<?php

namespace App\Http\Requests;

use App\Models\Timetable;
use Illuminate\Foundation\Http\FormRequest;

//https://laravel.com/docs/5.3/validation#form-request-validation
class TimetableRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "teacher_id" => "required|numeric",
            "day_id" => "required|numeric",
            "time_id" => "required|numeric",
            "section_id" => "required|numeric",
            "subject_id" => "required|numeric"
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'section_id.numeric' => 'A section is required',
            'subject_id.numeric'  => 'A subject is required',
        ];
    }
}
