@extends('_templates.apptemp')
@section('titulo')
@lang('Varapp.nombre_sistema_mediano')



@stop
@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/docente/listar');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop



@section('nombrevista')
<!--Agregar docente <small> NUEVO DOCENTE </small>  
    @lang('Nuevo Docente')
    -->
@stop

@section('contenido')
  <div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Agregar espectador</div>
					<div class="panel-body">
						<div class="col-md-6">
							{{ Form::open(array('url' => 'espectador/formulario1','method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
								
								<!-- BEGIN PARA MANEJO DE ERRORES -->
		                        @if (count($errors) > 0)
		                        <div class="alert bg-danger" role="alert">
		                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                            <ul class="error_list">
		                                @foreach ($errors->all() as $error)
		                                <li >
		                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
		                                    {{ $error }}
		                                </li>
		                                @endforeach
		                            </ul>
		                        </div>
		                        @endif
		                        <!-- END PARA MANEJO DE ERRORES -->

		                        <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" placeholder="Nombre" name="nombre" value="">
                                </div>
                                <div class="form-group">
                                    <label>nro de asiento</label>
                                    <input class="form-control" placeholder="nro asiento" name="nroasiento" value="">
                                </div>
								<button type="submit" class="btn btn-primary">Guardar</button>
								<button type="reset" class="btn btn-default">Limpiar</button>
							
							{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
			</div>
@stop
@section ('scrips')

    </script>
@stop
@endsection