@extends('layouts.app')

@section('content')
<div class="box-body" style="padding-top:50px; padding-bottom:50px">
    <div class="raised very padded text container segment" align="center">
      <h2>{{ __('Registro de Usuario') }}</h2>
      <form class="form" method="POST" action="{{ route('register') }}">
          @csrf
          <div class="form-group row">
              <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
              <div class="col-md-6">
                  <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
              </div>
          </div>
          <div class="form-group row">
              <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
              <div class="col-md-6">
                  <input id="apellido" type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" required autofocus>
              </div>
          </div>
          <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
              <div class="col-md-6">
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
              <div class="col-md-6">
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>
              <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Usuario') }}</label>
              <div class="col-md-6">
                <select class="form-control" id="type" name="type">
                  <option disabled selected>-- Seleccione --</option>
                  <option value="1">Freelancer</option>
                  <option value="2">Cliente</option>
                </select>
              </div>
          </div>
          <div class="container">
              <div class="container" style="padding-top:20px">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Registrarse') }}
                  </button>
              </div>
          </div>
      </form>
      @include('layouts.errors')
    </div>
</div>
@endsection
