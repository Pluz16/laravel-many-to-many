<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
{
    return Auth::check();
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|string|max:255|url',
            'type_id' => 'nullable|exists:types,id'

        ];
    }
}
