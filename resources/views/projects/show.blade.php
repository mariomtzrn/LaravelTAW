@extends('layouts.app')
@section('title')
Proyecto: {{$project->titulo}}
@endsection
@section('action')
Información del proyecto @if(auth()->id() == $project->owner_id)<a href="/projects/{{$project->id}}/edit"><i class="fa fa-cog"></i></a>@endif
@endsection
@section('content')
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
@endsection
