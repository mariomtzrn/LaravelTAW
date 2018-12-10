<?php

namespace App\Http\Controllers;

use App\Project;
use App\Propuesta;
use App\Calification;
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
        $this->middleware('owner')->only(
          'edit',
          'destroy'
        );
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

    /**
     * Valida los campos del form para crear o editar un proyecto
     *
     * @return void
     */
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
  
    /**
     * Valida los campos del form para crear o editar una propuesta
     *
     * @return void
     */
    protected function validatePropuesta(){
      return $campos = request()->validate([
        'descripcion'=>['required', 'min:15', 'max:255'],
        'tiempo'=>['required'],
        'id_project'=>['required']
      ]);
    }

    /**
     * Muestra una vista con los proyectos disponibles
     * Solo muestra los proyectos que no son del usuario en sesion
     *
     * @return void
     */
    public function search()
    {
        $projects = Project::all()->where('owner_id', '!=', auth()->id());
        return view('projects.search', compact('projects'));
    }

    /**
     * Muestra una vista para crear una nueva propuesta
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function create_prop($id)
    {
        $project = Project::where('id', $id)->first();
        return view('projects.create_prop', compact('project'));
    }
  
    /**
     * Almacena la propuesta creada
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_prop_store(Request $request){
        $campos = $this->validatePropuesta();
        $campos['id_user'] = auth()->id();
        $propuesta = Propuesta::create($campos);
        return redirect('/search_projects');
    }
  
    /**
     * Almacena la edicion de la propuesta
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_prop_update(Request $request){
        $campos = $this->validatePropuesta();
        Propuesta::where('id', $request['id_prop'])->update($campos);
        return redirect('/search_projects');
    }
  
    /**
     * Edita el estado de la propuesta que se va a aceptar
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function acept_prop(Request $request){
        $campos = request()->validate([
          'id_project'=>['required']
        ]);
        $campos['estado'] = 1;
        Propuesta::where('id', $request['id_prop'])->update($campos);
        return redirect('/projects/' . $request['id_project']);
    }
  
    /**
     * Edita el estado del proyecto y propuesta, ademas de crear una nueva relacion de calificacion
     * entre los usuarios relacionados
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function end_project(Request $request){
        $campos_act_proj = ['estado'=>1];
        $campos_calif = request()->validate([
          'id_user_calificado'=>['required'],
          'id_project'=>['required'],
          'comentario'=>['required', 'max:150'],
          'calificacion'=>['required'],
        ]);
        $campos_calif['id_user_calificador'] = auth()->id();
        $campos_prop = ['estado'=>2];
        Project::where('id', $request['id_project'])->update($campos_act_proj);
        Calification::create($campos_calif);
        Propuesta::where('id', $request['id_prop'])->update($campos_prop);
        return redirect('/projects/' . $request['id_project']);
    }
    
    /**
     * Edita el estado de la propuesta, una vez que se marca el proyecto como terminado
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function end_prop($fields){
        Propuesta::where('id', $fields['id_prop'])->update(['estado'=>2]);
    }
}
