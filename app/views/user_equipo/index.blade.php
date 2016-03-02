@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
@stop

@section('nombrevista')
    @lang('Home')
@stop

@section('contenido')
    <?php

    $habilitado2="";
    $habilitado2=DB::select('SELECT idFecha FROM tprogramacion WHERE diaPartido=adddate(curdate(),1) OR diaPartido=adddate(curdate(),2) OR
    diaPartido=adddate(curdate(),3)');
    $idfecha=-1;
    $descansa=0;
    $codEquipo1=-1;
    $codEquipo2=-1;
    $idfixture=-1;
    $codPla="";
    if($habilitado2!="")
    {
        foreach($habilitado2 as $value) {
        $idfecha=$value->idFecha;
    }
    }
     if($idfecha!=-1){
        $fecha=Fechas::find($idfecha);
        $nrofecha=$fecha->nroFecha;
        $partidoActual=DB::select('call resumen_partido(?,?)',array($nrofecha,$equipo->codEquipo));
         $exite="";
         foreach($partidoActual as $value)
         {
             echo $exite=$value->id_equipo1;
         }

        if($exite!="")
        {
            foreach($partidoActual as $value)
            {
                $codEquipo1=$value->id_equipo1;
                $codEquipo2=$value->id_equipo2;
                $idfixture=$value->id_fixture;
            }
            $nroPlantilla=0;
            $nro1=strcmp($codEquipo1,$equipo->codEquipo);
            $nro2=strcmp($codEquipo2,$equipo->codEquipo);
          if($nro1==0)
          {
              $nroPlantilla=1;
          }
          if($nro2==0)
           {

               $nroPlantilla=2;
           }

          $nroPartido=Fixture::find($idfixture)->nroPartido;
          $programacion=Programacion::where('idFecha','=',$idfecha)->where('nroPartido','=',$nroPartido)->first();
          $partidoA=Partido::where('codProgramacion','=',$programacion->codProgramacion)->first();
          $Plantilla=Planilla::where('codPartido','=',$partidoA->codPartido)->where('nroPlantilla','=',$nroPlantilla)->first();
          $codPla=$Plantilla->codPantilla;
          echo "<br>".$partidoA->codPartido."<br>".$nroPlantilla. " ".$codPla;
         }
         else{

             $descansa=1;

         }


    }

    ?>
    <!-- BEGIN PAR MANEJO DE ERRORES -->
    @include('alerts.allsuccess')
    @include('alerts.success')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="container">
        <div class="row-margin-top ">
            <div class="col-md-3 col-no-gutter">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Logo</div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <div class="col-lg-3">
                                @if($equipo->logo != '')
                                    {{HTML::image('storage/equipo/'.$equipo->logo,'imagen logo',['class'=>'img-responsive','title'=>'uniforme','style'=>'width: 200px'])}}
                                    <a class="btn btn-danger  margin" type="button" href="{{URL::to('jugador/logo/delete.html')}}"><span class="glyphicon glyphicon-trash"> Eliminar</span></a>
                                @else
                                    <span class="label label-info">sin Logo</span>
                                    <a class="btn btn-primary btn-circle margin" type="button" href="{{URL::to('jugador/logo.html')}}"><span class="glyphicon glyphicon-plus"></span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-no-gutter">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Camiseta</div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <div class="col-lg-3">
                                @if($equipo->fotouniforme != '')
                                    {{HTML::image('storage/equipo/camiseta/'.$equipo->fotouniforme,'imagen uniforme',['class'=>'img-responsive','title'=>'uniforme','style'=>'width: 200px'])}}
                                    <a class="btn btn-danger  margin" type="button" href="{{URL::to('jugador/camiseta/delete.html')}}"><span class="glyphicon glyphicon-trash"> Eliminar</span></a>
                                @else
                                    <span class="label label-info">sin uniforme</span>
                                    <a class="btn btn-primary btn-circle margin" type="button" href="{{URL::to('jugador/camiseta.html')}}"><span class="glyphicon glyphicon-plus"></span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
                <div class="panel panel-teal panel-widget">
                    <div class="row no-padding ">
                        <div class="col-sm-3 col-lg-5 widget-left ">jugadores
                            <a class="color-blue" href="{{URL::to('jugador/listar.html')}}"><span class="glyphicon glyphicon-user glyphicon-l"></span></a>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">{{$nrojugadores}}</div>
                            <div class="text-muted">
                                @if($nrojugadores=='1')
                                    Jugador
                                @else
                                    Jugadores
                                @endif

                            </div>
                            <a class="widget-right " href="{{URL::to('jugadorinsertar')}}">
                                <button class="btn btn-block label label-info" type="button">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Nuevo
                                </button>
                            </a>

                        </div>

                    </div>
                    <div class="row no-padding ">
                        <div class="col-sm-3 col-lg-5 widget-left ">delegados
                            <a class="color-blue" href="{{URL::to('delegado/listar.html')}}"><span class="glyphicon glyphicon-user glyphicon-l"></span></a>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">{{$nrodelegados}}</div>
                            <div class="text-muted">
                                @if($nrodelegados=='1')
                                    Delegado
                                @else
                                    Delegados
                                @endif

                            </div>
                            <a class="widget-right" href="{{URL::to('delegadoinsertar')}}">
                                <button class="btn btn-block label label-info" type="button">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Nuevo
                                </button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--buscar en archivo percy14022016.txt lo que falte -->
    <div class="container">
        <div class="row ">
            <!--  camabiar este esta con la despues de comenzar el los partidos con el fixture-->

            @if($idfecha!=-1)
                <div class="col-md-3 col-no-gutter">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">partido de la fecha {{$nrofecha}}</div>
                        <div class="panel-body">
                            <div class="col-md-6">
                            @if(!$descansa)
                            <div class="label-success text-center">
                                {{Equipo::find($codEquipo1)->nombre}}
                            </div>
                            <div class="label-info text-center">
                                vs
                            </div>
                            <div class="label-danger text-center ">
                                {{Equipo::find($codEquipo2)->nombre}}
                            </div>
                            @else
                                <div class="label-success text-center">
                                    {{$equipo->nombre}}
                                </div>
                                <div class="label-danger text-center">
                                    descansa
                                </div>
                            @endif
                           </div>

                            @if($codPla!="")
                            <div class= "col-md-6 label label-info">
                            <a class="widget-right" href="{{URL::to('plantilla/'.$codPla)}}">
                                <span class="glyphicon glyphicon-list-alt"></span> &nbsp;Añadir plantilla
                            </a>
                            </div>
                            @endif

                            <!--pantilla determinar el partido de la fecha  -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-no-gutter">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">lista de partidos jugados</div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <div class="col-lg-3">
                                    <!-- referencias  a lista de partidos jugados-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-no-gutter">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">Puntaje</div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <div class="col-lg-3">
                                    <!-- determinar el puntaje-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-no-gutter">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">goleadores</div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <div class="col-lg-3">
                                    <!-- lista de goleadores de equipo-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-4 col-no-gutter">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">lista de partidos jugados</div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <div class="col-lg-3">
                                    <!-- referencias  a lista de partidos jugados-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-no-gutter">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">Puntaje</div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <div class="col-lg-3">
                                    <!-- determinar el puntaje-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-no-gutter">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">goleadores</div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <div class="col-lg-3">
                                    <!-- lista de goleadores de equipo-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@stop