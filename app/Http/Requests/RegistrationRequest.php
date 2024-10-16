<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'nid' => 'required|digits_between:1,17|unique:users,nid',
            'email' => 'nullable|string|email||unique:users,email',
            'address' => 'nullable|string',
            'vaccine_center' => 'required|exists:vaccine_centers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'nid.required' => 'Your National ID (NID) is required for registration.',
            'nid.digits_between' => 'Your NID should not exceed 17 digits.',
            'nid.unique' => 'This NID is already associated. Please check and try again.',
            'vaccine_center.required' => 'Please select a vaccine center.',
            'vaccine_center.exists' => 'The selected vaccine center is not valid. Please choose a valid center from the list.',
            'address.string' => 'Please provide a valid address.',
        ];
    }
}
