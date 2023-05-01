@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <h1 class="mb-4">Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Create New Project</a>
    <a href="{{ route('projects.trash') }}" class="btn btn-secondary">
    Cestino 
    @if($trashedCount > 0)
        <span class="badge badge-danger">{{ $trashedCount }}</span>
    @endif
</a>

    <form action="{{ route('projects.index') }}" method="GET" class="my-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="type_id" class="col-form-label">Filter by Type:</label>
            </div>
            <div class="col-auto">
                <select name="type_id" id="type_id" class="form-select">
                    <option value="">All Types</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == $selectedTypeId ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </div>
            @if ($selectedTypeId)
                <div class="col-auto">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Clear Filter</a>
                </div>
            @endif
        </div>
    </form>

    <div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>User</th>
                <th>Type</th>
                <th>Description</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->user_id }}</td>
                    <td>{{ optional($project->type)->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->url }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('projects.edit', $project->slug) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('projects.destroy', $project->slug) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
