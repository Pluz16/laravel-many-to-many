@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ __('Project Types') }}</span>
                            <a href="{{ route('types.create') }}" class="btn btn-primary">{{ __('Add New Type') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Description') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($types as $type)
                                    <tr>
                                        <th scope="row">{{ $type->id }}</th>
                                        <td>{{ $type->name }}</td>
                                        <td>{{ $type->description }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="{{ __('Actions') }}">
                                                <a href="{{ route('types.show', $type->id) }}" class="btn btn-primary">{{ __('Show') }}</a>
                                                <a href="{{ route('types.edit', $type->id) }}" class="btn btn-secondary">{{ __('Edit') }}</a>
                                                <form action="{{ route('types.destroy', $type->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">{{ __('No types found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
