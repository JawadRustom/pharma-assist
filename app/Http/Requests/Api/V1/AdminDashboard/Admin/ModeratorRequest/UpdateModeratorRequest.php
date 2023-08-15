<?php

namespace App\Http\Requests\Api\V1\AdminDashboard\Admin\ModeratorRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateModeratorRequest extends FormRequest
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
            $moderator = $this->route('moderator');
            return [
                'first_name' => ['required','string','min:2','max:16'],
                'last_name' => ['required','string','min:2','max:16'],
                'email' => ['required', 'email',Rule::unique('users', 'email')->ignore($moderator)],
                'password' => ['required','string','min:8','max:16'],
                'phone_number' => ['required','size:9'],
            ];
        }
}
