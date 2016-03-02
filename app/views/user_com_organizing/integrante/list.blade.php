@extends('_templates.apptemp')

@section('titulo')
    @lang('integrantes')
@stop

@section('rutanavegacion')
    <li><span class="glyphicon glyphicon-user"></span></li>
@stop

@section('nombrevista')
    @lang('Integrantes')
    
@stop


@section('contenido')
<div class="col-md-12 col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style="float: left">INTEGRANTES</div>
            <div style="float: right">
                <div class="form-inline">
                    <div class="form-group">

                        <a class="btn btn-primary margin text-lowercase" type="button" href="{{URL::to('comisionintegrantesadd')}}"><span class="glyphicon glyphicon-plus"></span> Agregar Nuevo</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <!-- BEGIN PARA MANEJO DE ERRORES -->
            @include('alerts.allsuccess')
            <!-- END PARA MANEJO DE ERRORES -->
            <table data-toggle="table" data-url="tables/data2.json">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Rol</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($integrantesall as $val)
                      <tr>
                          <td>{{ $val->dni}}</td>
                          <td>{{ $val->DataDocente[0]->nombre.' '.$val->DataDocente[0]->apellidoP.' '.$val->DataDocente[0]->apellidoM }}</td>
                          <td>{{ $val->codDocente }}</td>
                          <td>{{ $val->rol}}</td>
                          <td>
                              <a class="label label-danger" href="{{URL::to('comision/integrantes/delete/'.$val->dni)}}">
                                  <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                              </a>
                          </td>
                      </tr>
                  @endforeach
                </tbody>
            </table>			    
        </div>
    </div>
</div>
@section ('scrips')
<script src="{{asset('/js/bootstrap-table.js')}}"></script>        
@stop       
	
@endsection
