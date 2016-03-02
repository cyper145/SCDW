@extends('_templates.apptemp')

@section('titulo')
    @lang('usuarios del sistema')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( '/usuariocorg/listar');}}"><span > Usuarios comision organizadora</span></a></li>
@stop

@section('nombrevista')
    @lang('Usuarios')
    
@stop


@section('contenido')
<div class="nav navbar-top-links navbar-right">
    <div class="dropdown">
    <a class="btn btn-default btn-circle margin" data-toggle="dropdown" href="#">
        <i class="glyphicon glyphicon-plus"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{URL::to('usuariocrear')}}">
                <div>
                    <em class="glyphicon glyphicon-plus"></em> Nuevo Administrador
                </div>
            </a>
        </li>
        <li>
            <a href="{{URL::to('usuarioequipocrear')}}">
                <div>
                    <em class="glyphicon glyphicon-plus"></em> Nuevo Equipo
                </div>
            </a>
        </li>
        <li>
            <a href="{{URL::to('usuariocorgcrear')}}">
                <div>
                    <em class="glyphicon glyphicon-plus"></em> Nueva Comisión Organizadora
                </div>
            </a>
        </li>   
    </ul>
    </div>
</div>
<div class="col-md-12 col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">lista de usuarios de tipo comision organizadora</div>
        <div class="panel-body">
                    <!-- BEGIN PARA MANEJO DE ERRORES -->
                        @if (count($errors) > 0)
                        <div class="alert bg-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul class="error_list">
                                @foreach ($errors->all() as $error)
                                <li >
                                    <span class="glyphicon glyphicon glyphicon-check"></span>
                                    {{ $error }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- END PARA MANEJO DE ERRORES -->
            <table data-toggle="table" data-url="tables/data2.json">
                <thead>
                    <tr>
                      <th>Usuario</th>
                      <th>Nombre</th>                                                                                    
                      <th>tipo</th>
                      <th>estado</th>
                      <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($userallcomorgdor as $user)
                      <tr>
                          <td>{{ $user->username }}</td>
                          <td><a style="color: #1c94c4" href="{{ URL::to('#');}}"> {{ $user->nombre}}</a></td>
                          <td>{{ $user->tipo }}</td>
                          <td>{{ $user->estado }}</td>
                          <td>
                              <a class="label label-primary" href="{{ URL::to('/usuariocorg/editar');}}/{{$user->idUsuario }}">
                                  <span class="glyphicon glyphicon-edit"></span>
                              </a>&nbsp
                              <a class="label label-danger" href="{{ URL::to('/usuariocorg/eliminar');}}/{{ $user->idUsuario }}">
                                  <span class="glyphicon glyphicon-trash"> </span>
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
