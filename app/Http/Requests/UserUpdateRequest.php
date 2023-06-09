<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function PHPUnit\Framework\returnValueMap;

class UserUpdateRequest extends FormRequest
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
        if (!empty($this->request->all()['password'])) {
            $validate['password'] = 'confirmed|min:6';
        }

        $validate['avatar'] = 'mimes:png,jpg,jpeg|max:2048';
        return $validate;
    }
}
