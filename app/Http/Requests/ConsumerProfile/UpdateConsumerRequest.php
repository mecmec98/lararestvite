<?php

namespace App\Http\Requests\ConsumerProfile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateConsumerRequest extends FormRequest
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
            "firstname"     => ["required","string"],
            "middlename"    => ["required","string"],
            "lastname"      => ["required","string"],
            "gender"        => ["required","string"],
            
            "street"        => ["required","string"],
            "building"      => ["nullable","string"],
            "barangay"      => ["required","string"],
            "city"          => ["required","string"],
            "region"        => ["required","string"],
            "zipcode"       => ["required","string"],
            
            "phonenumber"   => ["required","string"],
        ];
    }
}
