<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $projects = auth()->user()->projects;
      return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = $this->validateProject();
        $campos['owner_id'] = auth()->id();
        $project = Project::create($campos);
        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $propuestas = $project->propuestas;
        return view('projects.show', compact('project', 'propuestas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        #$this->authorize('edit', $project, 'owner_id');
        #dd(auth()->id());
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Project::where('id', $id)->update($this->validateProject());
        return redirect('/projects/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect('/projects');
    }

    protected function validateProject()
    {
      return $campos = request()->validate([
        'titulo'=> ['required', 'min:5', 'max:255'],
        'descripcion'=> ['required', 'min:10'],
        'presupuesto'=> ['required'],
        'fecha_entrega'=> ['required'],
        'categoria'=> ['required']
      ]);
    }

    public function search()
    {
        $projects = Project::all()->where('owner_id', '!=', auth()->id());
        return view('projects.search', compact('projects'));
    }

    public function create_prop($id)
    {
        $project = Project::where('id', $id);
        return view('projects.create_prop', compact('project'));
    }
}
