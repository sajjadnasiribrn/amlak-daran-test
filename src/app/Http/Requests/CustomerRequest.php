<?php

namespace App\Http\Requests;

use App\Rules\ValidMobile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'phone_number' => ['required', 'string', new ValidMobile()],
            'email' => ['required', 'email', Rule::unique('customers', 'email')->ignoreModel(optional(request()->email), 'email'),],
            'bank_account_number' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'date_of_birth' => ['required'],
            'first_name' => ['required', Rule::unique('customers')->where(function ($query){
                $query->where('first_name', request()->first_name)
                    ->where('last_name', request()->last_name)
                    ->where('date_of_birth', request()->date_of_birth);
            })]
        ];
    }
}
