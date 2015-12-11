@extends('_templates.apptemp')
<!doctype html>
<html lang="es">
<head>
	<title>
		@section('titulo')
		  Nuevo Egreso
		 @show
         
	</title>
	@yield('head')
</head>
<body>
@section('contenido')
<div class="col-md-6">
    <header id="inicio">
            <h1>Nuevo Egreso</h1>
            
     </header>
     <section>
     	{{ Form::open(array('url'=>'NuevoMov/addEgreso','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}

  									<div class="form-group" >
									<label>Equipo</label>
									<select  class="form-control" name="codequipo">
									@foreach( $todoEquipos as $equi)
										<option class="form-control" value="{{$equi->codequipo}}">{{$equi->codequipo}} {{$equi->nombre}} </option>
									@endforeach
									</select>
									</div>
								<div class="form-group">
									<label>Fecha</label>
									<input type="date" style="color:black;" name="fecha">
								</div>
								<div class="form-group">
									<label>Descripcion</label>
									<input class="form-control" placeholder="" name="descripcion">
								</div>
							    <div class="form-group">
									<label>Monto Total</label>
									<input class="form-control" placeholder="" name="montototal">
								</div>
								<div class="form-group">
									<label>Cajero</label>
									<input class="form-control" placeholder="Cod miembro" name="codmiembroco">
								</div>
								<button type="submit" class="btn btn-primary">Guardar</button>
								<button type="reset" class="btn btn-default">Limpiar</button>
	{{ Form::close()}}

     </section>
</div>
 @stop

  </body>
 </html>