@extends('layouts.app')

@section('colorMode')
dark
@endsection

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('All project') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Project manager') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $item)
                                <tr class="">
                                    <td scope="row">{{$item->title}}</td>
                                    <td>{{$item->cover_image}}</td>
                                    <td>{{$item->slug}}</td>
                                    <th><a href="{{ route( 'admin.projects.edit', $item ) }}">Edit Project</a></th>
                                    <th>
                                        <form action="{{ route('project.destroy', $item) }}" method="POST">

                                        @csrf
                                        @method('DELETE')
                                      
                                        <button>Delete</button>
                                      
                                      </form>
                                    </th>
                                </tr>                            
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection