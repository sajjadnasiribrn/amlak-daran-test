<?php

namespace App\Http\Requests;

use App\Rules\ValidMobile;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    public $validator = null;
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
        $required_rule = request()->getMethod() == "PATCH" ? 'nullable' : 'required';

        return [
            'phone_number' => [$required_rule, 'string', new ValidMobile()],
            'email' => [$required_rule, 'email', Rule::unique('customers', 'email')->ignoreModel(optional(request()->email), 'email'),],
            'bank_account_number' => [$required_rule, 'string'],
            'last_name' => [$required_rule, 'string'],
            'date_of_birth' => [$required_rule],
            'first_name' => [$required_rule, Rule::unique('customers')->where(function ($query){
                $query->where('first_name', request()->first_name)
                    ->where('last_name', request()->last_name)
                    ->where('date_of_birth', request()->date_of_birth);
            })]
        ];
    }

    /**
     * Returns validator if it fails to validate
     *
     */
    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
