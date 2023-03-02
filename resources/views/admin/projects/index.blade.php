@extends('layouts.app')
@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            @if (session('message'))
            <div class="alert alert-{{ session('message_class') }} mb-3">
                {{ session('message') }}
            </div>
        @endif
        </div>
        <div class="col-12">
            <a href="{{route('admin.projects.create')}}" class="btn btn-success">
                Create new Project
            </a>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">type</th>
                        <th scope="col">title</th>
                        <th scope="col">author</th>
                        <th scope="col">content</th>
                        <th scope="col">project_date</th>
                        <th scope="col">topic</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->type->name }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->author }}</td>
                            <td>{{ $project->content }}</td>
                            <td>{{ $project->project_date }}</td>
                            <td>{{ $project->topic }}</td>
                            <td>
                                <div class="actionButtons d-flex">
                                    <a href="{{route('admin.projects.show', $project->id)}}" class="btn btn-sm btn-primary">Show</a>
                                    <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
            {{ $projects->links() }}
        </div>
    </div>
</div>

@endsection