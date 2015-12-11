@extends('_templates.apptemp')
<!doctype html>
<html lang="es">
<head>
	<title>
		@section('titulo')
		  Nuevo Ingreso
		 @show
         
	</title>
	@yield('head')
</head>
<body>
@section('contenido')
          <?php
        $date = date("d-m-Y");
    ?>
<div class="col-md-6">
    <header id="inicio">
            <h1>Nuevo Ingreso</h1>
            
     </header>
     <section>
     	
     	{{ Form::open(array('url'=>'NuevoMov/addIngreso','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}

								<div class="form-group" >
									<label>Equipo</label>
									<select  class="form-control" name="codequipo">
									@foreach( $todoEquipos as $equi)
										<option class="form-control" value="{{$equi->codequipo}}">{{$equi->codequipo}} {{$equi->nombre}} </option>
									@endforeach
									</select>
								</div>
								
								{{ Form::label('fecha', Lang::get('Fecha: '),array('class'=>'col-sm-1 control-label')) }}
                        <div class="">
                            <input name='fecha' type="text" id="theInput" placeholder="Seleccione Fecha de Ingreso" class="form-control" placeholder="" value=<?php echo $date?> readonly>
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