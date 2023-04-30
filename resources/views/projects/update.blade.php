@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Project</h1>

    <form action="{{ route('projects.update', $project->id) }}" method="post">
        @csrf
        @method('PUT')

        @include('error_messages')

        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}" required>
        </div>

        <div class="form-group">
            <label for="user_id">User</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ old('user_id', $project->user_id) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="url">URL</label>
            <input type="url" class="form-control" id="url" name="url" value="{{ old('url', $project->url) }}">
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $project->slug) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
</div>
@endsection
