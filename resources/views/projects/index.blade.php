@extends('layouts.app')
@section('title')
Proyectos: Mis proyectos
@endsection
@section('action')
Cliente
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
      </div>
      <!-- /.box -->
    </div>
  @endforeach
@endsection
