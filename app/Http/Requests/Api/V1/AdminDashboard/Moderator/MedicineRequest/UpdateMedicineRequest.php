<?php

namespace App\Http\Requests\Api\V1\AdminDashboard\Moderator\MedicineRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMedicineRequest extends FormRequest
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
        $medicine = $this->route('medicine');
        return [
            'name' => ['required', 'string', Rule::unique('medicines', 'name')->ignore($medicine)],
            'company_id' => ['required', 'exists:companies,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'file_name' => ['nullable', 'image'],
        ];
    }
}
