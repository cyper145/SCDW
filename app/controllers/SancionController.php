<?php

class SancionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$todosancion = Sancion::all();
        return View::make('sancion.listar')->with('todosancion',$todosancion);
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

	public function insertarsancion()
	{
		//$todocampeonato = Campeonato::all();
        return View::make('sancion.insertar');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$sancion = new Sancion;
		$sancion->idsancion = Input::get('Codigo sancion');
		$sancion->tiposancion = Input::get('Tipo de sancion');
		$sancion->idjugadorenjuego = Input::get('Jugador en juego');
		$sancion->idequipoenpartido = Input::get('Equipo en partido');
		$sancion->save();
		return Redirect::to('sancion.listar');
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
	public function editarsancion($id)
	{
		//$todocampeonato = Campeonato::all();
        //return View::make('campeonato.editar')->with('todocampeonato',$todocampeonato);

        $sancion = Sancion::where('idsancion', '=', $id)->get();
		return View::make('sancion.editar')->with('sancion',$sancion);

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
		
		$sancion = DB::table('tsancion')
            ->where('idsancion', $id)
            ->delete();
        return Redirect::to('sancion/listar');
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
