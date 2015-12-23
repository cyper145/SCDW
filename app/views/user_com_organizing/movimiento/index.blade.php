@extends('_templates.apptemp')

@section('titulo')
    @lang('movimientos')
@stop

@section('rutanavegacion')
    <li><span class="glyphicon glyphicon-usd"></span></li>
@stop

@section('nombrevista')
    @lang('Movimientos')
@stop

@section('contenido')
    <div class="col-md-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">Relacion de Movimientos
                <div class="panel-tools pull-right">
                    <div class="form-inline">
                        <div class="form-group">

                            <a class="btn btn-info margin text-lowercase" type="button" href="{{URL::to('NuevoMov/addIngreso')}}"><span class="glyphicon glyphicon-plus"></span> Nuevo Ingreso</a>
                            <a class="btn btn-info margin text-lowercase" type="button" href="{{URL::to('NuevoMov/addEgreso')}}"><span class="glyphicon glyphicon-plus"></span> Nuevo Egreso</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <!-- BEGIN PARA MANEJO DE ERRORES -->
                @include('alerts.allsuccess')
                <!-- END PARA MANEJO DE ERRORES -->
                <table data-toggle="table" data-url="tables/datas.json">
                    <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Monto Total</th>
                        <th>Fecha</th>
                        <th>Descripcion</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($movimientos as $mov)
                        <tr>
                            <td>{{$mov->tipo}}</td>
                            <td>{{$mov->montototal}}</td>
                            <td>{{$mov->fecha}}</td>
                            <td>{{$mov->descripcion}}</td>
                            <td>

                                <a class="label label-danger" href="{{URL::to('movimientos/'.$mov->nromovimiento.'/delete.html')}}">
                                    <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $movimientos->links() }}
                </div>
            </div>
            <div class="panel-footer">
                @lang('El Monto Total en Caja es S/. ')<span class="text-info">{{$saldototal}}@lang('.00')</span>@lang(' Soles')
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection