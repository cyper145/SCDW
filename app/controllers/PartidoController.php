<?php

class PartidoController extends \BaseController {


public function partido_all()
	{
		$todoConclusion = Cambio::all();
		return View::make('partido.cambios')->with('todoConclusion', $todoConclusion);
	}

	public function partido_add()
	{
		$input = Input::all();

		$rules = array(

			'idcambios' => 'required',
			'entra' => 'required',
			'sale' => 'required',
			'minuto' => 'required',
			'id_partido' => 'required'
			
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$category = new Cambio;
				$category->idcambio = Input::get('idcambios');
				$category->idjugadorenjuego1 = Input::get('entra');
				$category->idjugadorenjuego2 = Input::get('sale');
				$category->minuto = Input::get('minuto');
				$category->codpartido = Input::get('id_partido');

			$category->save();

			return Redirect::to('/partido/cambios');
		}
	}

	public function partido_get_edit($id)
	{
		$todoConclusion = Cambio::all();
		//$category = DB::select('select * from Tcambio where idcambio=? ',array($id));
		$category =  Cambio::find($id);

		return View::make('partido.cambios')->with('todoConclusion', $todoConclusion)->with('category', $category);
	}

	public function partido_post_edit($id)
	{
		$input = Input::all();

		$rules = array(

			
			'entra' => 'required',
			'sale' => 'required',
			'minuto' => 'required',
			'id_partido' => 'required'
			
		);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			
				$category =  Cambio::find($id);
				$category->idjugadorenjuego1 = Input::get('entra');
				$category->idjugadorenjuego2 = Input::get('sale');
				$category->minuto = Input::get('minuto');
				$category->codpartido = Input::get('id_partido');
			$category->save();

			return Redirect::to('/partido/cambios/');
		}
	}

	public function partido_delete($id)
	{
		$category =  Cambio::find($id);
		$category->delete();
		return Redirect::to('/partido/cambios/');
	}





	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$todopartidos = Partido::all();
        return View::make('partido.listar')->with('todopartidos',$todopartidos);
	}

	public function nuevo()
	{
		
		//$todopartidos = Partido::all();
        return View::make('partido.nuevo');
	}

	public function insertarpartido()
	{
		//$todocampeonato = Campeonato::all();
        return View::make('partido.insertar');
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
		$partido = new Partido;
		
                       
		$partido->codpartido = Input::get('Cod_partido');
		$partido->horainicio = Input::get('Hora_inicio');
		$partido->horafin = Input::get('Hora_final');
		$partido->tipopartido = Input::get('Tipo_partido');
		$partido->observacion= Input::get('Observacion');
		$partido->codprogramacion= Input::get('Cod_programacion');
		$partido->idarbitroporpartido= Input::get('Idarbitro');
		$partido->save();
		return Redirect::to('partido/');
		
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
	public function editarpartido($id)
	{
		$partido = Partido::where('codpartido', '=', $id)->get();
		return View::make('partido.editar')->with('partidos',$partido);


	}
	

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function update($id)
	{

		$entra = Input::all();
		$partido = DB::table('tpartido')
            ->where('codpartido', $id)
            ->update(array(
		'horainicio' => $entra['Hora_inicio'],
		'horafin' => $entra['Hora_final'],
		'tipopartido' => $entra['Tipo_partido'],
		'observacion' => $entra['Observacion']));
        'codprogramacion' => $entra['Cod_programacion']));
		'idarbitroporpartido' => $entra['Idarbitro']));
        return Redirect::to('partido/listar');
	}*/


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

    public  function partido($idfixture)
    {
        $fixture = Fixture::where('idfixture','=',$idfixture)->first();
        $jugadoresequipo1 = Jugador::where('codequipo','=',$fixture->equipo1)->get();
        $jugadoresequipo2 = Jugador::where('codequipo','=',$fixture->equipo2)->get();
        $arbitros = Arbitro::all();
        //todos los jugadores de este partido
        $Delanteros1 = '';
        $Mediocampistas1 = '';
        $Defensas1 = '';
        $Guardameta1 = '';
        $suplentes1 = '';
        $capitan1 = '';
        $jugadoresdeunpartido2 = '';
        //recuperamos los arbitros del partido
        $arbitrosdelpartido = '';
        //verificamos si el partido ya se jugó
        if($partido = Partido::where('idfixture', '=', $idfixture)->first())
        {
            //recuperar los datos del partido jugado
            $arbitrosdelpartido = ArbitroPorPartido::where('idarbitroporpartido','=',$partido->idarbitroporpartido)->first();
            //resuperamos todos los jugadores de este partido
            $Delanteros1 = DB::table('tjugadorenjuego')
                ->join('tjugador','tjugadorenjuego.idjugador','=','tjugador.idjugador')
                ->join('tdocente','tdocente.coddocente','=','tjugador.coddocente')
                ->join('tequipo','tequipo.codequipo','=','tjugador.codequipo')
                ->where('tjugadorenjuego.codpartido','=',$partido->codpartido)
                ->where('tjugador.codequipo','=',$fixture->equipo1)
                ->where('tjugadorenjuego.condicionenpartido','=','delantero')
                ->get();
            $Mediocampistas1 = DB::table('tjugadorenjuego')
                ->join('tjugador','tjugadorenjuego.idjugador','=','tjugador.idjugador')
                ->join('tdocente','tdocente.coddocente','=','tjugador.coddocente')
                ->join('tequipo','tequipo.codequipo','=','tjugador.codequipo')
                ->where('tjugadorenjuego.codpartido','=',$partido->codpartido)
                ->where('tjugador.codequipo','=',$fixture->equipo1)
                ->where('tjugadorenjuego.condicionenpartido','=','mediocampista')
                ->get();
            $Defensas1 = DB::table('tjugadorenjuego')
                ->join('tjugador','tjugadorenjuego.idjugador','=','tjugador.idjugador')
                ->join('tdocente','tdocente.coddocente','=','tjugador.coddocente')
                ->join('tequipo','tequipo.codequipo','=','tjugador.codequipo')
                ->where('tjugadorenjuego.codpartido','=',$partido->codpartido)
                ->where('tjugador.codequipo','=',$fixture->equipo1)
                ->where('tjugadorenjuego.condicionenpartido','=','defensa')
                ->get();
            $Guardameta1 = DB::table('tjugadorenjuego')
            ->join('tjugador','tjugadorenjuego.idjugador','=','tjugador.idjugador')
            ->join('tdocente','tdocente.coddocente','=','tjugador.coddocente')
            ->join('tequipo','tequipo.codequipo','=','tjugador.codequipo')
            ->where('tjugadorenjuego.codpartido','=',$partido->codpartido)
            ->where('tjugador.codequipo','=',$fixture->equipo1)
            ->where('tjugadorenjuego.condicionenpartido','=','guardameta')
            ->get();
            $suplentes1 = DB::table('tjugadorenjuego')
                ->join('tjugador','tjugadorenjuego.idjugador','=','tjugador.idjugador')
                ->join('tdocente','tdocente.coddocente','=','tjugador.coddocente')
                ->join('tequipo','tequipo.codequipo','=','tjugador.codequipo')
                ->where('tjugadorenjuego.codpartido','=',$partido->codpartido)
                ->where('tjugador.codequipo','=',$fixture->equipo1)
                ->where('tjugadorenjuego.condicionenpartido','=','suplente')
                ->get();
            $capitan1  = DB::table('tjugadorenjuego')
                ->join('tjugador','tjugadorenjuego.idjugador','=','tjugador.idjugador')
                ->join('tdocente','tdocente.coddocente','=','tjugador.coddocente')
                ->join('tequipo','tequipo.codequipo','=','tjugador.codequipo')
                ->where('tjugadorenjuego.codpartido','=',$partido->codpartido)
                ->where('tjugador.codequipo','=',$fixture->equipo1)
                ->where('tjugadorenjuego.escapitan','=','si')
                ->get();
            $jugadoresdeunpartido2 = DB::table('tjugadorenjuego')
                ->join('tjugador','tjugadorenjuego.idjugador','=','tjugador.idjugador')
                ->where('tjugadorenjuego.codpartido','=',$partido->codpartido)
                ->where('tjugador.codequipo','=',$fixture->equipo2)
                ->get();
        }
        else//crear un nuevo partido
        {
            $partidonew = new Partido();
            $partidonew -> idfixture = $idfixture;
            $partidonew->save();
        }
        return View::make('user_com_organizing.fecha.partido.index',compact('fixture'))
            ->with('jugadoresequipo1',$jugadoresequipo1)
            ->with('jugadoresequipo2',$jugadoresequipo2)
            ->with('partido',$partido)
            ->with('arbitrosdelpartido',$arbitrosdelpartido)
            ->with('Delanteros1',$Delanteros1)
            ->with('Mediocampistas1',$Mediocampistas1)
            ->with('Defensas1',$Defensas1)
            ->with('Guardameta1',$Guardameta1)
            ->with('suplentes1',$suplentes1)
            ->with('capitan1',$capitan1)
            ->with('jugadoresdeunpartido2',$jugadoresdeunpartido2)
            ->with('arbitros',$arbitros);
    }

    public  function arbitroadd($idfixture)
    {
        $respuesta = ArbitroPorPartido::isertar(Input::all());
        if($respuesta['error']==true)
        {
            return Redirect::to('fechas/detail/partido/'.$idfixture)->withErrors($respuesta['mensaje']);
        }
        return Redirect::to('fechas/detail/partido/'.$idfixture)->withErrors($respuesta['mensaje']);
    }

    public function jugadoradd($idfixture)
    {
        $respuesta = JugadorEnJuego::isertar(Input::all());
        if($respuesta['error']==true)
        {
            return Redirect::to('fechas/detail/partido/'.$idfixture)->withErrors($respuesta['mensaje']);
        }
        return Redirect::to('fechas/detail/partido/'.$idfixture)->withErrors($respuesta['mensaje']);
    }

    public function jugadordelete($idjugadorenjuego,$idfixture)
    {
        JugadorEnJuego::find($idjugadorenjuego)->delete();
        $respuesta['mensaje'] = 'Jugador eliminado correctamente de este partido';
        return Redirect::to('fechas/detail/partido/'.$idfixture)->withErrors($respuesta['mensaje']);
    }

    public function jugadorgollist($idjugadorenjuego,$idfixture)
    {
        $golesdeljugadorenjuego = Gol::where('idjugadorenjuego','=',$idjugadorenjuego)->get();
        return View::make('user_com_organizing.fecha.partido.insidencia.gol.list')
            ->with('idfixture',$idfixture)
            ->with('golesdeljugadorenjuego',$golesdeljugadorenjuego)
            ->with('idjugadorenjuego',$idjugadorenjuego);
    }

    public function jugadorgol_get($idjugadorenjuego,$idfixture)
    {
        return View::make('user_com_organizing.fecha.partido.insidencia.gol.insert')
            ->with('idfixture',$idfixture)
            ->with('idjugadorenjuego',$idjugadorenjuego);
    }

    public  function jugadorgol_post()
    {
        $idfixture = Input::get('idfixture');
        $idjugadorenjuego = Input::get('idjugadorenjuego');
        $newgol = new Gol();
        $newgol->minuto = Input::get('minuto');
        $newgol->idjugadorenjuego = $idjugadorenjuego;
        $newgol->save();
        $respuesta['mensaje'] = 'Gol agregado correctamente';
        return Redirect::to('fechas/detail/partido/gol/list/'.$idjugadorenjuego.'/'.$idfixture)->withErrors($respuesta['mensaje']);
    }

    public function jugadorgoldelete($idjugadorenjuego,$idfixture,$idgol)
    {
        Gol::find($idgol)->delete();
        $respuesta['mensaje'] = 'Gol eliminado correctamente';
        return Redirect::to('fechas/detail/partido/gol/list/'.$idjugadorenjuego.'/'.$idfixture)->withErrors($respuesta['mensaje']);
    }
    public function jugadorinsidencia($idjugadorenjuego,$idfixture)
    {
      echo 'falta';
    }
}
