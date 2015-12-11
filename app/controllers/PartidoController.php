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


}
