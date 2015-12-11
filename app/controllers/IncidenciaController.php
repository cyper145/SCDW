
<?php

class IncidenciaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$todoincidencias = Incidencia::all();
        return View::make('user_com_organizing.incidencia.listar')->with('todoincidencias',$todoincidencias);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
 /*public function create()
	{
		//$todocampeonato = Campeonato::all();
        return View::make('campeonato.insertar');
	}*/

	public function insertarincidencias()
	{
		//$todocampeonato = Campeonato::all();
        return View::make('incidencias.insertar');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$incidencias = new Incidencia;
		
		$incidencias->codincidencias = Input::get('Codigo incidencia');
		$incidencias->incidencias = Input::get('Incidencia');
		$incidencias->hora = Input::get('Hora');
		$incidencias->codpartido = Input::get('Codigo partido');
		$incidencias->save();
		return Redirect::to('incidencias.listar');
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
	public function editarincidencias($id)
	{
		//$todocampeonato = Campeonato::all();
        //return View::make('campeonato.editar')->with('todocampeonato',$todocampeonato);

        $incidencias = Incidencia::where('codincidencias', '=', $id)->get();
		return View::make('incidencias.editar')->with('incidencias',$incidencias);

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function update($id)
	{
		//$todocampeonato = Campeonato::all();
		$entra = Input::all();
		$miembro_mesa = DB::table('tmesa')
            ->where('idmesa', $id)
            ->update(array(
		'idmesa' => $entra['Codigo mesa'],
		'coddocente' => $entra['Codigo docente'],
		'codpartido' => $entra['Codigo partido'],
        return Redirect::to('miembro_mesa/listar');
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
	public function delete($id)
	{
		
		$incidencias = DB::table('tincidencias')
            ->where('codincidencias', $id)
            ->delete();
        return Redirect::to('incidencias/listar');
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
