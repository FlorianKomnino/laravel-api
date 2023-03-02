<div class="container">
    <div class="row">
        <div class="col-12 pt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h3>Check Errors</h3>
                </div>
            @endif
            <form action="{{route($route, $project->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method($formMethod)
                
                <h2 class="text-center m-0 p-3 fw-bold">
                    {{$formMethod === 'POST' ? 'Create a new project' : "Edit the project '$project->title'"}}
                </h2>
                <div class="mb-3">
                    <label for="projectTitle" class="form-label">Project Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="projectTitle" name="title" value="{{old('title',$project->title)}}">
                    @error('title')
                    <div class="errors_container mb-4 alert alert-warning">
                        <div id="popup_message" data-type="warning" data-message="Check errors">{{$message}}</div>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="projectType" class="form-label">Project Title</label>

                    <select class="form-control @error('type_id') is-invalid @enderror" name="type_id" id="projectType">
                    @foreach ($types as $projectType)
                        <option value="{{$projectType->id}}" >{{$projectType->name}}</option>
                    @endforeach
                    </select>

                    @error('type_id')
                    <div class="errors_container mb-4 alert alert-warning">
                        <div id="popup_message" data-type="warning" data-message="Check errors">{{$message}}</div>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="projectContent" class="form-label">Content</label>
                    <textarea class="w-100 @error('content') border-danger @enderror" id="projectContent" name="content" maxlength="500" rows="8">{{old('content',$project->content)}}</textarea>
                    @error('content')
                    <div class="errors_container mb-4 alert alert-warning">
                        <div id="popup_message" data-type="warning" data-message="Check errors">{{$message}}</div>
                    </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="projectTopic" class="form-label">Topic</label>
                    <input type="text" class="form-control @error('topic') is-invalid @enderror" id="projectTopic" name="topic" value="{{old('topic',$project->topic)}}">
                    @error('topic')
                    <div class="errors_container mb-4 alert alert-warning">
                        <div id="popup_message" data-type="warning" data-message="Check errors">{{$message}}</div>
                    </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="project_image" class="form-label">Add an image</label>
                    <input type="file" class="w-100 @error('image') is-invalid @enderror" id="project_image" name="image" value="{{old('image',$project->image)}}">
                    @error('image')
                    <div class="errors_container mb-4 alert alert-warning">
                        <div id="popup_message" data-type="warning" data-message="Check errors">{{$message}}</div>
                    </div>
                    @enderror
                </div>
    
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>