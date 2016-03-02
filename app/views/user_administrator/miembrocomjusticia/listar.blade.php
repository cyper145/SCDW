@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')

@stop

@section('nombrevista')
    @lang('Comision de Justicia')
@stop

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div style="float: left">Miembros de la comision de Justicia</div>
                <div style="float: right">
                    <div class="form-inline">
                        {{ Form::open(array('url' => '#','method' => 'post')) }}
                        <div class="form-group">
                            <a class="btn btn-default margin text-lowercase" type="button" href="{{ URL::to( 'miembrocomjusticiainsertar');}}"><span class="glyphicon glyphicon-plus"></span> Add New</a>

                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table data-toggle="table" data-url="tables/data2.json">
                    <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre Completo</th>
                        <th>Rol</th>
                        <th>Campeonato</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($todomiembros as $camp)
                        <tr>
                            <td>{{$camp->dni}}</td>
                            <td>{{$camp->nombre.' '.$camp->apellidopaterno.' '.$camp->apellidomaterno}}</td>
                            <td>{{$camp->rol}}</td>
                            <td>{{$camp->dataCampeonato[0]->nombre}}</td>
                            <td>
                                <a class="label label-primary" href="{{ URL::to('miembrocomjusticiaeditar'.$camp->dni);}}" ><span class="glyphicon glyphicon-edit"></span> &nbsp;Edit</a>
                                <a class="label label-success" href="#" ><span class="glyphicon glyphicon-list"></span> &nbsp;Detail</a>
                                <a class="label label-danger" href="eliminar/{{ $camp->dni}}" ><span class="glyphicon glyphicon-trash"></span> &nbsp;Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $todomiembros->links() }}
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
    <script type="text/javascript">
        function validar(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==8) return true;
            if (tecla==44) return true;
            if (tecla==48) return true;
            if (tecla==49) return true;
            if (tecla==50) return true;
            if (tecla==51) return true;
            if (tecla==52) return true;
            if (tecla==53) return true;
            if (tecla==54) return true;
            if (tecla==55) return true;
            if (tecla==56) return true;
            if (tecla==57) return true;
            patron = /1/; //ver nota
            te = String.fromCharCode(tecla);
            return patron.test(te);
        }
    </script>
@stop
@stop

