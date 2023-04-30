<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Project $project)
{
    return $this->user()->owns($project);
}


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
{
    $project = $this->route('project');

    return [
        'name' => 'required|string|max:255',
        'user_id' => 'required|string|max:255',
        'description' => 'nullable|string',
        'url' => 'nullable|string|max:255|url',
        'slug' => [
            'required',
            'string',
            'max:255',
            Rule::unique('projects')->ignore($project->id),
        ]
    ];
}


    
}
