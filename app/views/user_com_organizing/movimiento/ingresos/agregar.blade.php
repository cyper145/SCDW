@extends('_templates.apptemp')

@section('titulo')
    @lang('Movimiento')
@stop

@section('estilos')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( '/movimientos');}}"><span class="glyphicon glyphicon-usd"></span></a></li>
    <li>Nuevo ingreso</li>
@stop

@section('nombrevista')
    @lang('Ingreso')
@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allerrors')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo Ingreso</div>
                <div class="panel-body">
                    <div class="col-md-12">
                        {{ Form::open(['url'=>'NuevoMov/addIngreso','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'])}}
                        <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                        <div class="form-group" >
                            <label>Pago del equipo</label>
                            <select  class="form-control" name="codequipo">
                                @foreach( $todoEquipos as $equi)
                                    <option class="form-control" value="{{$equi->codequipo}}">{{$equi->nombre}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Monto Total (S/.)</label>
                            <input class="form-control" placeholder="200" name="montototal" required>
                        </div>

                        <div class="form-group">
                            <label>Descripcion</label>
                            <input class="form-control" placeholder="Pago por Inscripcion" name="descripcion" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-default">Limpiar</button>
                        {{ Form::close()}}
                        <div class="pull-right">
                            <button type="submit" class="btn btn-danger" onclick="history.back()">Cancelar</button>
                        </div>
                        <!-- END CONTENIDO DEL FORMULARIO -->
                    </div>
                </div>
            </div>
        </div>
    </div>
 @stop