@extends('layouts.app')
@section('title')
Proyecto: {{$project->titulo}}
@endsection
@section('action')
Información del proyecto 
  @if(auth()->id() == $project->owner_id)
    @if($project->estado == 0)
      <a href="/projects/{{$project->id}}/edit"><i class="fa fa-cog"></i></a>
    @endif
  @endif
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
  <dt>Propuestas</dt>
  <dd>{{$project->propuestas->count()}}</dd>
  <dt>Estado</dt>
  <dd>
    @if($project->estado == 1)
    Terminado
    @else
    Activo
    @endif
  </dd>
</dl>
<!-- IF PARA VERIFICAR QUE EL USUARIO EN SESION SEA EL DUEÑO DEL PROJECT -->
@if(auth()->id() == $project->owner_id)
  <div class="form-group margin-bottom-none">
    <div class="col-sm-11">
    </div>
    <div class="col-sm-1">
      <a class="btn btn-default" href="/projects">Volver</a>
    </div>
  </div>
  @if(!$project->propuesta_terminada)
    <!-- IF PARA VERIFICAR QUE EXISTA UNA PROPUESTA ACEPTADA -->
    @if($project->propuesta_aceptada)
      <h4>Propuesta aceptada</h4>
      <div class="container">
        <div class="user-block">
          <img class="img-circle img-bordered-sm" src="{{ asset('storage/profile_pictures/' . $project->propuesta_aceptada->owner($project->propuesta_aceptada->id_user)->foto_perfil) }}" alt="user image">
          <span class="username">
            <a href="#">{{ $project->propuesta_aceptada->owner($project->propuesta_aceptada->id_user)->nombre .
                                          ' ' . $project->propuesta_aceptada->owner($project->propuesta_aceptada->id_user)->apellido}}</a>
          </span>
          <span class="description">{{ $project->created_at->format('d-m-Y H:i') }}</span>
        </div>
        <!-- /.user-block -->
        <p>
          {{ $project->propuesta_aceptada->descripcion }}
        </p>
      </div>
      <div class="form-group margin-bottom-none">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
          @if($project->estado == 1)
            <a class="btn btn-primary" href="#" disabled>Proyecto terminado</a>
          @else
            <a class="btn btn-primary" href="#">Contactar freelancer</a>
            <button class="btn btn-success" data-toggle="modal" data-target="#favoritesModal">Terminar proyecto</button>
          @endif
          <a class="btn btn-default" href="/projects">Volver</a>
        </div>
      </div>
      <!-- SI NO HAY PROPUESTA ACEPTADA AUN, MUESTRA LAS PROPUESTAS -->
    @elseif(!$project->propuesta_aceptada)
      @if($project->propuestas->where('estado', 0))
      <h4>Propuestas disponibles</h4>
        @foreach($project->propuestas->where('estado', 0) as $prop)
        <div class="container">
          <div class="user-block">
            <img class="img-circle img-bordered-sm" src="{{ asset('storage/profile_pictures/' . $prop->owner($prop->id_user)->foto_perfil) }}" alt="user image">
            <span class="username">
              <a href="#">{{ $prop->owner($prop->id_user)->nombre . ' ' .  $prop->owner($prop->id_user)->apellido}}</a>
            </span>
            <span class="description">{{ $prop->get_project($prop['id_project'])->created_at->format('d-m-Y') }}</span>
          </div>
          <!-- /.user-block -->
          <p>
            {{ $prop->descripcion }}
          </p>
          <div class="form-group margin-bottom-none">
            <div class="col-sm-9">
            </div>
            <div class="col-sm-3">
              @if($prop->estado == 1)
                <button class="btn btn-primary pull-right btn-block btn-sm" disabled>Propuesta aceptada</button>
              @else
                <form method="post" action="/projects/{{$project->id}}/acept_prop">
                  @method('PUT')
                  @csrf
                  <input type="hidden" value="{{$project->id}}" name="id_project"></input>
                  <input type="hidden" value="{{$prop->id}}" name="id_prop"></input>
                  <input type="hidden" value="{{$prop->estado}}" name="estado"></input>
                  <button type="submit" class="btn btn-primary pull-right btn-block btn-sm">Aceptar propuesta</button>
                </form>
              @endif
            </div>
          </div>
        </div>
       @endforeach        
      @endif
    @endif
  @else
    <h4>Proyecto terminado</h4>
  @endif
@elseif(auth()->id() != $project->owner_id)
  <div class="box-footer">
    @if($project->estado == 1)
      <a class="btn btn-primary" href="#" disabled>Proyecto terminado</a>
      <a class="btn btn-default" href="/search_projects" style="float:right">Volver</a>
    @elseif($project->estado == 0)
      @if($project->propuesta_user)
        <a href="/projects/{{$project->id}}/create_prop" class="btn btn-info" name="button" style="float:right">Editar propuesta</a>
      @else
        <a href="/projects/{{$project->id}}/create_prop" class="btn btn-primary" name="button" style="float:right">Envíar propuesta</a>
      @endif
        <a class="btn btn-default" href="/search_projects" style="float:right">Volver</a>
    @endif
  </div>
@endif
<!-- IF PARA EL MODAL, SE ACTIVA SI EL USUARIO ES EL DUEÑO -->
@if(auth()->id() == $project->owner_id)
  <!-- IF PARA EL MODAL, SE ACTIVA CUANDO EXISTE UNA PROPUESTA ACEPTADA -->
  @if($project->propuesta_aceptada)
    <!-- MODAL PARA TERMINAR PROYECTO -->
    @if($project->estado == 0)
      <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close"
                data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"
              id="favoritesModalLabel">Calificar freelancer</h4>
            </div>
            <div class="modal-body">
              <form method="post" action="/projects/{{$project->id}}/end_project">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <input type="hidden" value="{{$project->id}}" name="id_project"></input>
                  <input type="hidden" value="{{$project->propuesta_aceptada->id}}" name="id_prop"></input>
                  <input type="hidden" value="{{$project->propuesta_aceptada->id_user}}" name="id_user_calificado"></input>
                  <input type="hidden" value="{{$project->estado}}" name="estado"></input>
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ asset('storage/profile_pictures/' . $project->propuesta_aceptada->owner($project->propuesta_aceptada->id_user)->foto_perfil) }}" alt="user image">
                    <span class="username">
                      <a href="#">{{ $project->propuesta_aceptada->owner($project->propuesta_aceptada->id_user)->nombre .
                                                    ' ' . $project->propuesta_aceptada->owner($project->propuesta_aceptada->id_user)->apellido}}</a>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <label>Comentario:</label>
                  <textarea class="form-control" name="comentario" rows="2" placeholder="Comentarios..." style="resize:none;"></textarea>
                </div>
                <div class="fields">
                  <label>Calificación:</label>
                  <select class="form-control" name="calificacion">
                    <option value="1">1 estrella</option>
                    <option value="2">2 estrellas</option>
                    <option value="3">3 estrellas</option>
                    <option value="4">4 estrellas</option>
                    <option value="5">5 estrellas</option>
                  </select>
                </div>
              <!--/form-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Aceptar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    @endif
  @endif
@endif
@endsection