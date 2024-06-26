<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreNoteRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            "userid"    => ["required","numeric"],
            "title"     => ["required","string"],
            "badge"     => ["nullable","string"],
            "body"      => ["required","string"],
            "date"      => ["required","date"],
        ];
    }
}
