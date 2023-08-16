<?php

namespace App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicineRequest extends FormRequest
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
            'name'=>['required','string'],
            'company_id'=>['required','exists:companies,id'],
            'category_id'=>['required','exists:categories,id'],
            'file_name'=>['nullable','image'],
        ];
    }
}
// 'email' => ['required', 'email','unique:users,email'],
// 'password' =>['required','string','min:8','max:16'],
// 'first_name'=>['required','string','min:2','max:10'],
// 'last_name'=>['required','string','min:2','max:10'],
// 'phone_number'=>['required','size:9'],
// 'birth_date' => ['required', 'date', 'before:' . Date::now()->subYears(8)->format('Y-m-d')],
// 'specialty' =>['required','string',Rule::in(array_map('strtolower', ['Doctor', 'Student', 'Pharmacist', 'Other']))],
// 'gender' => ['required','string',Rule::in(array_map('strtolower', ['Male', 'Female']))],
