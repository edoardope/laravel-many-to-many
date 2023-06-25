@extends('layouts.app')
@section('content')


<section class="container-fluid">
    <div class="row">
        @foreach ($project as $item)
        <div class="card col-3 m-5">
            <img class="card-img-top" src="{{ asset('storage/' . $item->cover_image) }}" alt="Title">
            <div class="card-body">
                <h4 class="card-title">{{$item->title}}</h4>
                <p class="card-text">Slug: {{$item->slug}}</p>
                <a href="{{ route('projects.show', ['project' => $item->id]) }}">details</a>
            </div>
        </div>
        @endforeach
        
    </div>
</section>


@endsection