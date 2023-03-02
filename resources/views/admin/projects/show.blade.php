@extends('layouts.app')
@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-header">
                    <div class="card-title">
                        <h3>
                            {{$project->title}}
                        </h3>
                    </div>
                    <div class="card-subtitle">
                        @foreach ($project->technologies as $technology)
                            <span class="p-2 badge rounded-pill"
                            style="color: {{ $technology->color }}"> 
                                #{{ $technology->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="card-image mt-3">
                    @if ( str_starts_with($project->image, 'http'))
                        <img src="{{ $project->image }}" alt="Project image" class="img-fluid">
                    @else
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Project image" class="img-fluid">
                    @endif
                </div>
                <div class="card-body">
                    <div class="card-text">
                        {{$project->content}}
                    </div>
                </div>
                <div class="card-footer text-start">
                    <div class="postTopic">
                        Topic: {{$project->topic}}
                    </div>
                    <div class="postDate">
                        Creation time: {{$project->project_date}}
                    </div>
                    <div class="postAuthor">
                        Project author: {{$project->author}}
                    </div>
                </div>

            </div>
            <div class="homeButtonContainer text-center mt-5">
                <a href="{{route('admin.projects.index')}}" class="btn btn-sm btn-primary">Back to the list</a>
            </div>
            <div class="homeButtonContainer text-center mt-2">
                <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-sm btn-warning">Edit</a>
            </div>
            <div class="homeButtonContainer text-center mt-2">
                <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection