<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }

    public function create()
    {
        return view('types.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:types|max:255',
            'description' => 'nullable|max:255',
        ]);

        Type::create($validatedData);

        return redirect()->route('types.index')->with('success', 'Tipo di progetto creato con successo.');
    }

    public function show(Type $type)
    {
        return view('types.show', compact('type'));
    }

    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:types,name,' . $type->id . '|max:255',
            'description' => 'nullable|max:255',
        ]);

        $type->update($validatedData);

        return redirect()->route('types.index')->with('success', 'Tipo di progetto aggiornato con successo.');
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Tipo di progetto eliminato con successo.');
    }
}

