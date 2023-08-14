<?php

namespace App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineDetailRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicineDetailRequest extends FormRequest
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
            'medicine_type_id' => ['required', 'exists:medicine_types,id'],
            'content' => ['required', 'string'],
            'medicine_id' => ['required', 'exists:medicines,id'],
        ];
    }
}
