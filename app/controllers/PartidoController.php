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
    public function planilla($codcampeonato,$idtorneo,$idfecha,$codpartido,$codequipo)
    {
        //$pdf=new PDF('P', 'mm', '200, 300');
        $fpdf = new PDF();
        $tabla= DB::select('call plantilla(?,?,?)',array($idtorneo,$codpartido,$codequipo));
        $columnas = ['NRO','nombre y apellidos','condicion','equipo'];
        $fpdf->AddPage();
        $fpdf->Cell(80);
        $fpdf->Cell(30,5,'planilla de jugadores',0,1,'C');
        $fpdf->SetFont('Arial','B',9);
        $fpdf->Ln(2);
        $fpdf->SetFont('Arial','B',16);

        $fpdf->planilla($columnas,$tabla);
        $fpdf->Output();
        exit;
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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public  function partido($idfecha,$codcampeonato,$idtorneo,$idfixture)
    {
        $torneo = Torneo::where('idtorneo','=',$idtorneo)->first();
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
            ->with('idfecha',$idfecha)
            ->with('torneo',$torneo)
            ->with('codcampeonato',$codcampeonato)
            ->with('jugadoresequipo1',$jugadoresequipo1)
            ->with('jugadoresequipo2',$jugadoresequipo2)
            ->with('partido',$partido)
            ->with('arbitrosdelpartido',$arbitrosdelpartido)
            ->with('Delanteros1',$Delanteros1)
            ->with('Mediocampistas1',$Mediocampistas1)
            ->with('Defensas1',$Defensas1)
            ->with('Guardameta1',$Guardameta1)
            ->with('suplentes1',$suplentes1)
            ->with('jugadoresdeunpartido2',$jugadoresdeunpartido2)
            ->with('arbitros',$arbitros);
    }

    public  function arbitroadd()
    {
        $idfecha = Input::get('idfecha');
        $codcampeonato = Input::get('codcampeonato');
        $idtorneo = Input::get('idtorneo');
        $idfixture = Input::get('idfixture');

        $respuesta = ArbitroPorPartido::isertar(Input::all());
        return Redirect::to('fechas/'.$idfecha.'/'.$codcampeonato.'/'.$idtorneo.'/'.$idfixture.'/partido.html')->withErrors($respuesta['mensaje']);
    }

    public function jugadoradd()
    {
        $idfecha = Input::get('idfecha');
        $codcampeonato = Input::get('codcampeonato');
        $idtorneo = Input::get('idtorneo');
        $idfixture = Input::get('idfixture');

        $respuesta = JugadorEnJuego::isertar(Input::all());
        if($respuesta['error']==true)
        {
            return Redirect::to('fechas/'.$idfecha.'/'.$codcampeonato.'/'.$idtorneo.'/'.$idfixture.'/partido.html')->withErrors($respuesta['mensaje']);
        }
        return Redirect::to('fechas/'.$idfecha.'/'.$codcampeonato.'/'.$idtorneo.'/'.$idfixture.'/partido.html')->withErrors($respuesta['mensaje']);
    }

    public function jugadordelete($idfecha,$codcampeonato,$idtorneo,$idfixture,$idjugadorenjuego)
    {
        JugadorEnJuego::find($idjugadorenjuego)->delete();
        $respuesta['mensaje'] = 'Jugador eliminado correctamente de este partido';
        return Redirect::to('fechas/'.$idfecha.'/'.$codcampeonato.'/'.$idtorneo.'/'.$idfixture.'/partido.html')->withErrors($respuesta['mensaje']);
    }

    // para lod GOLES
    public function jugadorgollist($idfecha,$codcampeonato,$idtorneo,$idfixture,$idjugadorenjuego)
    {
        $golesdeljugadorenjuego = Gol::where('idjugadorenjuego','=',$idjugadorenjuego)->get();
        $jugadorenjuego = JugadorEnJuego::where('idjugadorenjuego','=',$idjugadorenjuego)->first();
        $jugador = Jugador::where('idjugador','=',$jugadorenjuego->idjugador)->first();
        return View::make('user_com_organizing.fecha.partido.insidencia.gol.list')
            ->with('idfecha',$idfecha)
            ->with('codcampeonato',$codcampeonato)
            ->with('idtorneo',$idtorneo)
            ->with('idfixture',$idfixture)
            ->with('idjugadorenjuego',$idjugadorenjuego)
            ->with('jugador',$jugador)
            ->with('golesdeljugadorenjuego',$golesdeljugadorenjuego);
    }

    public function jugadorgol_get($idfecha,$codcampeonato,$idtorneo,$idfixture,$idjugadorenjuego)
    {
        return View::make('user_com_organizing.fecha.partido.insidencia.gol.insert')
            ->with('idfecha',$idfecha)
            ->with('codcampeonato',$codcampeonato)
            ->with('idtorneo',$idtorneo)
            ->with('idfixture',$idfixture)
            ->with('idjugadorenjuego',$idjugadorenjuego);
    }

    public  function jugadorgol_post()
    {
        $idfecha = Input::get('idfecha');
        $codcampeonato = Input::get('codcampeonato');
        $idtorneo = Input::get('idtorneo');
        $idfixture = Input::get('idfixture');
        $idjugadorenjuego = Input::get('idjugadorenjuego');

        $newgol = new Gol();
        $newgol->minuto = Input::get('minuto');
        $newgol->idjugadorenjuego = $idjugadorenjuego;
        $newgol->save();
        $respuesta['mensaje'] = 'Gol agregado correctamente';
        return Redirect::to('fechas/'.$idfecha.'/'.$codcampeonato.'/'.$idtorneo.'/'.$idfixture.'/'.$idjugadorenjuego.'/goles.html')->withErrors($respuesta['mensaje']);
    }

    public function jugadorgoldelete($idfecha,$codcampeonato,$idtorneo,$idfixture,$idjugadorenjuego,$idgol)
    {
        Gol::find($idgol)->delete();
        $respuesta['mensaje'] = 'Gol eliminado correctamente';
        return Redirect::to('fechas/'.$idfecha.'/'.$codcampeonato.'/'.$idtorneo.'/'.$idfixture.'/'.$idjugadorenjuego.'/goles.html')->withErrors($respuesta['mensaje']);
    }
     //para las TARJETAS
    public function jugadortarjetalist($idfecha,$codcampeonato,$idtorneo,$idfixture,$idjugadorenjuego)
    {
        $tarjetasdeljugadorenjuego = Tarjeta::where('idjugadorenjuego','=',$idjugadorenjuego)->get();
        $jugadorenjuego = JugadorEnJuego::where('idjugadorenjuego','=',$idjugadorenjuego)->first();
        $jugador = Jugador::where('idjugador','=',$jugadorenjuego->idjugador)->first();
        return View::make('user_com_organizing.fecha.partido.insidencia.tarjeta.list')
            ->with('idfecha',$idfecha)
            ->with('codcampeonato',$codcampeonato)
            ->with('idtorneo',$idtorneo)
            ->with('idfixture',$idfixture)
            ->with('idjugadorenjuego',$idjugadorenjuego)
            ->with('jugador',$jugador)
            ->with('tarjetasdeljugadorenjuego',$tarjetasdeljugadorenjuego);
    }
    public function jugadortarjeta_get($idfecha,$codcampeonato,$idtorneo,$idfixture,$idjugadorenjuego)
    {
        return View::make('user_com_organizing.fecha.partido.insidencia.tarjeta.insert')
            ->with('idfecha',$idfecha)
            ->with('codcampeonato',$codcampeonato)
            ->with('idtorneo',$idtorneo)
            ->with('idfixture',$idfixture)
            ->with('idjugadorenjuego',$idjugadorenjuego);
    }

    public  function jugadortarjeta_post()
    {
        $idfecha = Input::get('idfecha');
        $codcampeonato = Input::get('codcampeonato');
        $idtorneo = Input::get('idtorneo');
        $idfixture = Input::get('idfixture');
        $idjugadorenjuego = Input::get('idjugadorenjuego');

        $newtarjeta = new Tarjeta();
        $newtarjeta->tipo = Input::get('tipo');
        $newtarjeta->minuto = Input::get('minuto');
        $newtarjeta->idjugadorenjuego = $idjugadorenjuego;
        $newtarjeta->save();
        $respuesta['mensaje'] = 'Tarjeta agregado correctamente';
        return Redirect::to('fechas/'.$idfecha.'/'.$codcampeonato.'/'.$idtorneo.'/'.$idfixture.'/'.$idjugadorenjuego.'/tarjeta.html')->withErrors($respuesta['mensaje']);
    }

    public function jugadortarjetadelete($idfecha,$codcampeonato,$idtorneo,$idfixture,$idjugadorenjuego,$idtarjeta)
    {
        Tarjeta::find($idtarjeta)->delete();
        $respuesta['mensaje'] = 'Tarjeta eliminado correctamente';
        return Redirect::to('fechas/'.$idfecha.'/'.$codcampeonato.'/'.$idtorneo.'/'.$idfixture.'/'.$idjugadorenjuego.'/tarjeta.html')->withErrors($respuesta['mensaje']);
    }

    
    public function jugadorinsidencia($idjugadorenjuego,$idfixture)
    {
      echo 'falta';
    }
}
