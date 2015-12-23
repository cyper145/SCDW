<?php
$price = DB::table('tcambio')->max('idcambio');
$cod=$partido->codpartido;
//$cod=DB::select('SELECT max(`id`) FROM `treunion` WHERE 1').get();
$nuevo =(int)$price+1;

$conclusiones=DB::select('select * from tjugadorenjuego WHERE codpartido=?',array($cod));
$arr=array();

foreach ($conclusiones as $user)
{
    $jugador=Jugador::find($user->idjugador);
    $equipo=Equipo::find($jugador->codequipo);
    $arr[$user->idjugadorenjuego] = $user->nrocamiseta." ".$equipo->nombre;
}
/*
$hora=localtime();
echo gettype($hora)."<br>";
echo $hora[0]."<br>";
echo $hora[1]."<br>";
echo $hora[2]."<br>";
echo $hora[3]."<br>";
*/
$part=DB::select('select * from tpartido');
$cadena="";
$arr2=array();
foreach ($part as $user)
{
    $idd=$user->codpartido;
    //echo $idd;
    $encuentros=DB::select('call encuentros(?)',array($idd));
    foreach ($encuentros as $key) {
        $partido=$key->codpartido;
        $cadena=" vs ".$key->nombreEquipo.$cadena;

    }
    $longitud=strlen($cadena);
    $cadena=substr($cadena,4);
    $arr2[$partido]=$cadena;


}


?>
<div class="row col-no-gutter-container row-margin-top">
    <div class="col-lg-12 col-no-gutter">
        <div class="panel panel-default">

            $partido
            <div class="col-lg-3">
                @if(!isset($category))

                    {{Form::open(array('method' => 'POST', 'url' => '/partido/cambios/add/'.$codcampeonato.'/'.$torneo->idtorneo.'/'.$idfecha.'/'.$fixture->idfixture.'/'.$cod , 'role' => 'form'))}}


                    <div class="form-group">
                        {{Form::label('entra:')}}
                        {{Form::select('entra', $arr,'',array('class' => 'form-control'))}}
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        {{Form::label('sale:')}}
                        {{Form::select('sale', $arr,'',array('class' => 'form-control'))}}
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        {{Form::label('minuto')}}
                        {{Form::time('minuto','', array('class' => 'form-control'))}}
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        {{Form::label('partido')}}
                        {{Form::text('id_partido', $arr2[$cod],array('class' => 'form-control'))}}
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group">
                        <p>{{Form::submit('hacer cambios', array('class' => 'btn btn-default'))}}</p>
                    </div>

                    {{Form::close()}}

                @endif
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <h2>cambios </h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <td>idcambio</td>
                            <td>entra</td>
                            <td>sale</td>
                            <td>min</td>
                            <td>partido</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($todoConclusion as $cat)
                            <tr>
                                <td>{{$cat->idcambio}}</td>

                                <td>{{$arr[$cat->idjugadorenjuegoentrante]}}</td>
                                <td>{{$arr[$cat->idjugadorenjuegosaliente]}}</td>
                                <td>{{$cat->minuto }}</td>
                                <td>{{$arr2[$cat->codpartido]}}</td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
