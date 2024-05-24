<?php

namespace App\Http\Requests\Rates;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRateRequest extends FormRequest
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
            "ratename"      => ["required","string"],
            "ratevalue"     => ["required","numeric"],
            "rateminimum"   => ["required","numeric"],
            "cca"           => ["required","numeric"],
            "ccb"           => ["required","numeric"],
            "ccc"           => ["required","numeric"],
            "ccd"           => ["required","numeric"],
        ];
    }
}
