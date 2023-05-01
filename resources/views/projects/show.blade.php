@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header bg-primary text-white">
            <h3>{{ $project->name }}</h3>
            <h5>Di {{ $project->user->name }}</h5> 
            </div>

                <div class="card-body">
                    <h5 class="card-title">Descrizione del progetto:</h5>
                    <p class="card-text">{{ $project->description }}</p>
                    <h5 class="card-title">URL del progetto:</h5>
                    <p class="card-text"><a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a></p>
                    <h5 class="card-title">Slug del progetto:</h5>
                    <p class="card-text">{{ $project->slug }}</p>
                    <h5 class="card-title">Tipologia:</h5>
                    @if ($project->types->isNotEmpty())
    <p class="card-text">{{ $project->types->first()->name }}</p>
@else
    <p class="card-text">Nessuna tipologia associata</p>
@endif


                    <a href="{{ route('projects.edit', $project->slug) }}" class="btn btn-warning">Modifica progetto</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina progetto</button>
                    </form>
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Torna alla lista dei progetti</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

