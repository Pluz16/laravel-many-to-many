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
    $selectedTypeId = $request->input('type_id');
    $types = Type::all();

    // Se il tipo selezionato non esiste, reimposta il tipo selezionato a null
    if ($selectedTypeId && !$types->pluck('id')->contains($selectedTypeId)) {
        $selectedTypeId = null;
    }

    $projects = Project::query();

    if ($selectedTypeId) {
        $projects = $projects->where('type_id', $selectedTypeId);
    }
    
    $projects = $projects->get();

    return view('projects.index', compact('projects', 'types', 'selectedTypeId'));
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
    $project->load('type');

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

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
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
