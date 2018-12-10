@extends('layouts.app')
@section('title')
Propuestas
@endsection
@section('action')
Mis propuestas
@endsection
@section('content')
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#pendientes" data-toggle="tab">Pendientes</a></li>
    <li><a href="#aceptadas" data-toggle="tab">Aceptadas</a></li>
    <li><a href="#done" data-toggle="tab">Terminadas</a></li>
  </ul>
  <div class="tab-content">
    <div class="active tab-pane" id="pendientes">
      @foreach(Auth()->user()->propuestas->where('estado', 0) as $prop)
      <!-- Post -->
      <div class="post">
        <div class="user-block">
          <img class="img-circle img-bordered-sm" src="https://img.icons8.com/ios/1600/project.png" alt="user image">
          <span class="username">
            <a href="#">{{ $prop->get_project($prop['id_project'])->titulo }}</a>
          </span>
          <span class="description">{{ $prop->get_project($prop['id_project'])->created_at->format('d-m-Y') }}</span>
        </div>
        <!-- /.user-block -->
        <p>
          {{ $prop->descripcion }}
        </p>
      </div>
      <!-- /.post -->
    @endforeach
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="aceptadas">
      @foreach(Auth()->user()->propuestas->where('estado', 1) as $prop)
      <!-- Post -->
      <div class="post">
        <div class="user-block">
          <img class="img-circle img-bordered-sm" src="https://img.icons8.com/ios/1600/project.png" alt="user image">
          <span class="username">
            <a href="#">{{ $prop->get_project($prop['id_project'])->titulo }}</a>
          </span>
          <span class="description">{{ $prop->get_project($prop['id_project'])->created_at->format('d-m-Y') }}</span>
        </div>
        <!-- /.user-block -->
        <p>
          {{ $prop->descripcion }}
        </p>
      </div>
      <!-- /.post -->
    @endforeach
    </div>
    <!-- /.tab-pane -->
    <div class="tab-pane" id="done">
      @foreach(Auth()->user()->propuestas->where('estado', 2) as $prop)
      <!-- Post -->
      <div class="post">
        <div class="user-block">
          <img class="img-circle img-bordered-sm" src="https://img.icons8.com/ios/1600/project.png" alt="user image">
          <span class="username">
            <a href="#">{{ $prop->get_project($prop['id_project'])->titulo }}</a>
          </span>
          <span class="description">{{ $prop->get_project($prop['id_project'])->created_at->format('d-m-Y') }}</span>
        </div>
        <!-- /.user-block -->
        <p>
          {{ $prop->descripcion }}
        </p>
      </div>
      <!-- /.post -->
    @endforeach
    </div>
    <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->
  </div>
  <!-- /.nav-tabs-custom -->
@endsection
