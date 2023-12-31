<?php

namespace App\Http\Requests\Api\V1\AdminDashboard\Admin\CategoryRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['required','string','unique:categories'],
            'file_name'=>['nullable','image'],
            //'language_id' => ['required','exists:languages,id','numeric'],
        ];
    }
}
