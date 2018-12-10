@extends('layouts.app')

@section('content')
<div class="box-body" style="padding-top:50px; padding-bottom:50px">
  <div class="ui raised very padded text container segment" align="center">
      <h2>{{ __('Inicio de Sesión') }}</h2>
      <form class="ui form" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group row">
              <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
              <div class="col-md-6">
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
              <div class="col-md-6">
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
              </div>
          </div>
          <div class="form-group">
              <div class="container" style="padding-top:10px">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Iniciar Sesión') }}
                  </button>
              </div>
          </div>
      </form>
      @include('layouts.errors')
    </div>
</div>
@endsection
