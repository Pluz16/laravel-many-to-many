@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">{{ $type->name }}</div>

                    <div class="card-body">
                        <p>{{ $type->description }}</p>

                        @if (count($type->projects))
                            <h4>Progetti associati:</h4>
                            <ul>
                                @foreach ($type->projects as $project)
                                    <li><a href="{{ route('projects.show', $project->slug) }}">{{ $project->name }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <p>Nessun progetto associato a questo tipo.</p>
                        @endif

                        <a href="{{ route('types.index') }}" class="btn btn-secondary mt-3">Indietro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
