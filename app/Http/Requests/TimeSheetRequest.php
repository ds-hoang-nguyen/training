<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeSheetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'work_day' => 'required|date',
            'task_contents.*' => 'required|string',
            'work_times.*' => 'required|between:0.0,' . 24 / count($this->request->all('work_times')),
            'difficult' => 'required|string',
            'plan' => 'required|string'
        ];
    }
}
