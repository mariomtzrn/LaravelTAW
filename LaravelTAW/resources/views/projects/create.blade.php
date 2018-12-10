@extends('layouts.app')
@section('title')
Proyectos: Crear proyecto
@endsection
@section('action')
Crear proyecto
@endsection
@section('content')
<form method="post" action="/projects">
  @csrf
  <div class="box-body">
    <div class="form-group">
      <label for="titulo">Titulo</label>
      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" value="{{ old('titulo') }}">
    </div>
    <div class="form-group">
      <label>Descripción</label>
      <textarea class="form-control" name="descripcion" rows="5" style="resize:none;" placeholder="Descripción...">{{ old('descripcion') }}</textarea>
    </div>
    <div class="form-group">
      <label for="presupuesto">Presupuesto</label>
      <select class="form-control" id="presupuesto" name="presupuesto" value="{{ old('presupuesto') }}">
        <option>--Seleccione--</option>
        <option>Menos de MXN$1,000</option>
        <option>MXN$1,000 - MXN$2,000</option>
        <option>MXN$2,000 - MXN$5,000</option>
        <option>MXN$5,000 - MXN$10,000</option>
        <option>MXN$10,000 - MXN$20,000</option>
        <option>MXN$20,000 - MXN$60,000</option>
        <option>Más de MXN$60,000</option>
      </select>
    </div>
    <label for="fecha_entrega">Fecha de entrega</label>
    <div class="input-group">
     <div class="input-group-addon">
      <i class="fa fa-calendar">
      </i>
     </div>
     <input class="form-control" id="fecha_entrega" name="fecha_entrega" style="resize:none;" placeholder="MM/DD/YYYY" type="text" value="{{ old('fecha_entrega') }}"/>
    </div>
    <div class="form-group">
      <label for="categoria">Categoria</label>
      <select class="form-control" id="categoria" name="categoria" value="{{ old('categoria') }}">
        <option>--Seleccione--</option>
        <option value="Programación móvil">Programación móvil</option>
        <option value="Programación web">Programación web</option>
        <option value="Diseño de logo">Diseño de logo</option>
        <option value="Diseño web">Diseño web</option>
        <option value="Redacción de articulos">Redacción de articulos</option>
        <option value="e-Commerce">e-Commerce</option>
        <option value="Publicidad">Publicidad</option>
        <option value="Ilustraciones">Ilustraciones</option>
        <option value="Wordpress">Wordpress</option>
        <option value="Contenido para sitios web">Contenido para sitios web</option>
        <option value="Crear o editar video">Crear o editar video</option>
        <option value="Otros">Otros</option>
      </select>
    </div>
  </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@include('layouts.errors')
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function(){
  var date_input=$('input[name="fecha_entrega"]'); //our date input has the name "date"
  var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
  var options={
    format: 'yyyy-mm-dd',
    container: container,
    todayHighlight: true,
    autoclose: true,
  };
  date_input.datepicker(options);
})
</script>
@endsection
