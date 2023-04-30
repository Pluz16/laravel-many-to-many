@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <h1 class="mb-4">Projects</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>User</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->user }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->url }}</td>
                        <td>
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('projects.edit', $project->slug) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
