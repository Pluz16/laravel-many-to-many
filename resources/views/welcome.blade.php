@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4 bg-light rounded-3">
    <div class="container py-5">
        <h1 class="display-5 fw-bold">
            Il tuo portfolio a portata di click
        </h1>

        <p class="col-md-8 fs-4">Con il nostro strumento facile da usare, puoi tenere traccia dei tuoi progetti in tempo reale e collaborare con i tuoi colleghi in modo più efficiente che mai.</p>
        <a href="{{ route('projects.index') }}" class="btn btn-primary view-projects-btn">View Projects</a>

    </div>
</div>

<div class="content">
    <div class="container">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis accusamus dolores!</p>
    </div>
</div>
@endsection