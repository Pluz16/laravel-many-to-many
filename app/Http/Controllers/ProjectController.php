<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

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

    public function store(StoreProjectRequest $request)
    {
        $validatedData = $request->validated();

        $project = new Project($validatedData);
        $project->user_id = Auth::id();
        $project->save();
    
        return redirect()->route('projects.index')
                         ->with('success', 'Il progetto è stato creato con successo.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validatedData = $request->validated();

    $project->update($validatedData);
    $request->authorize($project);

    return redirect()->route('projects.index')
                     ->with('success', 'Il progetto è stato aggiornato con successo.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
