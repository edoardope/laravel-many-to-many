@extends('layouts.app')
@section('content')


<section class="container-fluid">
    <div class="row">
        <img class="img-fluid" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
    </div>
    <div class="row">
        <h1 class="text-center">{{$project->title}}</h1>
    </div>
    <div class="row">
        <h6 class="text-center">type: {{$project->type->name}}</h1>
    </div>
    @foreach ($project->technologies as $elem)
     <div class="h6 text-center"> technologies: {{$elem->name}}</div>
    @endforeach
    
</section>


@endsection