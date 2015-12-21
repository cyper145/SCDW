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
        $configuracion=Configuracion::where('codcampeonato','=',$codcampeonato)->get();
        return View::make('user_com_organizing.campeonato.detail')
            ->with('campeonato',$campeonato)
            ->with('Actividades',$Actividades)
            ->with('equipos',$equipos)
            ->with('configuracion', $configuracion);
    }

    public function detalleequipojugador($codequipo,$codcampeonato)
    {
        $equipo = Equipo::where('codequipo','=',$codequipo)->first();
        $jugadoresdelequipo = Jugador::where('codequipo','=',$codequipo)->get();
        return View::make('user_com_organizing.campeonato.equipojugador.detail')
            ->with('equipo',$equipo)
            ->with('codcampeonato',$codcampeonato)
            ->with('jugadoresdelequipo',$jugadoresdelequipo);
    }

    public function detallejugador($codequipo,$codcampeonato,$idjugador)
    {
        $jugador = Jugador::where('idjugador','=',$idjugador)->first();
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
        $campeonato = Campeonato::where('codcampeonato','=',$codcampeonato)->first();
        return  View::make('user_com_organizing.campeonato.actividad')
        ->with('codcampeonato',$codcampeonato)
        ->with('campeonato',$campeonato);

    }
    public function addacti($id)
    {
        $acti1=new Actividad();
        $acti1->actividad=Input::get('actividad');
        $acti1->fechainicio=Input::get('fechaI');
        $acti1->fechafin=Input::get('fechaf');
        $acti1->observaciones=Input::get('observacion');;
        $acti1->codcampeonato=$id;
        $acti1->save();
        return Redirect::to('campeonato/detail/'.$id);
    }

    public function  configuracion($codcampeonato)
    {
        $campeonato = Campeonato::where('codcampeonato','=',$codcampeonato)->first();
       return  View::make('user_com_organizing.campeonato.configuraciones')
       ->with('codcampeonato',$codcampeonato)
       ->with('campeonato',$campeonato);

    }

    public function addconfig($id)
    {
        $all=Input::all();
        $configguracion1 = new Configuracion;
        $configguracion1->descripcion="nro de ruedas";
        $configguracion1->valor=Input::get('ruedas');
        $configguracion1->codcampeonato=$id;
        $configguracion1->save();

        $acti1=new Actividad();
        $acti1->actividad="limite inscriones";
        $acti1->fechainicio=Input::get('fechaI');
        $acti1->fechafin=Input::get('fechaf');
        $acti1->observaciones="pasada esta fecha no habra mas inscripciones";
        $acti1->codcampeonato=$id;
        $acti1->save();

        $acti3=new Actividad();
        $acti3->actividad="tentativa de apertura";
        $acti3->fechainicio=Input::get('apertura');
        $acti3->codcampeonato=$id;
        $acti3->save();

        $acti2=new Actividad();
        $acti2->actividad="tentativa de clausura";
        $acti2->fechainicio=Input::get('clausura');
        $acti2->codcampeonato=$id;
        $acti2->save();


        $configguracion2 = new Configuracion;
        $configguracion2->descripcion="maximo nro de dptacademicos por equipo";
        $configguracion2->valor=Input::get('maximo');
        $configguracion2->codcampeonato=$id;
        $configguracion2->save();

        $configguracion3 = new Configuracion;
        $configguracion3->descripcion="maximo nro de lugadores libres";
        $configguracion3->valor=Input::get('maximo');
        $configguracion3->codcampeonato=$id;
        $configguracion3->save();

        $configguracion4 = new Configuracion;
        $configguracion4->descripcion="duracion de tiempos";
        $configguracion4->valor=Input::get('duracion');
        $configguracion4->codcampeonato=$id;
        $configguracion4->save();

        $configguracion5 = new Configuracion;
        $configguracion5->descripcion="tiempo de descanso";
        $configguracion5->valor=Input::get('descanso');
        $configguracion5->codcampeonato=$id;
        $configguracion5->save();

        $configguracion6 = new Configuracion;
        $configguracion6->descripcion="maximo de juagadores menores de 25 años";
        $configguracion6->valor=Input::get('maximoM');
        $configguracion6->codcampeonato=$id;
        $configguracion6->save();

        return Redirect::to('campeonato/detail/'.$id);
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
