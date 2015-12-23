<?php

class FechasController extends \BaseController 
{    
    
    function obtener1($vs)
    {
        $bandera=false;
        $i=0;
        while(!$bandera)
        {
            $p=substr($vs,$i,1);
            if($p=="-"){
                $bandera=true;
                $p=substr($vs,0,$i);
            }

            $i++;

        }
        return trim($p);

    }
    function obtener2($vs)
    {
        //User::where('votos', '>', 100)->count();
        $bandera=false;
        $i=strlen($vs)-1;
        $k=0;
        $nro=strlen($vs);
        while(!$bandera)
        {
            $p=substr($vs,$i,1);
            if($p=="-"){
                $bandera=true;
                $p=substr($vs,$i+1,$k);
            }
            $k++;
            $i--;

        }
        return trim($p);
    }
    public function generrar( $nro,$idcampeonato,$idtorneo)
    {
        $base1=pow(10,$idcampeonato)*100;
        $base2=pow( 10,$idtorneo)*10;
        $nro2=$base1+$base2+$nro;
        $cod=$nro2;
        return $cod;
    }
    public function actualizarfechas($idcampeonato,$idtorneo,$nrofecha)
    {
        $campeonato = Campeonato::where('codcampeonato','=',$idcampeonato)->first();
        $torneo = Torneo::where('idtorneo','=',$idtorneo)->first();
        $fixture=Fixture::all();
        return View::make('user_com_organizing.fecha.actualizar')
            ->with('fixture',$fixture)
            ->with('torneo',$torneo)
            ->with('nrofecha',$nrofecha)
            ->with('idtorneo',$idtorneo)
            ->with('idcampeonato',$idcampeonato)
            ->with('campeonato',$campeonato);
    }
    public function add($idcampeonato,$idtorneo)
    {
        $input = Input::all();
        $rules = array(
            'fecha' => 'required',
            'horainicio' => 'required',
            'lugar' => 'required'
            );
        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        else
        {
            $nrofecha = Input::get('nrofecha');
            //recuperamos la fecha ingresada y lo acomodamos para ingresar a la base de datos
            $fecha = Input::get('fecha');
            $mes = substr($fecha,0,2);
            $dia = substr($fecha,3,2);
            $año = substr($fecha,6,4);
            $fecha = $año.'-'.$mes.'-'.$dia;
            $horaincio = Input::get('horainicio');
            $lugar=input::get('lugar');
            $hora=substr($horaincio,0,2);
            $min=substr($horaincio,4,2);
            $horaI=(int)$hora;
            $minI=(int)$min;

            $fixturefecha=Fixture::where('idfecha','=',$nrofecha)->where('idtorneo','=',$idtorneo)->get();;
            $i=1;
            foreach( $fixturefecha as $value)
            {
                $mas=0;
                $minI=$minI+30;
                if($minI>=60)
                {
                    $mas=1;
                    $minI=$minI % 60;
                }
                $horaI=$horaI+1+$mas;
                $siguiente=$horaI.":".$minI;
                $value->hora=$siguiente;
                $value->nropartido=$i;
                $value->save();
                $i++;
            }

            $category = new Fechas();
            $category->nrofecha = $nrofecha;
            $category->lugar = $lugar;
            $category->diafecha = $fecha;
            $category->idtorneo=$idtorneo;
            $category->save();

            return Redirect::to('torneo/'.$idtorneo.'/'.$idcampeonato.'/detail.html');
        }
    }
    
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public  function detail($codcampeonato,$idtorneo,$nrofecha)
    {
        $torneo = Torneo::where('idtorneo','=',$idtorneo)->first();
        $fecha = Fechas::where('nrofecha','=',$nrofecha)->where('idtorneo','=',$idtorneo)->first();
        $fixture = Fixture::where('idfecha','=',$nrofecha)->where('idtorneo','=',$idtorneo)->get();
        $fixturedeequipoqueescansa = Fixtureaux::where('idfecha','=',$nrofecha)->where('idtorneo','=',$idtorneo)->first();
        $equipoquedescansa = '';
        $todoConclusion = Cambio::all();

        if($fixturedeequipoqueescansa != '')
        {
            if($fixturedeequipoqueescansa->equipo1 == '')
            {
                $equipoquedescansa = Equipo::where('codequipo','=',$fixturedeequipoqueescansa->equipo2)->first();
            }
            else
            {
                $equipoquedescansa = Equipo::where('codequipo','=',$fixturedeequipoqueescansa->equipo1)->first();
            }
        }
        return View::make('user_com_organizing.fecha.detail',compact('fecha'))
            ->with('fixture',$fixture)
            ->with('torneo',$torneo)
            ->with('equipoquedescansa',$equipoquedescansa)
            ->with('codcampeonato',$codcampeonato)->with('todoConclusion', $todoConclusion);
    }
}
