@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( 'egresos/listar');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('Lista Egresos')
@stop

@section('contenido')

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Lista de Egresos</div>
				
				<div class="panel-body">
					<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table table-bordered">
						<thead>
						
						<tr>
						        <th data-field="state" data-checkbox="true" style="text-decoration:underline" >Nro Movimiento</th>
						        <th data-field="id" data-sortable="true" style="text-decoration:underline">Id Egreso</th>
						    </tr>
						    </thead>
						    <tbody>
							@foreach( $egresos as $egre)
								<tr>
                            	<td>{{$egre->nromovimiento}}</td>
								<td>{{$egre->idegreso}} </td>
								
								</tr>
							@endforeach
							</tbody>
						</table>
					<div class="box-footer clearfix text-center">
                    <ul class="pagination pagination-sm no-margin">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop