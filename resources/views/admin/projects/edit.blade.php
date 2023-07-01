@extends('layouts.app')

@section('colorMode')
dark
@endsection

@section('content')
<div class="container p-5">
    <div class="row ">
        <h2 class="mb-3">Edit project details:</h2>
        <form class="bg-primary-subtle p-3 rounded" action="{{ route( 'projects.update', $project ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="" class="form-label">Title:</label>
              <input type="text" name="title" class="form-control" value="{{ old('title') ?? $project->title }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Copertina</label>
                <input type="file" class="form-control" name="cover_image" id="" placeholder="" aria-describedby="fileHelpId">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Slug:</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') ?? $project->slug }}">
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Project type:</label>
                <select name="type_id" class="form-control @error('type_id') is-invalid @enderror" id="type_id">
                    @foreach ($types as $elem)
                        <option value="{{ $elem->id }}" {{ old('type_id', $project->type_id) == $elem->id ? 'selected' : '' }}>
                            {{ $elem->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">

                @foreach( $technologies as $elem )
                
                <div class="form-check @error('tags') is-invalid @enderror">
                
                      @if( $errors->any() )
                      <input class="form-check-input" type="checkbox" name="tags[]" value="{{$elem->id}}" id="post-checkbox-{{$elem->id}}"
                       {{ in_array( $elem->id, old('tags', [] ) ) ? 'checked' : '' }}>
                      @else
                      <input class="form-check-input" type="checkbox" name="tags[]" value="{{$elem->id}}" id="post-checkbox-{{$elem->id}}"
                       {{ ( $project->technologies->contains($elem) ) ? 'checked' : '' }}>
                      @endif
                      <label class="form-check-label" for="post-checkbox-{{$elem->id}}">
                        {{$elem->name}}
                      </label>
                </div>
                
                @endforeach
                
                </div>
                
                @error('tags')
                <div class="alert alert-danger">
                {{$message}}
                </div>
                @enderror
            <input class="btn btn-primary" type="submit" value="Submit" >
        </form>
    </div>
</div>
@endsection