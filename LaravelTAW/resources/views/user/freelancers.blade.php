@extends('layouts.app')
@section('title')
Encontrar freelancers
@endsection
@section('action')
Freelancers
@endsection
@section('content')
<div class="row">
@foreach($users as $user)
  <div class="col-md-3">
    <div class="box box-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-aqua-active">
        <h3 class="widget-user-username"><a style="color:white !important;" href="/user/{{$user->id}}/profile">{{ $user->nombre . ' ' . $user->apellido}}</a></h3>
        <h5 class="widget-user-desc">Freelancer</h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle user-pp" src="{{ asset('storage/profile_pictures/' . $user->foto_perfil) }}" alt="User Avatar">
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ $user->projects_done->count() }}</h5>
              <span class="description-text">Proyectos realizados</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h4 class="description-header">
                @for($i=1; $i<=round(\App\Http\Controllers\UsersController::get_calif($user->id)); $i++)
                  <i class="fa fa-star" style="color:gold; width: 10px !important; height: 10px !important;"></i>
                @endfor
                @for($i=1; $i<=(5 - round(\App\Http\Controllers\UsersController::get_calif($user->id))); $i++)
                  <i class="fa fa-star-o" style="color:gray; width: 10px !important; height: 10px !important;"></i>
                @endfor
              </h4>
              <span class="description-text">Calificación</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">{{$user->created_at->format('Y')}}</h5>
              <span class="description-text">Antigüedad</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
  </div>
@endforeach
</div>
<style>
  .widget-user .widget-user-image {
      position: absolute;
      top: 65px;
      left: 50%;
      margin-left: -45px;
  }
  .user-pp {
      display: inline-block !important;
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover !important;
      display: block !important;
      margin: 0 auto !important;
    }
</style>
@endsection
