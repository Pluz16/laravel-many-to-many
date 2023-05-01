@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Project</h1>

    <form action="{{ route('projects.store') }}" method="post">
        @csrf

        @include('error_messages')

        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="user_id">User</label>
            <input type="text" class="form-control" id="user_id" name="user" value="{{ old('user_id') }}" required>
        </div>

        <div class="form-group row">
    <label for="types" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
    <div class="col-md-6">
        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($types as $type)
                <label class="btn btn-outline-secondary {{ in_array($type->id, old('types', [])) ? 'active' : '' }}">
                    <input type="checkbox" name="types[]" value="{{ $type->id }}" autocomplete="off" {{ in_array($type->id, old('types', [])) ? 'checked' : '' }}> {{ $type->name }}
                </label>
            @endforeach
        </div>

        @error('types')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="url">URL</label>
            <input type="url" class="form-control" id="url" name="url" value="{{ old('url') }}">
        </div>


        <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
</div>
@endsection
