<?php
namespace App\Http\Requests\Api\V1\AdminDashboard\Moderator\MedicineRequest;

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
        'name'=>['required','string','unique:medicines'],
        'company_id'=>['required','exists:companies,id'],
        'category_id'=>['required','exists:categories,id'],
        'file_name'=>['nullable','image'],
      ];
    }
    }
