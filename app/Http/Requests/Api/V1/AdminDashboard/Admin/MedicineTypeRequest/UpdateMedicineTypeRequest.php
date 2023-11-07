<?php

namespace App\Http\Requests\Api\V1\AdminDashboard\Admin\MedicineTypeRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMedicineTypeRequest extends FormRequest
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
        $medicineType = $this->route('medicineType');
        return [
            'type' => ['required', 'string', Rule::unique('medicine_types', 'type')->ignore($medicineType)],
        ];
    }
}
