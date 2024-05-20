<?php

namespace App\Http\Requests\Accounts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "consumerid"       => ["required","numeric"],
            "meterid"          => ["required","numeric"],
            "balance"           => ["nullable","numeric"],
        ];
    }
}
