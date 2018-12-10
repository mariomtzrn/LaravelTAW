@extends('layouts.app')
@section('title')
Proyecto: {{$project->titulo}}
@endsection
@section('action')
@if($project->propuesta_user)
  Editar propuesta
@else
  Crear propuesta
@endif
@endsection
@section('content')
@if($project->propuesta_user)
  <form method="post" action="/projects/{{$project->id}}/create_prop">
    @csrf
    @method('PATCH')
    <div class="box-body">
      <div class="form-group">
        <label>Descripción</label>
        <textarea class="form-control" name="descripcion" rows="5" placeholder="Descripción..." style="resize:none">{{ $project->propuesta_user->descripcion }}</textarea>
      </div>
      <div>
        <label>Tiempo necesario</label>
        <input class="form-control" name="tiempo" placeholder="Tiempo" value="{{ $project->propuesta_user->tiempo }}"></input>
      </div>
    <div class="box-footer">
      <input class="form-control" type="hidden" name="id_project" value="{{ $project->id }}"></input>
      <input class="form-control" type="hidden" name="id_prop" value="{{ $project->propuesta_user->id }}"></input>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
  </form>
@else
  <form method="post" action="/projects/{{$project->id}}/create_prop">
    @csrf
    <div class="box-body">
      <div class="form-group">
        <label>Descripción</label>
        <textarea class="form-control" name="descripcion" rows="5" placeholder="Descripción..." style="resize:none">{{old('descripcion')}}</textarea>
      </div>
      <div>
        <label>Tiempo necesario</label>
        <input class="form-control" name="tiempo" placeholder="Tiempo" value="{{old('tiempo')}}"></input>
      </div>
    <div class="box-footer">
      <input class="form-control" type="hidden" name="id_project" value="{{ $project->id }}"></input>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
  </form>
@endif
@include('layouts.errors')
@endsection
