<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|string|max:255|url',
            'slug' => 'required|string|max:255|unique:projects',
        ]);

        $project = Project::create($validatedData);

        return redirect()->route('projects.show', $project->slug)->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|string|max:255|url',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('projects')->ignore($project->id),
            ],
        ]);

        $project->update($validatedData);

        return redirect()->route('projects.show', $project->slug)->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
