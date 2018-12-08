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
        <h3 class="widget-user-username"><a style="color:white !important;" href="/user/{{$user->id}}/freelancer">{{ $user->nombre . ' ' . $user->apellido}}</a></h3>
        <h5 class="widget-user-desc">Freelancer</h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle" src="{{asset('adminlte/dist/img/user1-128x128.jpg')}}" alt="User Avatar">
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">3,200</h5>
              <span class="description-text">PROYECTOS</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h4 class="description-header">
                <i class="fa fa-star-o" style="width: 10px !important; height: 10px !important;"></i>
                <i class="fa fa-star-o" style="width: 10px !important; height: 10px !important;"></i>
                <i class="fa fa-star-o" style="width: 10px !important; height: 10px !important;"></i>
                <i class="fa fa-star-o" style="width: 10px !important; height: 10px !important;"></i>
                <i class="fa fa-star-o" style="width: 10px !important; height: 10px !important;"></i>
              </h4>
              <span class="description-text">CALIFICACIÓN</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">{{$user->created_at->format('Y')}}</h5>
              <span class="description-text">ANTIGÜEDAD</span>
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
@endsection
