<?php

namespace App\Http\Requests\Api\V1\Application\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'birth_date' => ['required', 'date', 'before:' . Date::now()->subYears(8)->format('Y-m-d')],
            'specialty' =>['required','string',Rule::in(array_map('strtolower', ['Doctor', 'Student', 'Pharmacist', 'Other']))],
            'gender' => ['required','string',Rule::in(array_map('strtolower', ['Male', 'Female']))],
            'user_id'=>['required','exists:users,id'],
        ];
    }
}
