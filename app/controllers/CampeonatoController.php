<?php

class CampeonatoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$todocampeonato = Campeonato::where('idcom_orgdor','=',Session::get('user_idcom_orgdor'))->paginate(2);
        return View::make('user_com_organizing.campeonato.listar')->with('todocampeonato',$todocampeonato);
	}

    public function detalle($codcampeonato)
    {
        $equipos = Equipo::where('codcampeonato','=',$codcampeonato)->get();
        $campeonato = Campeonato::where("codcampeonato",'=',$codcampeonato)->where('idcom_orgdor','=',Session::get('user_idcom_orgdor'))->first();
        $Actividades = Actividad::where('codcampeonato','=',$codcampeonato)->get();
        return View::make('user_com_organizing.campeonato.detail')
            ->with('campeonato',$campeonato)
            ->with('Actividades',$Actividades)
            ->with('equipos',$equipos);
    }

    public function detalleequipojugador($codequipo)
    {
        $equipo = Equipo::where('codequipo','=',$codequipo)->first();
        $jugadoresdelequipo = Jugador::where('codequipo','=',$codequipo)->get();
        return View::make('user_com_organizing.campeonato.equipojugador.detail')
            ->with('equipo',$equipo)
            ->with('jugadoresdelequipo',$jugadoresdelequipo);
    }

    public function detallejugador($idjugador)
    {
        $jugador = Jugador::where('idjugador','=',$idjugador)->first();
        return View::make('user_com_organizing.campeonato.equipojugador.jugador.detail')
            ->with('jugador',$jugador);
    }

	public function insertarcampeonato()
	{
        return View::make('user_com_organizing.campeonato.insertar');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$campeonato = new Campeonato;
		
		$campeonato->codcampeonato = Input::get('Codigo');
		$campeonato->nombre = Input::get('Nombre');
		$campeonato->anioacademico = Input::get('Anio');
		$campeonato->fechacreacion = Input::get('Fecha');
		$campeonato->reglamento= Input::get('reglamento');
		$campeonato->estado = "habilitado"; //esta parte ami parecer tiene que ser un combobox en la vista
        $campeonato->idcom_orgdor = Session::get('user_idcom_orgdor');
		$campeonato->save();
		return Redirect::to('campeonato/listar');
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
	public function editarcampeonato($id)
	{
        $campeonato = Campeonato::where("codcampeonato",'=',$id)->where('idcom_orgdor','=',Session::get('user_idcom_orgdor'))->first();
		return View::make('user_com_organizing.campeonato.editar')->with('campeonato',$campeonato);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//$todocampeonato = Campeonato::all();
		$entra = Input::all();
		$campeonato = DB::table('tcampeonato')
            ->where('codcampeonato', $id)
            ->update(array(
		'nombre' => $entra['Nombre'],
		'anioacademico' => $entra['Anio'],
		'fechacreacion' => $entra['Fecha'],
		'reglamento' => $entra['reglamento']));
        return Redirect::to('campeonato/listar');
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
	public function delete($id)
	{
		
		$campeonato = DB::table('tcampeonato')
            ->where('codcampeonato', $id)
            ->delete();
        return Redirect::to('campeonato/listar');
	}

public function find()
	{
		$Docentestodo=docente::all();

        if(isset($_GET["buscar"]))
        {

        	$buscar = htmlspecialchars(Input::get("buscar"));
        	$fila = docente::select(DB::raw('*'))->where('nombres', 'like', '%'.$buscar.'%')->orwhere('apellidos', 'like', '%'.$buscar.'%')->get();
        	return View::make('docente.listar')->with('Busqueda',$fila);
		
        }

        return View::make('docente.listar')->with('Docentestodo',$Docentestodo);
	}

}
