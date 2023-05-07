<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projectsQuery = Project::query();
        $selectedTypeId = $request->input('type_id');
        if ($selectedTypeId) {
            $projectsQuery->where('type_id', $selectedTypeId);
        }
        $projects = $projectsQuery->get();
        $trashedCount = Project::onlyTrashed()->count();
        $types = Type::all();
        return view('projects.index', compact('projects', 'types', 'selectedTypeId', 'trashedCount'));
    }
    




    public function create()
{
    $types = Type::all();
    return view('projects.create', compact('types'));
}


public function store(StoreProjectRequest $request)
{
    $validatedData = $request->validated();

    $project = new Project($validatedData);
    $project->user_id = Auth::id();
    $project->slug = Str::slug($project->name);
    $project->save();

    // Check if a type has been selected
    if ($request->input('type_id')) {
        // Find the selected type in the database
        $type = Type::findOrFail($request->input('type_id'));

        // Associate the type with the new project
        $project->type()->associate($type);
        $project->save();
    }
    
    return redirect()->route('projects.index')
                     ->with('success', 'Il progetto è stato creato con successo.');
}


    
    
   public function show($slug)
{
    $project = Project::where('slug', $slug)->firstOrFail();
    $project->load('types');
    return view('projects.show', compact('project'));
}




public function edit($slug)
{
    $project = Project::where('slug', $slug)->firstOrFail();
    $types = Type::all();

    return view('projects.edit', compact('project', 'types'));
}

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validatedData = $request->validated();

    $project->update($validatedData);
    $request->authorize($project);

    return redirect()->route('projects.index')
                     ->with('success', 'Il progetto è stato aggiornato con successo.');
    }

    public function destroy(Project $project, Request $request)
{
    if ($request->has('delete')) {
        $project->forceDelete();
        return redirect()->route('projects.trash')->with('success', 'Progetto eliminato definitivamente.');
    } else {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Progetto eliminato con successo.');
    }
}

public function forceDelete($id)
{
    $project = Project::onlyTrashed()->findOrFail($id);
    $project->forceDelete();
    return redirect()->route('projects.trash')->with('success', 'Progetto eliminato definitivamente.');
}


public function trash()
{
    $projects = Project::onlyTrashed()->get();
    return view('projects.trash', compact('projects'));
}

public function restore($id)
{
    $project = Project::withTrashed()->find($id);

    if (!$project) {
        return response()->json(['error' => 'Project not found'], 404);
    }

    $project->restore();

    return redirect()->route('projects.index')->with('success', 'Project successfully restored.');
}




    public function types($id)
{
    $project = Project::findOrFail($id);
    $types = Type::all();

    return view('projects.types')->with([
        'project' => $project,
        'types' => $types,
    ]);
}



}
