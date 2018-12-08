@extends('layouts.app')
@section('title')
Proyectos disponibles
@endsection
@section('action')
Proyectos
@endsection
@section('content')
@foreach($projects as $project)
  <div class="container">
    <div class="box box-solid">
      <div class="box-header with-border">
        <i class="fa fa-check-square"></i>
        <h3 class="box-title"><a href="/projects/{{$project->id}}">{{$project->titulo}}</a></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <dl class="dl-horizontal">
          <dt>Descripción</dt>
          <dd>{{$project->descripcion}}</dd>
          <dt>Categoria</dt>
          <dd>{{$project->categoria}}</dd>
          <dt>Presupuesto</dt>
          <dd>{{$project->presupuesto}}</dd>
          <dt>Fecha de publicación</dt>
          <dd>{{$project->created_at->format('Y-m-d')}}</dd>
          <dt>Fecha de entrega</dt>
          <dd>{{$project->fecha_entrega}}</dd>
        </dl>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <a href="/projects/{{$project->id}}/create_prop" class="btn btn-block btn-primary" name="button" style="width:15%;float:right">Envíar propuesta</a>
      </div>
    </div>
    <!-- /.box -->
  </div>
@endforeach
@endsection
