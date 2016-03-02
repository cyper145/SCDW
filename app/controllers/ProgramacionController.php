<?php

class ProgramacionController extends \BaseController
{

    /**
     * Created by PhpStorm.
     * User: user
     * Date: 15/02/2016
     * Time: 16:20
     */
    public function  editpartido_get($codcampeonato,$codtorneo,$codfixture){

        return View::make('user_com_organizing.programacion.pPartido')
            ->with('codcampeonato',$codcampeonato)
            ->with('codtorneo',$codtorneo)
            ->with('codfixture',$codfixture)
            ;
    }

    public function  editpartido_post($codcampeonato,$codtorneo,$codfixture)
    {
        $codEscenario=Input::get('escenario');
        $fixture=Fixture::find($codfixture);
        $equipo1=$fixture->codEquipo1;
        $nombre1=Equipo::find($equipo1)->nombre;
        $nombre1=substr($nombre1,0,3);
        $equipo2=$fixture->codEquipo2;
        $nombre2=Equipo::find($equipo2)->nombre;
        $nombre2=substr($nombre2,0,3);
        $nrofecha=$fixture->nroFecha;
        $horaincio=$fixture->hora;
        $hora=substr($horaincio,0,2);
        $min=substr($horaincio,3,2);
        $horaI=(int)$hora;
        $minI=(int)$min;

        $horaI=$horaI+1;
        $siguiente=$horaI.":".$minI;
        $fecha=DB::table('tfecha')
            ->where( 'nroFecha', '=', $nrofecha)->where('codRueda', '=', $codtorneo)
            ->first();
        $nro=DB::table('tprogramacion')
            ->count();
        $idfecha=$fecha->idFecha;
        $cop="PRO".$idfecha.($nro+1);

        $programacion= new Programacion();
        $programacion->codProgramacion=$cop;
        $programacion->idFecha=$idfecha;
        $programacion->diaPartido=$fecha->diaFecha;
        $programacion->nroPartido=$fixture->nroPartido;
        $programacion->codEscenario=$codEscenario;
        $programacion->save();

        $partido=new Partido;
        $cP="PA".$nombre1.$nombre2;
        $partido->codPartido=$cP;
        $partido->codProgramacion=$cop;
        $partido->horaInicio=$horaincio;
        $partido->horaFin=$siguiente;
        $partido->tipoPartido="normal";
        $partido->save();
        return Redirect::to('/fecha/edit/'.$codcampeonato.'/'.$codtorneo.'/'.$fecha->nroFecha);


    }

}