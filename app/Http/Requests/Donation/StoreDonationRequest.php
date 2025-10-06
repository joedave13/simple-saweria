<?php

namespace App\Http\Requests\Donation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreDonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', Rule::exists('users', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'amount' => ['required', 'numeric', 'min:1000'],
            'message' => ['nullable', 'max:1000']
        ];
    }
}
