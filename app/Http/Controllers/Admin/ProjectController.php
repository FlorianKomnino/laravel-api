<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project as Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    protected $validationRules = [
        'title' => 'required|unique:projects|string|min:2|max:255',
        'content' => 'required|string|min:2|max:500',
        'topic' => 'required|string|min:2|max:100',
        'image' => 'required|image|max:256',
        'type_id' => 'required|exists:types,id',
        'technologies' => 'array|exists:technologies,id'
    ];

    protected $validationErrorMessages = [
        'title.required' => 'Il titolo è necessario.',
        'title.unique' => 'Il titolo non può essere uguale ad un altro titolo in archivio.',
        'title.min' => 'Il titolo deve essere lungo almeno 2 caratteri.',
        'title.max' => 'Il titolo non può superare i 255 caratteri.',

        'content.required' => 'Il contenuto è necessario.',
        'content.min' => 'Il contenuto deve essere lungo almeno 2 caratteri.',
        'content.max' => 'Il contenuto non può superare i 500 caratteri.',

        'topic.required' => 'L\'argomento è necessario.',
        'topic.image' => 'L\'argomento deve essere lungo almeno 2 caratteri.',
        'topic.max' => 'L\'argomento non può superare i 100 caratteri.',

        'image.required' => 'L\'immagine è necessaria.',
        'image.image' => 'Il file caricato deve essere un\'immagine.',
        'image.max' => 'L\'immagine è troppo grande. (max: 256kb)',

        'thechnologies.array' => 'L\'elemento inserito non è un array',
        'thechnologies.exists' => 'L\'elemento inserito non è valido'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles()->pluck('id')->contains(1)) {
            $projects = Project::paginate(15);
        } else {
            $projects = Project::where('author', Auth::user()->name)->paginate(15);
        }


        return view('admin.projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create', ['project' => new Project(), 'types' => Type::all(), 'technologies' => Technology::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->validationRules;
        $errorMessages = $this->validationErrorMessages;
        $data = $request->validate($rules, $errorMessages);
        $data['image'] =  Storage::put('imgs/', $data['image']);

        $newProject = new Project;
        $newProject->author = Auth::user()->name;
        $newProject->project_date = now();
        $newProject->fill($data);
        $newProject->save();

        $newProject->technologies()->sync($data['technologies']);
        $newProject->slug = $newProject->id . '-' . Str::slug($newProject->title, '-');
        $newProject->update();
        return redirect()->route('admin.projects.index')->with('message', "Il progetto '$newProject->title', è stato creato con successo.")->with('message_class', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', ['project' => $project, 'types' => Type::all(), 'technologies' => Technology::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $rules = $this->validationRules;
        $rules['title'] = ['required', Rule::unique('projects')->ignore($project->id)];
        $errorMessages = $this->validationErrorMessages;
        $data = $request->validate($rules, $errorMessages);

        $data['image'] = Storage::put('/imgs', $data['image']);

        $project->title = $data['title'];
        $project->content = $data['content'];
        $project->image = $data['image'];
        $project->topic = $data['topic'];

        $project->project_date = now();
        $project->save();

        $project->technologies()->sync($data['technologies']);
        $project->slug = $project->id . '-' . Str::slug($project->title, '-');
        $project->update();
        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
