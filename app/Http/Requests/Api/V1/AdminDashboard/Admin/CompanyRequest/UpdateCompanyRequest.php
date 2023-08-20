<?php

namespace App\Http\Requests\Api\V1\AdminDashboard\Admin\CompanyRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
        $company = $this->route('company');
        return [
            'name' => ['required','string',Rule::unique('companies', 'name')->ignore($company)],
            'file_name'=>['nullable','image'],
            //'language_id' => ['required', 'exists:languages,id', 'numeric'],
        ];
    }
}
