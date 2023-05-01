<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;

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
        $rules = [
            'name' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|string|max:255|url',
        ];

        // Add the type_id validation rule only if the type exists
        $type = Type::find($this->input('type_id'));
        if ($type) {
            $rules['type_id'] = 'exists:types,id';
        }

        return $rules;
    }
}

