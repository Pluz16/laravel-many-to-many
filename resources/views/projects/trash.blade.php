@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Cestino</h1>
            <hr>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if ($projects->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome progetto</th>
                        <th>Autore</th>
                        <th>Data cancellazione</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->user->name }}</td>
                        <td>{{ $project->deleted_at->diffForHumans() }}</td>
                        <td>
                        <form method="POST" action="{{ route('projects.restore', $project->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit">Ripristina</button>
                        </form>
                            <form action="{{ route('projects.force-delete', $project->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Elimina definitivamente">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Non ci sono progetti nel cestino.</p>
            @endif
        </div>
    </div>
</div>
@endsection
