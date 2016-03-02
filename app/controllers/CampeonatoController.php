<?php

class CampeonatoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$todocampeonato = Campeonato::where('codCom_Org','=',Session::get('user_idcom_orgdor'))->paginate(2);
        return View::make('user_com_organizing.campeonato.listar')->with('todocampeonato',$todocampeonato);
	}

    public function detalle($codcampeonato)
    {
        $equipos = Equipo::where('codCampeonato','=',$codcampeonato)->get();
        $campeonato = Campeonato::where("codCampeonato",'=',$codcampeonato)->where('codCom_Org','=',Session::get('user_idcom_orgdor'))->first();
        $Actividades = Actividad::where('codCampeonato','=',$codcampeonato)->get();
        $configuracion=Configuracion::where('codCampeonato','=',$codcampeonato)->get();
        $todoReunion=DB::table('treunion')
            ->join('tfecha', 'treunion.idFecha', '=', 'tfecha.idFecha')
            ->join('trueda', 'tfecha.codRueda', '=', 'trueda.codRueda')
            ->join('tcampeonato', 'trueda.codCampeonato', '=', 'tcampeonato.codCampeonato')
            ->select('treunion.codReunion', 'treunion.fecha')
            ->where( 'tcampeonato.codCampeonato', '=', $codcampeonato)
            ->get();



        return View::make('user_com_organizing.campeonato.detail')
            ->with('campeonato',$campeonato)
            ->with('Actividades',$Actividades)
            ->with('equipos',$equipos)
            ->with('configuracion', $configuracion)
            ->with('todoReunion', $todoReunion);
    }


    public function detalleequipojugador($codequipo,$codcampeonato)
    {
        $equipo = Equipo::where('codEquipo','=',$codequipo)->first();
        $jugadoresdelequipo = Jugador::where('codEquipo','=',$codequipo)->get();
        return View::make('user_com_organizing.campeonato.equipojugador.detail')
            ->with('equipo',$equipo)
            ->with('codcampeonato',$codcampeonato)
            ->with('jugadoresdelequipo',$jugadoresdelequipo);
    }

    public function detallejugador($codequipo,$codcampeonato,$idjugador)
    {
        $jugador = Jugador::where('codJugador','=',$idjugador)->first();
        return View::make('user_com_organizing.campeonato.equipojugador.jugador.detail')
            ->with('codequipo',$codequipo)
            ->with('codcampeonato',$codcampeonato)
            ->with('jugador',$jugador);
    }

	public function insertarcampeonato()
	{
        return View::make('user_com_organizing.campeonato.insertar');
	}

	public function  actividad($codcampeonato)
    {
        $campeonato = Campeonato::where('codCampeonato','=',$codcampeonato)->first();
        return  View::make('user_com_organizing.campeonato.actividad')
        ->with('codcampeonato',$codcampeonato)
        ->with('campeonato',$campeonato);

    }
    public function crearcodactividad($id)
    {
        $users = DB::table('tactividad')->count();
        $users++;
        return  "ACT0".$id."0".$users;
    }
    public function addacti($id)
    {

        $acti1=new Actividad();
        $acti1->codActividad=$this->crearcodactividad($id);
        $acti1->actividad=Input::get('actividad');
        $acti1->fechaInicio=Input::get('fechaI');
        $acti1->fechaFin=Input::get('fechaf');
        $acti1->observaciones=Input::get('observacion');;
        $acti1->codCampeonato=$id;
        $acti1->save();
        return Redirect::to('campeonato/detail/'.$id);
    }
    public function crearcoodconfig($id)
    {
        $users = DB::table('tconfiguracion')->count();
        $users++;
        return  "COF0".$id."0".$users;
    }
    public function  configuracionD($codcampeonato)
    {
        $campeonato = Campeonato::where('codCampeonato','=',$codcampeonato)->first();
       return  View::make('user_com_organizing.campeonato.configuracionesD')
       ->with('codcampeonato',$codcampeonato)
       ->with('campeonato',$campeonato);

    }

    public function addconfigD($id)
    {
        $all=Input::all();


        $configguracion1 = new Configuracion;
        $configguracion1->idConfiguracion=$this->crearcoodconfig($id);
        $configguracion1->descripcion=Input::get('descripcion');
        $configguracion1->valor=Input::get('valor');
        $configguracion1->codCampeonato=$id;
        $configguracion1->save();

        return Redirect::to('campeonato/detail/'.$id);
    }
	public function store()
	{
		$campeonato = new Campeonato;
		
		$campeonato->codCampeonato = Input::get('Codigo');
		$campeonato->nombre = Input::get('Nombre');
		$campeonato->anioAcademico = Input::get('Anio');
		$campeonato->fechaCreacion = Input::get('Fecha');
		$campeonato->reglamento= Input::get('reglamento');
		$campeonato->habilitar = "habilitado"; //esta parte ami parecer tiene que ser un combobox en la vista
        $campeonato->codCom_Org = Session::get('user_idcom_orgdor');
		$campeonato->save();
		return Redirect::to('campeonato/listar');
	}

	public function editarcampeonato($id)
	{
        $campeonato = Campeonato::where("codcampeonato",'=',$id)->where('codCom_Org','=',Session::get('user_idcom_orgdor'))->first();
		return View::make('user_com_organizing.campeonato.editar')->with('campeonato',$campeonato);
	}


	public function update($id)
	{
		//$todocampeonato = Campeonato::all();
		$entra = Input::all();
		$campeonato = DB::table('tcampeonato')
            ->where('codCampeonato', $id)
            ->update(array(
		'nombre' => $entra['Nombre'],
		'anioAcademico' => $entra['Anio'],
		'fechaCreacion' => $entra['Fecha'],
		'reglamento' => $entra['reglamento']));
        return Redirect::to('campeonato/listar');
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

    //====== equipo =====
    public function detalleEquipo($codcampeonato,$codequipo)
    {
        $delegadosEquipo=DB::table('tequipo')
            ->join('tdelegando', 'tequipo.codEquipo', '=', 'tdelegando.codEquipo')
            ->join('tdocente', 'tdelegando.codDocente', '=', 'tdocente.codDocente')
            ->select('tdelegando.dni','tdocente.codDocente', 'tdocente.nombre','tdocente.apellidoP','tdocente.apellidoM','tdelegando.rol','tdelegando.estado')
            ->where( 'tequipo.codEquipo', '=', $codequipo)->where( 'tequipo.codCampeonato', '=', $codcampeonato)
            ->get();

        $jugadoresEquipo=DB::table('tequipo')
            ->join('tjugador', 'tequipo.codEquipo', '=', 'tjugador.codEquipo')
            ->join('tdocente', 'tjugador.codDocente', '=', 'tdocente.codDocente')
            ->select('tjugador.dni','tdocente.codDocente', 'tdocente.nombre','tdocente.apellidoP','tdocente.apellidoM','tequipo.estado')
            ->where( 'tequipo.codEquipo', '=', $codequipo)->where( 'tequipo.codCampeonato', '=', $codcampeonato)
            ->get();

        return View::make('user_com_organizing.equipo.detail')->with('delegadosEquipo', $delegadosEquipo)
            ->with('jugadoresEquipo', $jugadoresEquipo)
            ->with('codcampeonato',$codcampeonato)
            ->with('codequipo',$codequipo);
    }

    public function editJugador($codcampeonato,$codequipo,$dni)
    {
        $ediJ=Jugador::find($dni);
        $habilitado="";
        if('habilitado'==Input::get('habilitado'))
        {
            $habilitado="habilitado";

        }
        else
        {
            $habilitado="desabilitado";
        }
        if('desabilitado'==Input::get('desabilitado'))
        {
            $habilitado="desabilitado";
        }
        $ediJ->estado=$habilitado;
        $ediJ->save();


        return Redirect::to('campeonato/detail/'.$codcampeonato.'/equipodetalle/'.$codequipo.'#jugadores');
    }


    public function editDelegado($codcampeonato,$codequipo,$dni)
    {
        $ediJ=Delegado::find($dni);
        $habilitado="";
        if('habilitado'==Input::get('habilitado'))
        {
            $habilitado="habilitado";

        }
        else
        {
            $habilitado="desabilitado";
        }
        if('desabilitado'==Input::get('desabilitado'))
        {
            $habilitado="desabilitado";
        }
        $ediJ->estado=$habilitado;
        $ediJ->save();


        return Redirect::to('campeonato/detail/'.$codcampeonato.'/equipodetalle/'.$codequipo.'#delegados');
    }




}
